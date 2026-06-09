<?php

namespace App\Http\Controllers;

use App\Exports\PurchasesExport;
use App\Models\Product;
use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    /**
     * Registra una nueva compra en estado 'pendiente' y genera el recibo de compra en PDF.
     * Guarda el recibo en el disco 'public' y responde con los datos en formato JSON.
     */
    public function store(Product $product, Request $request)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        $user = Auth::user();

        // Crear registro de compra asociando comprador, vendedor y producto
        $purchase = Purchase::create([
            'buyer_id'     => $user->id,
            'product_id'   => $product->id,
            'seller_id'    => $product->seller_id,
            'status'       => 'pendiente',
            'purchased_at' => now(),
        ]);

        // Cargar vista HTML del recibo y generar el documento PDF
        $pdf = Pdf::loadView('pdf.receipt', [
            'user'     => $user,
            'product'  => $product,
            'purchase' => $purchase,
        ]);

        $pdfPath = 'receipts/receipt_' . $purchase->id . '.pdf';

        // Guardar el PDF físicamente en el disco público (storage/app/public/receipts)
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Retornar la respuesta JSON con la URL del PDF generado
        return response()->json([
            'success' => true,
            'pdf_url' => asset('storage/' . $pdfPath),
            'message' => 'Compra registrada, pendiente de aprobación del vendedor.'
        ]);
    }

    /**
     * Muestra la vista de historial de compras para administradores/vendedores.
     */
    public function index()
    {
        // Cargar relaciones correspondientes y ordenar cronológicamente
        $purchases = Purchase::with(['buyer', 'product'])
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('admin.products.historial', compact('purchases'));
    }

    /**
     * Actualiza el estado de una compra (Aceptada / Rechazada).
     * Solo permite al vendedor dueño del producto modificar este estado.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->json()->all();

        // Validar que el estado sea correcto
        if (!isset($data['status']) || !in_array($data['status'], ['aceptada', 'rechazada'])) {
            return response()->json(['success' => false, 'message' => 'Estado inválido']);
        }

        // Verificar que el usuario autenticado sea el vendedor de dicho producto
        if (Auth::id() !== $purchase->product->seller_id) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        // Guardar el nuevo estado
        $purchase->status = $data['status'];
        $purchase->save();

        return response()->json(['success' => true]);
    }

    /**
     * Obtiene el listado de compras pendientes de aprobación específicas para el vendedor logueado.
     */
    public function sellerHistory()
    {
        $user = Auth::user();

        $purchases = Purchase::with(['buyer', 'product'])
            ->whereHas('product', function ($q) use ($user) {
                $q->where('seller_id', $user->id); // Filtrar por los productos del vendedor
            })
            ->where('status', 'pendiente')
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('seller.historial', compact('purchases'));
    }

    /**
     * Muestra el panel completo de historial de compras para el administrador.
     */
    public function adminPurchasesHistory()
    {
        $purchases = Purchase::with(['buyer', 'product', 'product.seller'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.purchases.history', compact('purchases'));
    }

    /**
     * Retorna las últimas 5 notificaciones de compras realizadas por el usuario cliente actual.
     */
    public function userNotifications()
    {
        $user = auth()->user();

        $purchases = Purchase::where('buyer_id', $user->id)
            ->latest('updated_at')
            ->take(5)
            ->with('product')
            ->get();

        $data = $purchases->map(function ($purchase) {
            return [
                'product_name' => $purchase->product->name,
                'status'       => $purchase->status,
                'purchased_at' => $purchase->updated_at->toDateTimeString(),
            ];
        });

        return response()->json($data);
    }

    /**
     * Cuenta cuántas notificaciones de compras del usuario cliente se han actualizado desde una fecha dada.
     */
    public function userNotificationStatus(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['count' => 0]);
        }

        $user = auth()->user();
        $lastChecked = $request->input('since');

        $query = Purchase::where('buyer_id', $user->id)
            ->where('status', '!=', 'pendiente'); // Solo notificar aceptaciones o rechazos

        if ($lastChecked) {
            try {
                $query->where('updated_at', '>', new \DateTime($lastChecked));
            } catch (\Exception $e) {
                return response()->json(['count' => 0]);
            }
        }

        $count = $query->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Genera un reporte PDF con todo el historial de compras registrado y fuerza su descarga.
     */
    public function downloadPdfHistory()
    {
        $purchases = Purchase::with(['buyer', 'product', 'product.seller'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.purchases-history', compact('purchases'));

        return $pdf->download('historial-de-compras.pdf');
    }

    /**
     * Exporta el historial de compras en formato Excel (.xlsx).
     */
    public function downloadExcelHistory()
    {
        return Excel::download(new PurchasesExport, 'historial-de-compras.xlsx');
    }

    /**
     * Vacía por completo la tabla de compras en la base de datos (Truncate).
     */
    public function clearHistory()
    {
        Purchase::truncate();

        return redirect()->route('admin.purchases.history')->with('success', 'Historial de compras eliminado correctamente.');
    }
}
