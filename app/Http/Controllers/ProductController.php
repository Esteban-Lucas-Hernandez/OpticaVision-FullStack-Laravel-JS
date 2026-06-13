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
        // Obtener TODOS los productos (en oferta y normales) junto con imágenes y categoría para el catálogo
        $products = Product::with(['images', 'category'])->get();
        // Obtener productos en oferta junto con sus imágenes y categoría para el carrusel de ofertas
        $offers = Product::with(['images', 'category'])->where('on_offer', true)->get();
        // Obtener todas las categorías para los filtros
        $categories = \App\Models\Category::all();
        // Obtener marcas únicas que existen en la base de datos
        $brands = Product::whereNotNull('brand')->where('brand', '!=', '')->distinct()->pluck('brand')->toArray();

        return view('welcome', compact('products', 'offers', 'categories', 'brands'));
    }

    /**
     * Muestra el panel de administración / dashboard del vendedor.
     */
    public function dashboard()
    {
        $categories = \App\Models\Category::all();
        return view('admin.dashboard', compact('categories'));
    }

    /**
     * Listado interno de productos para el administrador/vendedor autenticado.
     * Muestra únicamente los productos creados por el vendedor logueado con paginación.
     */
    public function adminIndex()
    {
        $products = Product::with(['images', 'category'])
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
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'gender' => 'required|string|in:Hombre,Mujer,Unisex',
            'stock' => 'required|integer|min:0',
        ]);

        // Crear el registro de producto asociándolo con el vendedor autenticado
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'on_offer' => $request->has('on_offer'),
            'seller_id' => auth()->id(),
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'gender' => $request->gender,
            'stock' => $request->stock,
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
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
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
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'gender' => 'required|string|in:Hombre,Mujer,Unisex',
            'stock' => 'required|integer|min:0',
        ]);

        // Actualizar los datos del producto
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'on_offer' => $request->input('on_offer'),
            'category_id' => $data['category_id'],
            'brand' => $data['brand'],
            'gender' => $data['gender'],
            'stock' => $data['stock'],
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
