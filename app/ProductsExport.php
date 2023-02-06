<?php

namespace App;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'title',
            'slug',
            'sku',
            'product_label',
            'summary',
            'stock',
            'category_id',
            'child_category_id',
            'is_featured',
            'price',
            'purchase_price',
            'discount',
            'discount_type',
            'processing_time',
            'shipping_time',
            'display_custom_size',
            'display_peticoat',
            'status',
        ];
    }

    /**
     * @var Product $product
     */

    public function map($product): array
    {
        return [
            $product->title,
            $product->slug,
            $product->sku,
            $product->product_label,
            $product->summary,
            $product->stock,
            $product->cat_id,
            $product->child_cat_id,
            $product->is_featured,
            $product->price,
            $product->purchase_price,
            $product->discount,
            $product->discount_type,
            $product->processing_time,
            $product->shipping_time,
            $product->display_custom_size,
            $product->display_peticoat,
            $product->status,
        ];
    }
}
