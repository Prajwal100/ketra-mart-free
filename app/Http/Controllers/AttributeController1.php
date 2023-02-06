<?php

namespace App\Http\Controllers;

use App\Models\AssignProductAttribute;
use App\Models\Attribute;
use App\Models\Color;
use App\Models\Neckline;
use App\Models\Product;
use App\Models\ProductAttributeImage;
use App\Models\Silhouette;
use Illuminate\Http\Request;

class AttributeController1 extends Controller
{

    public function productAttributeAssign($id){
        $product=Product::findOrFail($id);
        return view('backend.product-attribute.assign-product-attribute',compact('product'));
    }

    public function productAttributeAssignAjax(Request $request){
        $data=ProductAttributeImage::where('attribute_id',$request->id)->latest()->pluck('name','id');
        if(count($data)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$data]);
        }

    }

    public function productAttributeAssignSubmit(Request $request){
        $data['product_id']=$request->product_id;
        $data['attribute_id']=$request->attribute_id;
        $data['name']=json_encode($request->child_attribute_id);
        $status=AssignProductAttribute::create($data);
        if($status){
            return back()->with('success','successfully added');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }

    public function productColors($id=null){
        $colors=Color::latest()->get();
        $color=null;
        if($id){
            $color=Color::findOrFail($id);
        }
        return view('backend.product-attribute.index',compact('colors','color'));
    }

    public function productColorsUpdate(Request $request,$id){
        $color=Color::findOrFail($id);
        if($color){
            $status=$color->fill($request->all())->save();
            if($status){
                return redirect()->route('product.colors')->with('success','Colors successfully updated');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Attribute not found');
        }
    }

    public function productColorsSubmit(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:colors,name',
            'code'=>'required|unique:colors,code',
        ]);
        $status=Color::create($request->all());
        if($status){
            return back()->with('success','Color successfully added');
        }
        else{
            return back()->with('error','Something went wrong!');
        }

    }

    public function productColorsDestroy($id){
        $color=Color::findOrFail($id);
        $status=$color->delete();
        if($status){
            return back()->with('success','Color successfully deleted');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }



    public function productAttribute($id=null){
        $attributes=Attribute::all();
        $attribute=null;
        if($id){
            $attribute=Attribute::findOrFail($id);
        }
        return view('backend.product-attribute.product-attribute',compact('attributes','attribute'));
    }

    public function productAttributeSubmit(Request $request){
        $status=Attribute::create($request->all());
        if($status){
            return back()->with('success','Attribute successfully added');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }

    public function productAttributeUpdate(Request $request,$id){
        $attribute=Attribute::findOrFail($id);
        if($attribute){
            $status=$attribute->fill($request->all())->save();
            if($status){
                return redirect()->route('products.attribute')->with('success','Attribute successfully updated');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Attribute not found');
        }
    }

    public function productAttributeDelete($id)
    {
        $attribute=Attribute::findOrFail($id);
        if($attribute){
            $status=$attribute->delete();
            if($status){
                return redirect()->route('products.attribute')->with('success','Attribute successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }

    public function productAttributeImage(Request $request){
        $this->validate($request,[
            'attribute_id'=>'required',
            'name'=>'required|string',
            'icon'=>'image|required',
        ]);

        $data=$request->all();

        if($request->hasFile('icon')){
            if($file=$request->file('icon')){
                $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                $file->storeAs('public/backend/assets/images/attribute/', $imageName);
                $data['icon']='storage/backend/assets/images/attribute/'.$imageName;
            }
        }
        $status=ProductAttributeImage::create($data);
        if($status){
            return back()->with('success','Attributes successfully added');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }

    public function productAttributeImageEdit(Request $request,$id){
        $attribute_img=ProductAttributeImage::findOrFail($id);
        $attributes=Attribute::all();
        $attribute=null;
        return view('backend.product-attribute.product-attribute',compact('attributes','attribute','attribute_img'));
    }

    public function productAttributeImageUpdate(Request $request,$id){
        $attribute_img=ProductAttributeImage::findOrFail($id);
        $this->validate($request,[
            'attribute_id'=>'required',
            'name'=>'required|string',
        ]);

        $data=$request->all();

        if($request->hasFile('icon')){
            if($file=$request->file('icon')){
                $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                $file->storeAs('public/backend/assets/images/attribute/', $imageName);
                $data['icon']='storage/backend/assets/images/attribute/'.$imageName;
            }
        }
        $status=$attribute_img->update($data);
        if($status){
            return back()->with('success','Successfully updated');
        }
        else{
            return back()->with('error','Something went wrong!');
        }

    }


    public function silhouetteAdd(Request $request){
        $this->validate($request,[
            'name'=>'required|string',
            'icon'=>'image|mimes:png,jpg,jpeg,svg,gif|required',
        ]);
        $data=$request->all();
        if($request->hasFile('icon')){
            if($file=$request->file('icon')){
                $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                $file->storeAs('public/backend/assets/images/attribute/', $imageName);
                $data['icon']=$imageName;
                $data['icon_path']='storage/backend/assets/images/attribute/'.$imageName;

            }
        }

        $status=Silhouette::create($data);
        if($status){
            return redirect()->back()->with('success','Successfully created Silhouette');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }

    public function silhouetteDelete(Request $request,$id){
        $item=Silhouette::findOrFail($id);
        if($item){
            $status=$item->delete();
            if($status){
                return redirect()->back()->with('success','Successfully deleted Silhouette');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }
        abort(404);
    }

    public function necklineAdd(Request $request){
        $this->validate($request,[
            'name'=>'required|string',
            'icon'=>'image|mimes:png,jpg,jpeg,svg,gif|required',
        ]);
        $data=$request->all();
        if($request->hasFile('icon')){
            if($file=$request->file('icon')){
                $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                $file->storeAs('public/backend/assets/images/attribute/', $imageName);
                $data['icon']=$imageName;
                $data['icon_path']='storage/backend/assets/images/attribute/'.$imageName;

            }
        }

        $status=Neckline::create($data);
        if($status){
            return redirect()->back()->with('success','Successfully created Neckline');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }

    public function necklineDelete(Request $request,$id){
        $item=Neckline::findOrFail($id);
        if($item){
            $status=$item->delete();
            if($status){
                return redirect()->back()->with('success','Successfully deleted Neckline');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }
        abort(404);
    }

}
