<?php

    /*==========================================
    =   Author: Prajwal Rai            =
    =   Author URI: https://raiprajwal.com
    =   Author GITHUB URI: https://github.com/prajwal100
    =   Copyright (c) 2023            =
    ==========================================*/

    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\Display;
    use Brian2694\Toastr\Facades\Toastr;
    use CategoryHelper;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories=Category::orderBy('id','DESC')->get();
            return view('backend.category.index',compact('categories'));
        }

        public function categoryStatus(Request $request){
            if($request->mode=='true'){
                DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
            }
            else{
                DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
            }
            return response()->json(['msg'=>'Successfully updated status','status'=>true]);
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
            return view('backend.category.create',compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            if(demoCheck()){
                return redirect()->back();
            }
            $this->validate($request,[
                'title'=>'bail|string|required',
                'slug'=>'bail|string|required',
                'featured'=>'sometimes|in:1',
                'is_menu'=>'sometimes|in:1',
                'icon'=>'bail|image|nullable|mimes:png,jpg,jpeg,svg,gif',
                'banner'=>'bail|image|nullable|mimes:png,jpg,jpeg,svg,gif',
                'status'=>'bail|required|in:active,inactive'
            ]);
            $data=$request->all();

            $data['meta_title']=$request->input('meta_title') ?? $request->input('title');

            //Mobile menu icon
            if($request->hasFile('icon')){
                if($file=$request->file('icon')){
                    $fileName=\ImageUploadingHelper::UploadImage('backend/assets/img/category/',$file,$request->input('title'),300,300);

                    $data['icon']=$fileName;
                }
            }

            if($request->hasFile('banner')){
                if($file=$request->file('banner')){
                    $fileName=\ImageUploadingHelper::UploadImage('backend/assets/img/category/',$file,$request->input('title'),300,300);

                    $data['banner']=$fileName;
                }
            }
            if ($request->parent_id != "0") {
                $data['is_parent'] = $request->parent_id;

                $parent = Category::find($request->parent_id);
                $data['level'] = $parent->level + 1 ;
            }
            $preCat=Category::where(['position'=>$request->position])->first();
            if($preCat){
                $preCat->update(['position'=>0]);
            }
            $data['position']=$request->position ?? Category::max('position')+1;
            $data['featured']=$request->input('featured',0);
            $data['is_menu']=$request->input('is_menu',0);
            $status=Category::create($data);
            if($status){
                $notify[]=['success','Successfully created'];
                return redirect()->route('categories.index')->withNotify($notify);
            }
            else{
                $notify[]=['error','Something went wrong'];
                return redirect()->back()->withNotify($notify);
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
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $category = Category::findOrFail($id);
            $categories = Category::where('parent_id', 0)
                ->with('childrenCategories')
                ->whereNotIn('id', CategoryHelper::children_ids($category->id, true))->where('id', '!=' , $category->id)
                ->orderBy('title','asc')
                ->get();
            if($category){
                return view('backend.category.edit',compact(['categories','category']));
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
            if(demoCheck()){
                return redirect()->back();
            }
            $category=Category::find($id);
            $previous_level = $category->level;
            if($category){
                $this->validate($request,[
                    'title'=>'bail|string|required',
                    'slug'=>'bail|string|required',
                    'featured'=>'sometimes|in:1',
                    'is_menu'=>'sometimes|in:1',
                    'icon'=>'bail|image|nullable|mimes:png,jpg,jpeg,svg,gif',
                    'banner'=>'bail|image|nullable|mimes:png,jpg,jpeg,svg,gif',
                    'status'=>'bail|required|in:active,inactive',
                ]);

                $data=$request->all();

                if ($request->parent_id != "0") {
                    $category->parent_id = $request->parent_id;

                    $parent = Category::find($request->parent_id);
                    $category->level = $parent->level + 1 ;
                }
                else{
                    $category->parent_id = 0;
                    $category->level = 0;
                }

                if($category->level > $previous_level){
                    CategoryHelper::move_level_down($category->id);
                }
                elseif ($category->level < $previous_level) {
                    CategoryHelper::move_level_up($category->id);
                }
                //mobile menu icon
                if($request->hasFile('icon')){
                    if($file=$request->file('icon')){

                        if($category->icon !=null && file_exists(public_path() . '/' . $category->icon)){
                            unlink(public_path() . '/'. $category->icon);
                        }

                        $iconName=\ImageUploadingHelper::UploadImage('backend/assets/img/category/',$file,$request->input('title'),300,300);

                        $data['icon']=$iconName;
                    }
                }

                if($request->hasFile('banner')){
                    if($file=$request->file('banner')){
                        if($category->banner !=null && file_exists(public_path() . '/' . $category->banner)){
                            unlink(public_path() . '/'. $category->banner);
                        }

                        $fileName=\ImageUploadingHelper::UploadImage('backend/assets/img/category/',$file,$request->input('title'),300,300);

                        $data['banner']=$fileName;
                    }
                }


                if($request->featured==1){
                    $data['featured']=null;
                }

                if($request->is_menu==1){
                    $data['is_menu']=null;
                }
                $preCat=Category::where(['position'=>$request->position])->first();
                if($preCat){
                    $preCat->update(['position'=>$category->position]);
                }
                $data['position']=$request->position;
                $data['featured']=$request->input('featured',0);
                $data['is_menu']=$request->input('is_menu',0);
                $data['meta_title']=$request->input('meta_title') ?? $request->input('title');

                $status=$category->fill($data)->save();
                if($status){
                    $notify[]=['success','Successfully updated'];
                    return redirect()->route('categories.index')->withNotify($notify);
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
            if(demoCheck()){
                return redirect()->back();
            }
            $category=Category::find($id);
            if($category){

                if($category->banner !=null && file_exists(public_path() . '/' . $category->banner)){
                    unlink(public_path() . '/'. $category->banner);
                }

                if($category->icon !=null && file_exists(public_path() . '/' . $category->icon)){
                    unlink(public_path() . '/'. $category->icon);
                }
                CategoryHelper::delete_category($id);
                $notify[]=['success','Successfully deleted'];
                return redirect()->route('categories.index')->withNotify($notify);

            }
            else{
                $notify[]=['error','Something went wrong!'];
                return redirect()->back()->withNotify($notify);
            }
        }

        public function deleteAll(Request $request){
            if(demoCheck()){
                return redirect()->back();
            }
            $ids=$request->ids;

            $categories=Category::whereIn('id',explode(",",$ids))->get();

            $categories->each(function ($category){

                //unlink banner images
                if($category->banner !=null && file_exists(public_path() . '/' . $category->banner)){
                    unlink(public_path() . '/'. $category->banner);
                }

                if($category->icon !=null && file_exists(public_path() . '/' . $category->icon)){
                    unlink(public_path() . '/'. $category->icon);
                }

                CategoryHelper::delete_category($category->id);

            });

            return response()->json(['msg'=>"Brand successfully deleted.",'status'=>true]);
        }

    }
