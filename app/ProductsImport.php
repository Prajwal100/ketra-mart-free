<?php
//
//namespace App;
//
//use App\Models\Product;
//use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToCollection;
//use Maatwebsite\Excel\Concerns\ToModel;
//
//class ProductsImport implements ToModel
//{
//
//    public function model(array $row)
//    {
//        return new Product([
//            'title' => $row[0],
//            'slug' => $row[1],
//            'sku' => $row[2],
//            'product_label' => $row[3],
//            'summary' => $row[4],
//            'stock' => $row[5],
//            'cat_id' => $row[6],
//            'child_cat_id' =>$row[7],
//            'discount' => $row[8],
//            'discount_type' => $row[9],
//            'purchase_price' => $row[12],
//            'discount' => $row[11],
//            'discount_type' => $row[12],
//            'processing_time' => $row[13],
//            'shipping_time' => $row[14],
//            'display_custom_size' => $row[15],
//            'display_peticoat' => $row[16],
//            'status' => $row[17],
//        ]);
//    }
//
//
//}
