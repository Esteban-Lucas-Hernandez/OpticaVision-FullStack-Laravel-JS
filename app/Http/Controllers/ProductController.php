<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductHistory;

class ProductController extends Controller
{
    /**
     * Vista pública principal (Catálogo de bienvenida)
     * Obtiene los productos normales y los que están en oferta por separado.
     */
    public function index()
    {
        // Obtener productos que no están en oferta junto con sus imágenes
        $products = Product::with('images')->where('on_offer', false)->get();
        // Obtener productos en oferta junto con sus imágenes
        $offers = Product::with('images')->where('on_offer', true)->get();

        return view('welcome', compact('products', 'offers'));
    }

    /**
     * Muestra el panel de administración / dashboard del vendedor.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Listado interno de productos para el administrador/vendedor autenticado.
     * Muestra únicamente los productos creados por el vendedor logueado con paginación.
     */
    public function adminIndex()
    {
        $products = Product::with('images')
            ->where('seller_id', auth()->id()) // Filtrar por el vendedor actual
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Muestra el historial de cambios y movimientos de productos en el sistema.
     */
    public function historial()
    {
        $history = ProductHistory::with('product')->latest()->paginate(10);
        return view('admin.products.historial', compact('history'));
    }

    /**
     * Muestra la vista de detalle de un producto específico mediante su ID.
     */
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('show', compact('product'));
    }

    /**
     * Almacena un nuevo producto en la base de datos, incluyendo la subida
     * de hasta un máximo de 4 imágenes.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,webp,svg,tiff,heic,heif|max:5120',
            'on_offer' => 'nullable|boolean',
        ]);

        // Crear el registro de producto asociándolo con el vendedor autenticado
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'on_offer' => $request->has('on_offer'),
            'seller_id' => auth()->id(),
        ]);

        // Procesar y guardar imágenes si se han subido archivos
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $count = 0;
            foreach ($files as $file) {
                if ($count >= 4) break; // Límite estricto de 4 imágenes
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
                $count++;
            }
        }

        return redirect()->back()->with('success', 'Producto creado correctamente');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Actualiza la información de un producto específico en la base de datos.
     */
    public function update(Request $request, Product $product)
    {
        // Validar datos de actualización
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'on_offer' => 'nullable|boolean',
        ]);

        // Actualizar los datos del producto
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'on_offer' => $request->input('on_offer'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Elimina de manera lógica/física un producto del sistema.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente');
    }

    /**
     * Endpoint de la API pública para obtener las últimas notificaciones de productos.
     * Devuelve los últimos 5 productos creados en formato JSON.
     */
    public function publicNotifications() {
        $products = Product::latest()->take(5)->get(['id', 'name', 'created_at']);
        return response()->json($products);
    }

}
