<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Category;
use App\ProductsExport;
use App\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class ProductBulkController extends Controller
{
    public function export(){
        return Excel::download(new ProductsExport(),'products.xlsx');
    }

    public function index(){
        return view('backend.product.bulk-upload');
    }

    public function pdf_category_download(){
        $categories=Category::all();
        return PDF::loadView('backend.category.download',[
            'categories' => $categories,
        ], [], [])->download('category.pdf');
    }

    public function import(Request $request){
        if($request->hasFile('bulk_file')){
            Excel::import(new ProductImport,request()->file('bulk_file'));
        }
        return back()->with('success','Products imported successfully');
    }
}
