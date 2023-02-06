<?php

    /*==========================================
    =   Author: Prajwal Rai                                 =
    =   Author URI: https://raiprajwal.com                  =
    =   Author GITHUB URI: https://github.com/prajwal100    =
    =   Copyright (c) 2023                                 =
    ==========================================*/

    namespace App\Http\Controllers;

    use App\Models\Attribute;
    use App\Models\AttributeValue;
    use App\Models\Category;
    use App\Models\Color;
    use App\Models\Display;
    use App\Models\Product;
    use App\Models\ProductAttribute;
    use App\Models\ProductAttributeValue;
    use App\Models\ProductStock;
    use Brian2694\Toastr\Facades\Toastr;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class ProductController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        public function add_more_choice_option(Request $request)
        {
            $all_attribute_values = AttributeValue::with('attribute')->where('attribute_id', $request->attribute_id)->get();

            $html = '';

            foreach ($all_attribute_values as $row) {
                $html .= '<option value="' . $row->name . '">' . $row->name . '</option>';
            }

            echo json_encode($html);
        }


        public function index()
        {

            $products=Product::orderBy('id','DESC')->get();
            return view('backend.product.index',compact('products'));
        }

        public function productStatus(Request $request){
            if($request->mode=='true'){
                DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
            }
            else{
                DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
            }
            return response()->json(['msg'=>'Successfully updated status','status'=>true]);
        }

        public function productFeatured(Request $request){
            if($request->mode=='true'){
                DB::table('products')->where('id',$request->id)->update(['is_featured'=>1]);
            }
            else{
                DB::table('products')->where('id',$request->id)->update(['is_featured'=>0]);
            }
            return response()->json(['msg'=>'Successfully updated featured','status'=>true]);
        }

        public function new_attribute(Request $request)
        {
            $attributes = Attribute::query();
            if ($request->has('product_attributes')) {
                foreach ($request->product_attributes as $key => $value) {
                    if ($value == null) {
                        return array(
                            'count' => -1,
                            'view' => view('backend.product.new_attribute', compact('attributes'))->render(),
                        );
                    }
                }
                $attributes->whereNotIn('id', array_diff($request->product_attributes, [null]));
            }
            $attributes = $attributes->get();
            return array(
                'count' => count($attributes),
                'view' => view('backend.product.new_attribute', compact('attributes'))->render(),
            );
        }

        public function get_attribute_values(Request $request)
        {
            $attribute_id = $request->attribute_id;
            $attribute_values = AttributeValue::where('attribute_id', $attribute_id)->get();
            return view('backend.product.new_attribute_values', compact('attribute_id', 'attribute_values'));
        }

        public function new_option(Request $request)
        {
            $attributes = Attribute::query();
            if ($request->has('product_options')) {
                foreach ($request->product_options as $key => $value) {
                    if ($value == NULL) {
                        return array(
                            'count' => -1,
                            'view' => view('backend.product.partials.new_option', compact('attributes'))->render(),
                        );
                    }
                }
                $attributes->whereNotIn('id', array_diff($request->product_options, [null]));
                if (count($request->product_options) === 3) {
                    return array(
                        'count' => -2,
                        'view' => view('backend.product.partials.new_option', compact('attributes'))->render(),
                    );
                }
            }
            $attributes = $attributes->get();
            return array(
                'count' => count($attributes),
                'view' => view('backend.product.partials.new_option', compact('attributes'))->render(),
            );
        }

        public function get_option_choices(Request $request)
        {
            $attribute_id = $request->attribute_id;
            $attribute_values = AttributeValue::where('attribute_id', $attribute_id)->get();

            return view('backend.product.partials.new_option_choices', compact('attribute_values', 'attribute_id'));
        }


        public function sku_combination(Request $request)
        {
            $options = [];
            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $colors_active = 1;
                array_push($options, $request->colors);
            } else {
                $colors_active = 0;
            }

            $unit_price = $request->unit_price;
            $product_name = $request->title;
            $stock = $request->current_stock;

            //        dd($request->all());

            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;
                    //                $my_str = implode('', $request[$name]);
                    //                array_push($options, explode(',', $my_str));
                    $data = array();

                    if ($request[$name] != null) {
                        foreach ($request[$name] as $key => $item) {
                            array_push($data, $item);
                        }
                    }

                    array_push($options, $data);
                }
            }

            $combinations = \Helper::combinations($options);


            return response()->json([
                'view' => view('backend.product.partials._sku_combinations', compact('combinations', 'unit_price', 'stock', 'colors_active', 'product_name'))->render(),
            ]);
        }

        public function sku_combination_edit(Request $request)
        {
            //        dd($request->all());
            $product = Product::findOrFail($request->id);

            $options = array();
            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $colors_active = 1;
                array_push($options, $request->colors);
            } else {
                $colors_active = 0;
            }

            $product_name = $request->title;
            $unit_price = $request->unit_price;

            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;
                    $data = array();
                    // foreach (json_decode($request[$name][0]) as $key => $item) {
                    foreach ($request[$name] as $key => $item) {
                        // array_push($data, $item->value);
                        array_push($data, $item);
                    }
                    array_push($options, $data);
                }
            }

            $combinations = \Helper::combinations($options);

            return view('backend.product.partials._edit_sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product', ['product_stock' => json_decode($product['variation'])]));
        }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $categories = Category::where('parent_id', 0)
                ->with('childrenCategories')
                ->get();
            return view('backend.product.create',compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {


            $this->validate($request,[
                'title'=>'bail|string|required',
                'description'=>'string|nullable',
                'unit_price'=>'bail|required|numeric',
                'discount'=>'nullable|numeric',
                'thumbnail_image'=>'required',
                'cat_ids'=>'required|exists:categories,id',
                'child_cat_id' => 'nullable|exists:categories,id',
                'status'=>'bail|required|in:active,inactive',
//            'images[0]' => 'required',
            ],[
                'title'=>'Product title is required.',
                'cat_ids.required'=>"Category field is required.",
//            'images[0].required' => 'Minimum one image is required for additional images.'
            ]);

            $product = new Product;
            $product->title                 = $request->title;

            $slug                       = Str::slug($request->input('title'));
            $slug_count                 = Product::where('slug', $slug)->count();
            if ($slug_count > 0) {
                $slug                   = $slug . '-' . Str::random(5);
            }
            $product->slug                  = $slug;
            $product->cat_ids               = $request->cat_ids;
            $product->product_label         = $request->product_label;
            $product->min_qty               = $request->min_qty;
            $product->unit                  = $request->unit;
            $product->unit_price            = $request->unit_price;
            $product->discount              = $request->discount;
            $product->discount_type         = $request->discount_type;

            $product->description           = $request->description;
            $product->summary               = $request->summary;
            $product->features               = $request->features;

            $product->images = json_encode($request->images);
            $product->thumbnail_image = $request->thumbnail_image;

            $product->user_id=auth('admin')->id();
            $product->added_by="admin";

            if($request->input('discount_type')=='percent'){
                $discount=($request['unit_price']/100)*$request['discount'];
            }
            else{
                $discount=$request['discount'];
            }

            if($request->input('unit_price')<=$discount) {
                $notify[] = ['error', 'Discount can not be more or equal to the price!'];
                return back()->withNotify($notify);
            }


            $product->is_featured = $request->input('is_featured', 0);
            $product->refundable = $request->input('refundable', 0);
            $product->status = $request->status;

            $product->meta_title = $request->meta_title;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_description = $request->meta_description;

            if ($product->meta_title == null) {
                $product->meta_title = $product->title;
            }

            if ($product->meta_description == null) {
                $product->meta_description = $product->summary;
            }



            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $product->colors = json_encode($request->input('colors'));
            } else {
                $colors = [];
                $product->colors = json_encode($colors);
            }

            $choice_options = [];

            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $str = 'choice_options_' . $no;

                    $item['attribute_id'] = $no;

                    $data = array();
                    foreach ($request[$str] as $key => $eachValue) {
                        array_push($data, $eachValue);
                    }

                    $item['values'] = $data;
                    array_push($choice_options, $item);
                }
            }

            if (!empty($request->choice_no)) {
                $product->attributes = json_encode($request->choice_no);
            } else {
                $product->attributes = json_encode(array());
            }


            $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

            //combination starts from here
            $options = [];
            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $colors_active = 1;
                array_push($options, $request->colors);
            }
            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;

                    $data = array();
                    foreach ($request[$name] as $key => $eachValue) {
                        array_push($data, $eachValue);
                    }
                    array_push($options, $data);
                }
            }
            $variations = [];


            $product->variation = json_encode($variations);
            $product->attributes = json_encode($request->choice_attributes);

            if ($request->discount_type == 'percent') {
                $product->purchase_price = ($request->unit_price - ($request->unit_price * $request->discount) / 100);
            } else {
                $product->purchase_price = $request->unit_price - $request->discount;
            }

            $product->save();

            // attribute
            if ($request->has('product_attributes') && $request->product_attributes[0] != null) {
                foreach ($request->product_attributes as $attr_id) {
                    $attribute_values = 'attribute_' . $attr_id . '_values';
                    if ($request->has($attribute_values) && $request->$attribute_values != null) {
                        $p_attribute = new ProductAttribute;
                        $p_attribute->product_id = $product->id;
                        $p_attribute->attribute_id = $attr_id;
                        $p_attribute->save();

                        foreach ($request->$attribute_values as $val_id) {
                            $p_attr_value = new ProductAttributeValue;
                            $p_attr_value->product_id = $product->id;
                            $p_attr_value->attribute_id = $attr_id;
                            $p_attr_value->attribute_value_id = $val_id;
                            $p_attr_value->save();
                        }
                    }
                }
            }


            //Generates the combinations of customer choice options

            $combinations = \Helper::combinations($options);

            $stock_count = 0;
            if (count($combinations[0]) > 0) {
                $product->variant_products = 1;

                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $k => $item) {
                        if ($k > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                $color_name = AttributeValue::where('color_code', $item)->first()->name;
                                $str .= str_replace(' ', '_', $color_name);
                            } else {
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                    if ($product_stock == null) {
                        $product_stock = new ProductStock;
                        $product_stock->product_id = $product->id;
                    }
                    $product_stock->variant = $str;
                    $product_stock->price = $request['price_' . str_replace('.', '_', $str)];
                    $product_stock->qty = $request['qty_' . str_replace('.', '_', $str)];
                    $product_stock->save();
                }
            } else {
                //$stock_count=(integer)$request['current_stock'];
                $product_stock = new ProductStock;
                $product_stock->product_id = $product->id;
                $product_stock->variant = '';
                $product_stock->price = $request->unit_price;
                $product_stock->qty = $request->current_stock;
                $product_stock->save();
            }
            $product->shipping_time         = $request->shipping_time;
            $product->processing_time       = $request->processing_time;


            $status = $product->save();
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            if ($status) {
                $notify[] = ['success', 'Product successfully created'];
                return redirect()->route('product.index')->withNotify($notify);
            } else {
                $notify[] = ['error', 'Something went wrong!'];
                return back()->withNotify($notify);
            }
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $product=Product::findOrFail($id);
            return view('backend.product.view',compact('product'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $categories = Category::where('parent_id', 0)
                ->with('childrenCategories')
                ->get();
            $product=Product::with('attributes')->find($id);
            $product->colors = json_decode($product->colors);
            $all_attributes = Attribute::get();
            if (json_decode($product['images']) != null) {
                $product['images'] = json_decode($product['images']);
            } else {
                $product['images'] = [null, null, null, null, null, null];
            }
            if($product){
                return view('backend.product.edit',compact(['product','categories','all_attributes']));
            }
            else{
                $notify[]=['warning','Data not found'];
                return back()->withNotify($notify);
            }
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $product=Product::find($id);
            if($product){
                $this->validate($request,[
                    'title'=>'string|required',
                    'unit_price'=>'required|numeric',
                    'discount'=>'nullable|numeric',
                    'thumbnail_image'=>'required',
                    'cat_ids'=>'required',
                    'status'=>'required|in:active,inactive',
                ],[
                    'title'=>'Product title is required.',
                    'cat_ids.required'=>"Category field is required."
                ]);


                $product->title=$request->title;
                $product->slug=$request->slug;


                if($request->has('colors_active') && $request->has('colors') && count($request->colors)>0){
                    $product->colors=json_encode($request->input('colors'));
                }
                else{
                    $colors=[];
                    $product->colors=json_encode($colors);
                }

                $choice_options=[];
                if($request->has('choice_no')){
                    foreach ($request->choice_no as $key => $no) {
                        $str = 'choice_options_'.$no;

                        $item['attribute_id'] = $no;
                        $data = array();
                        foreach ($request[$str] as $key => $eachValue) {
                            array_push($data, $eachValue);
                        }

                        $item['values'] = $data;
                        array_push($choice_options, $item);
                    }
                }

                if (!empty($request->choice_no)) {
                    $product->attributes = json_encode($request->choice_no);
                }
                else {
                    $product->attributes = json_encode(array());
                }

                $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

                $variations = [];

                $product->variation=json_encode($variations);
                $product->unit_price=$request->unit_price;
                $product->unit=$request->unit;
                $product->discount=$request->discount;
                $product->discount_type=$request->discount_type;
                $product->summary=$request->summary;
                $product->description=$request->description;
                $product->cat_ids=$request->cat_ids;

                $product->attributes=json_encode($request->choice_attributes);
                $product->current_stock=$request->current_stock;
                if($request->discount_type=='percent'){
                    $product->purchase_price=($request->unit_price-($request->unit_price*$request->discount)/100);
                }
                else{
                    $product->purchase_price=$request->unit_price-$request->discount;
                }

                $product->is_featured=$request->input('is_featured',0);
                $product->refundable=$request->input('refundable',0);

                $product->status=$request->status;

                $product->thumbnail_image=$request->thumbnail_image;
                if($request->image){
                    $product->images=json_encode($request->image);
                }
                $product->meta_title=$request->meta_title;
                $product->meta_keywords=$request->meta_keywords;
                $product->meta_description=$request->meta_description;

                if($product->meta_title == null) {
                    $product->meta_title = $product->title;
                }

                if($product->meta_description == null) {
                    $product->meta_description = $product->summary;
                }

                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                    $product->colors = json_encode($request->input('colors'));
                } else {
                    $colors = [];
                    $product->colors = json_encode($colors);
                }

                $choice_options = [];
                if ($request->has('choice_no')) {
                    foreach ($request->choice_no as $key => $no) {
                        $str = 'choice_options_' . $no;

                        $item['attribute_id'] = $no;

                        $data = array();
                        foreach ($request[$str] as $key => $eachValue) {
                            array_push($data, $eachValue);
                        }

                        $item['values'] = $data;
                        array_push($choice_options, $item);
                    }
                }

                // attributes + values
                foreach (\App\Models\ProductAttribute::where('product_id', $product->id)->get() as $attr) {
                    $attr->delete();
                }
                foreach ($product->attribute_values as $attr_val) {
                    $attr_val->delete();
                }


                if ($request->has('product_attributes') && $request->product_attributes[0] != null) {
                    foreach ($request->product_attributes as $attr_id) {
                        $attribute_values = 'attribute_' . $attr_id . '_values';
                        if ($request->has($attribute_values) && $request->$attribute_values != null) {
                            $p_attribute = new ProductAttribute;
                            $p_attribute->product_id = $product->id;
                            $p_attribute->attribute_id = $attr_id;
                            $p_attribute->save();

                            foreach ($request->$attribute_values as $val_id) {
                                $p_attr_value = new ProductAttributeValue;
                                $p_attr_value->product_id = $product->id;
                                $p_attr_value->attribute_id = $attr_id;
                                $p_attr_value->attribute_value_id = $val_id;
                                $p_attr_value->save();
                            }
                        }
                    }
                }

                //combination starts from here
                $options = [];
                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                    $colors_active = 1;
                    array_push($options, $request->colors);
                }
                if ($request->has('choice_no')) {
                    foreach ($request->choice_no as $key => $no) {
                        $name = 'choice_options_' . $no;
                        $data = array();
                        foreach ($request[$name] as $key => $item) {
                            array_push($data, $item);
                        }
                        array_push($options, $data);
                    }
                }

                //Generates the combinations of customer choice options
                $combinations=\Helper::combinations($options);
                $stock_count=0;
                if (count($combinations[0]) > 0) {
                    $product->variant_products = 1;
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $k => $item) {
                            if ($k > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = AttributeValue::where('color_code', $item)->first()->name;
                                    $str .= str_replace(' ', '_', $color_name);
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                        if ($product_stock == null) {
                            $product_stock = new ProductStock;
                            $product_stock->product_id = $product->id;
                        }
                        if (isset($request['price_' . str_replace('.', '_', $str)])) {

                            $product_stock->variant = $str;
                            $product_stock->price = $request['price_' . str_replace('.', '_', $str)];
                            $product_stock->qty = $request['qty_' . str_replace('.', '_', $str)];
                            $product_stock->save();
                        }
                    }
                } else {
                    $product_stock              = new ProductStock;
                    $product_stock->product_id  = $product->id;
                    $product_stock->variant     = '';
                    $product_stock->price       = $request->unit_price;
                    $product_stock->qty         = $request->current_stock;
                    $product_stock->save();
                }
                $product->shipping_time         = $request->shipping_time;
                $product->processing_time       = $request->processing_time;


                $status=$product->save();
                Artisan::call('view:clear');
                Artisan::call('cache:clear');
                if($status){
                    $notify[]=['success','Successfully updated'];
                    return redirect()->route('product.index')->withNotify($notify);
                }
                else{
                    $notify[]=['error','Something went wrong!'];
                    return redirect()->back()->withNotify($notify);
                }
            }
            else{
                $notify[]=['warning','Data not found'];
                return back()->withNotify($notify);
            }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $product=Product::findOrFail($id);
            if($product){
                $status=$product->delete();
                if($status){
                    $notify[]=['success','Successfully deleted'];
                    return redirect()->route('product.index')->withNotify($notify);
                }
                else{
                    $notify[]=['error','Something went wrong!'];
                    return redirect()->back()->withNotify($notify);
                }
            }
            else{
                $notify[]=['warning','Data not found'];
                return back()->withNotify($notify);
            }
        }

        public function deleteAll(Request $request){
            if(demoCheck()){
                return redirect()->back();
            }
            $ids=$request->ids;

            $products=Product::whereIn('id',explode(",",$ids))->get();


            $products->each(function ($product){

                //unlink banner images
                if($product->image !=null && file_exists(public_path() . '/' . $product->image)){
                    unlink(public_path() . '/'. $product->image);
                }

                $product->delete();
            });

            return response()->json(['msg'=>"Product successfully deleted.",'status'=>true]);
        }

    }
