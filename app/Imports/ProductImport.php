<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'title' => $row['title'],
            'slug' => $row['slug'],
            'sku' => $row['sku'],
            'product_label' => $row['product_label'],
            'summary' => $row['summary'],
            'stock' => $row['stock'],
            'cat_id' => $row['category_id'],
            'child_cat_id' => $row['child_category_id'],
            'is_featured' => $row['is_featured'],
            'price' => $row['price'],
            'purchase_price' => $row['purchase_price'],
            'colors' => json_encode(array()),
            'choice_options' => json_encode(array()),
            'variation' => json_encode(array()),
            'discount' => $row['discount'],
            'discount_type' => $row['discount_type'],
            'processing_time' => $row['processing_time'],
            'shipping_time' => $row['shipping_time'],
            'display_custom_size' => $row['display_custom_size'],
            'display_peticoat' => $row['display_peticoat'],
            'status' => $row['status'],
        ]);
    }


    public function rules(): array
    {
        return [
            // Can also use callback validation rules
            'unit_price' => function ($attribute, $value, $onFailure) {
                if (!is_numeric($value)) {
                    $onFailure('Unit price is not numeric');
                }
            }
        ];
    }
}
