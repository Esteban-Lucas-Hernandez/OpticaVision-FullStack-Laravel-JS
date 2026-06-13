<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAndImagesSeeder extends Seeder
{
    public function run()
    {
        // Limpiar tablas para evitar errores de claves duplicadas si se corre múltiples veces
        DB::statement('PRAGMA foreign_keys = OFF;');
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('product_images')->truncate();
        DB::statement('PRAGMA foreign_keys = ON;');

        // Insertar categorías
        $solId = DB::table('categories')->insertGetId([
            'name' => 'Gafas de Sol',
            'slug' => 'gafas-de-sol',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $graduadasId = DB::table('categories')->insertGetId([
            'name' => 'Gafas Graduadas',
            'slug' => 'gafas-graduadas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $contactoId = DB::table('categories')->insertGetId([
            'name' => 'Lentes de Contacto',
            'slug' => 'lentes-de-contacto',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $accesoriosId = DB::table('categories')->insertGetId([
            'name' => 'Accesorios',
            'slug' => 'accesorios',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Insertar productos con categorías y filtros
        DB::table('products')->insert([
            [
                'id' => 10,
                'name' => 'gafas arnette',
                'description' => 'Estilo urbano y moderno, diseñadas para ofrecer comodidad y resistencia.',
                'price' => 15000.00,
                'seller_id' => 2,
                'on_offer' => 0,
                'category_id' => $solId,
                'brand' => 'Arnette',
                'gender' => 'Hombre',
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'gafas redondas negras',
                'description' => 'Clásicas y sofisticadas, estas gafas redondas negras son ideales para cualquier ocasión.',
                'price' => 30000.00,
                'seller_id' => 2,
                'on_offer' => 1,
                'category_id' => $solId,
                'brand' => 'Ray-Ban',
                'gender' => 'Unisex',
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'name' => 'gafas-premiun',
                'description' => 'Elegancia atemporal y estilo versátil para cualquier look.',
                'price' => 40000.00,
                'seller_id' => 3,
                'on_offer' => 1,
                'category_id' => $graduadasId,
                'brand' => 'Oakley',
                'gender' => 'Unisex',
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'name' => 'gafas de sol-premiun',
                'description' => 'Estilo exclusivo con máxima protección y acabado de lujo.',
                'price' => 40000.00,
                'seller_id' => 3,
                'on_offer' => 0,
                'category_id' => $solId,
                'brand' => 'Carrera',
                'gender' => 'Hombre',
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'name' => 'gafas urbanas',
                'description' => 'Estilo moderno y desenfadado, perfectas para un look casual.',
                'price' => 15000.00,
                'seller_id' => 2,
                'on_offer' => 0,
                'category_id' => $graduadasId,
                'brand' => 'Arnette',
                'gender' => 'Unisex',
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'name' => 'gafas modernas',
                'description' => 'Diseño contemporáneo que combina estilo y comodidad.',
                'price' => 80000.00,
                'seller_id' => 2,
                'on_offer' => 1,
                'category_id' => $solId,
                'brand' => 'Vogue',
                'gender' => 'Mujer',
                'stock' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'name' => 'Lentes Planos Unisex',
                'description' => 'Estilo moderno y cómodo, para cualquier ocasión.',
                'price' => 20000.00,
                'seller_id' => 2,
                'on_offer' => 1,
                'category_id' => $graduadasId,
                'brand' => 'Ray-Ban',
                'gender' => 'Unisex',
                'stock' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'name' => 'gafas marco premiun',
                'description' => 'Diseño elegante y exclusivo, con acabados de alta calidad.',
                'price' => 50000.00,
                'seller_id' => 3,
                'on_offer' => 0,
                'category_id' => $graduadasId,
                'brand' => 'Prada',
                'gender' => 'Mujer',
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'name' => 'gafas anti-luz',
                'description' => 'Protección eficaz contra la luz azul, cuidando tus ojos frente a pantallas.',
                'price' => 100000.00,
                'seller_id' => 3,
                'on_offer' => 0,
                'category_id' => $graduadasId,
                'brand' => 'Oakley',
                'gender' => 'Unisex',
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insertar imágenes
        DB::table('product_images')->insert([
            // Product 10
            ['product_id' => 10, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_627542-MLA108311913496_032026-F.webp'],
            ['product_id' => 10, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_876124-MLA109103523161_032026-F.webp'],
            ['product_id' => 10, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_993738-MLA108312386952_032026-F.webp'],
            ['product_id' => 10, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_805322-MLA108312801648_032026-F.webp'],

            // Product 12
            ['product_id' => 12, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_860418-MLA84534391406_052025-F.webp'],

            // Product 14
            ['product_id' => 14, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_836257-MLA91326909758_092025-F.webp'],

            // Product 15
            ['product_id' => 15, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_666114-MCO105969288187_012026-F.webp'],
            ['product_id' => 15, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_944421-MCO105969288181_012026-F.webp'],

            // Product 16
            ['product_id' => 16, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_787351-CBT70165983792_062023-F.webp'],
            ['product_id' => 16, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_737842-CBT70165983802_062023-F.webp'],
            ['product_id' => 16, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_909515-CBT70165983798_062023-F.webp'],

            // Product 17
            ['product_id' => 17, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_632876-MLA99946790041_112025-F.webp'],
            ['product_id' => 17, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_675539-MLA74651636894_022024-F.webp'],
            ['product_id' => 17, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_839628-MLA108920958556_032026-F.webp'],

            // Product 18
            ['product_id' => 18, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_859015-CBT75754906352_042024-F.webp'],
            ['product_id' => 18, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_663132-CBT70848186038_082023-F.webp'],
            ['product_id' => 18, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_990684-CBT70848186040_082023-F.webp'],

            // Product 19
            ['product_id' => 19, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_646619-CBT94466868703_102025-F.webp'],
            ['product_id' => 19, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_843787-CBT81383887322_122024-F.webp'],
            ['product_id' => 19, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_829225-CBT81383887318_122024-F.webp'],

            // Product 20
            ['product_id' => 20, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_763033-MLM87416690548_072025-F.webp'],
            ['product_id' => 20, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_943257-MLA95846829829_102025-F.webp'],
            ['product_id' => 20, 'image' => 'https://http2.mlstatic.com/D_NQ_NP_2X_970951-MLA81202160394_122024-F.webp'],
        ]);
    }
}