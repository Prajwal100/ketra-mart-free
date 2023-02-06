<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductManagerController extends Controller
{
    public function productFilter(Request $request)
    {
        $str = "";
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        if ($request->has('searched_value')) {
            $str = $request->searched_value;
        }

        $sortBy = $request->sortBy;
        if (!isset(request()->perpage)) {
            $perpage = 18;
        } else {
            $perpage = request()->perpage;
        }

        if (!isset($sortBy)) {
            $sortBy = 'latest';
        } else {
            $sortBy = $sortBy;
        }

        $conditions = ['status' => 'active'];

        //attribute filters
        $attribute_except_icon_color = Attribute::where(['has_color' => 0])->pluck('id');
        $product_except_icon_color = ProductAttribute::whereIn('attribute_id', $attribute_except_icon_color)->pluck('attribute_id');
        $product_except_icon_color_values = ProductAttributeValue::whereIn('attribute_id', $product_except_icon_color)->pluck('attribute_value_id');
        $attributes = Attribute::with(['attribute_values' => function ($query) use ($product_except_icon_color_values) {
            $query->whereIn('id', $product_except_icon_color_values);
        }])->whereIn('id', $product_except_icon_color)->get();

        $selected_attribute_values = [];
        if (!empty($_GET['attribute_values'])) {
            $selected_attribute_values = $_GET['attribute_values'];
        }


        $products = Product::with('variations')->where('status', 'active')->where('title', 'LIKE', '%' . $str . '%');
        if ($selected_attribute_values) {
            $products->whereHas('attribute_values', function ($query) use ($selected_attribute_values) {
                return $query->whereIn('attribute_value_id', $selected_attribute_values);
            });
        }


        $color_id = Attribute::where('has_color', 1)->first()->id;
        $product_colors_values = ProductAttributeValue::where('attribute_id', $color_id)->pluck('attribute_value_id');
        $attribute_with_color = AttributeValue::whereIn('id', $product_colors_values)->get();

        if ($min_price != null && $max_price != null) {
            $products = $products->where('purchase_price', '>=', $min_price)->where('purchase_price', '<=', $max_price);
        }
        if ($sortBy != null) {
            switch ($sortBy) {
                case 'latest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'low-high':
                    $products->orderBy('purchase_price', 'asc');
                    break;
                case 'high-low':
                    $products->orderBy('purchase_price', 'desc');
                    break;
                case 'a-z':
                    $products->orderBy('title', 'asc');
                    break;
                case 'z-a':
                    $products->orderBy('title', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }
        if ($request->ajax()) {
            $view = 'frontend.partials.products_filter_4columns';
        } else {
            $view = 'frontend.pages.product.products';
        }

        $products = $products->paginate($perpage);
        $breadcrumb="ALL PRODUCTS";
        $query="";
        return view($view, compact('products', 'sortBy','query', 'perpage','breadcrumb','min_price','max_price', 'attributes',
            'selected_attribute_values',
            'attribute_with_color'));
    }


    public function productCategory(Request $request, $slug)
    {

        $category = Category::where(['status' => 'active', 'slug' => $slug])->first();


        if ($category != null) {

            return $this->search($request, $category->id);
        }

        abort(404);
    }


    public function search(Request $request, $category_id = null)
    {
        $query = $request->input('q');
        $sortBy = $request->sortBy;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        if (!isset(request()->perpage)) {
            $perpage = 18;
        } else {
            $perpage = request()->perpage;
        }

        if (!isset($sortBy)) {
            $sortBy = 'latest';
        } else {
            $sortBy = $sortBy;
        }

        //attribute filters
        $attribute_except_icon_color = Attribute::where(['has_color' => 0])->pluck('id');
        $product_except_icon_color = ProductAttribute::whereIn('attribute_id', $attribute_except_icon_color)->pluck('attribute_id');
        $product_except_icon_color_values = ProductAttributeValue::whereIn('attribute_id', $product_except_icon_color)->pluck('attribute_value_id');
        $attributes = Attribute::with(['attribute_values' => function ($query) use ($product_except_icon_color_values) {
            $query->whereIn('id', $product_except_icon_color_values);
        }])->whereIn('id', $product_except_icon_color)->get();

        $selected_attribute_values = [];
        if (!empty($_GET['attribute_values'])) {
            $selected_attribute_values = $_GET['attribute_values'];
        }


        $category = Category::find($category_id);

        $conditions = ['status' => 'active'];

        $products = Product::with('variations')->where($conditions);


        if ($min_price != null && $max_price != null) {

            $products = $products->where('purchase_price', '>=', $min_price)->where('purchase_price', '<=', $max_price);
        }

        if ($query != null) {
            $products = $products->where('title', 'LIKE', '%' . $query . '%');
        }

        if ($sortBy != null) {
            switch ($sortBy) {
                case 'latest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'low-high':
                    $products->orderBy('purchase_price', 'asc');
                    break;
                case 'high-low':
                    $products->orderBy('purchase_price', 'desc');
                    break;
                case 'a-z':
                    $products->orderBy('title', 'asc');
                    break;
                case 'z-a':
                    $products->orderBy('title', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }
        if ($selected_attribute_values) {
            $products->whereHas('attribute_values', function ($query) use ($selected_attribute_values) {
                return $query->whereIn('attribute_value_id', $selected_attribute_values);
            });
        }

        if ($category_id != null) {
            $category_ids[] = $category_id;
            $products = $products->whereIn('cat_ids', $category_ids);
        }

        $color_id = Attribute::where('has_color', 1)->first()->id;
        $product_colors_values = ProductAttributeValue::where('attribute_id', $color_id)->pluck('attribute_value_id');
        $attribute_with_color = AttributeValue::whereIn('id', $product_colors_values)->get();

        if ($request->ajax()) {
            $view = 'frontend.partials.products_filter';
        } else {
            $view = 'frontend.pages.product.product-category';
        }

        $products = $products->paginate($perpage);

        return view($view, compact(
            'category',
            'category_id',
            'products',
            'sortBy',
            'attributes',
            'selected_attribute_values',
            'min_price',
            'max_price',
            'attribute_with_color',
            'perpage'
        ));
    }

    public function productDetail(Request $request, $slug)
    {
        $product = Product::with('rel_prods')->where('slug', $slug)->first();
        $reviews = $product->reviews()->orderBy('id', 'DESC')->get();
        $display_reviews = $product->reviews()->take(2)->latest()->get();
        $recent_view = null;

        if ($product) {
            return view('frontend.pages.product.product-detail', compact('product', 'reviews', 'display_reviews'));
        } else {
            return 'Product detail not found';
        }
    }

    //Product search
    public function searchedProducts(Request $request, $limit = 10, $offset = 1)
    {
        $query = $request->q;
        $sortBy = $request->sortBy;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        if (!isset(request()->perpage)) {
            $perpage = 18;
        } else {
            $perpage = request()->perpage;
        }

        if (!isset($sortBy)) {
            $sortBy = 'latest';
        } else {
            $sortBy = $sortBy;
        }
        $breadcrumb="SEARCH PRODUCTS";



        //attribute filters
        $attribute_except_icon_color = Attribute::where(['has_color' => 0])->pluck('id');
        $product_except_icon_color = ProductAttribute::whereIn('attribute_id', $attribute_except_icon_color)->pluck('attribute_id');
        $product_except_icon_color_values = ProductAttributeValue::whereIn('attribute_id', $product_except_icon_color)->pluck('attribute_value_id');
        $attributes = Attribute::with(['attribute_values' => function ($query) use ($product_except_icon_color_values) {
            $query->whereIn('id', $product_except_icon_color_values);
        }])->whereIn('id', $product_except_icon_color)->get();

        $selected_attribute_values = [];
        if (!empty($_GET['attribute_values'])) {
            $selected_attribute_values = $_GET['attribute_values'];
        }


        $products = Product::with('variations')->where('status', 'active');
        if ($selected_attribute_values) {
            $products->whereHas('attribute_values', function ($query) use ($selected_attribute_values) {
                return $query->whereIn('attribute_value_id', $selected_attribute_values);
            });
        }


        $color_id = Attribute::where('has_color', 1)->first()->id;
        $product_colors_values = ProductAttributeValue::where('attribute_id', $color_id)->pluck('attribute_value_id');
        $attribute_with_color = AttributeValue::whereIn('id', $product_colors_values)->get();


        if ($min_price != null && $max_price != null) {
            $products = $products->where('purchase_price', '>=', $min_price)->where('purchase_price', '<=', $max_price);
        }
        $products =$products->where('title', 'LIKE', '%' . $query . '%')->paginate($perpage);
        if ($request->ajax()) {
            $view = 'frontend.partials.products_filter';
        } else {
            $view = 'frontend.pages.product.products';
        }
        return view($view, compact('products', 'sortBy', 'perpage', 'query','breadcrumb','min_price','max_price', 'attributes',
            'selected_attribute_values',
            'attribute_with_color'));
    }

    public function viewAllProducts(Request $request,$key){
        $sortBy = $request->sortBy;
        $query="";

        $min_price = $request->min_price;
        $max_price = $request->max_price;

        if (!isset(request()->perpage)) {
            $perpage = 18;
        } else {
            $perpage = request()->perpage;
        }

        if (!isset($sortBy)) {
            $sortBy = 'latest';
        } else {
            $sortBy = $sortBy;
        }


        //attribute filters
        $attribute_except_icon_color = Attribute::where(['has_color' => 0])->pluck('id');
        $product_except_icon_color = ProductAttribute::whereIn('attribute_id', $attribute_except_icon_color)->pluck('attribute_id');
        $product_except_icon_color_values = ProductAttributeValue::whereIn('attribute_id', $product_except_icon_color)->pluck('attribute_value_id');
        $attributes = Attribute::with(['attribute_values' => function ($query) use ($product_except_icon_color_values) {
            $query->whereIn('id', $product_except_icon_color_values);
        }])->whereIn('id', $product_except_icon_color)->get();

        $selected_attribute_values = [];
        if (!empty($_GET['attribute_values'])) {
            $selected_attribute_values = $_GET['attribute_values'];
        }


        $products = Product::with('variations')->where('status', 'active');
        if ($selected_attribute_values) {
            $products->whereHas('attribute_values', function ($query) use ($selected_attribute_values) {
                return $query->whereIn('attribute_value_id', $selected_attribute_values);
            });
        }


        $color_id = Attribute::where('has_color', 1)->first()->id;
        $product_colors_values = ProductAttributeValue::where('attribute_id', $color_id)->pluck('attribute_value_id');
        $attribute_with_color = AttributeValue::whereIn('id', $product_colors_values)->get();

        if ($min_price != null && $max_price != null) {
            $products = $products->where('purchase_price', '>=', $min_price)->where('purchase_price', '<=', $max_price);
        }
        if($key==='featured'){
            $products->where('is_featured',1);
            $breadcrumb="VIEW ALL FEATURED PRODUCTS";

        }
        else if($key=="latest"){
            $products->orderBy('id', 'DESC');
            $breadcrumb="VIEW ALL LATEST PRODUCTS";

        }

        $products = $products->paginate($perpage);

        if ($request->ajax()) {
            $view = 'frontend.partials.products_filter';
        } else {
            $view = 'frontend.pages.product.products';
        }
        return view($view, compact('products', 'sortBy', 'perpage', 'query','breadcrumb','min_price','max_price', 'attributes',
            'selected_attribute_values',
            'attribute_with_color'));
    }
}
