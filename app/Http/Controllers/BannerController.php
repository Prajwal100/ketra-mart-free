<?php

    /*==========================================
    =   Author: Prajwal Rai            =
    =   Author URI: https://raiprajwal.com
    =   Author GITHUB URI: https://github.com/prajwal100
    =   Copyright (c) 2023            =
    ==========================================*/

    namespace App\Http\Controllers;

    use App\Models\Banner;
    use App\Models\Promo;
    use Brian2694\Toastr\Facades\Toastr;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class BannerController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        public function index()
        {
            $banners=Banner::orderBy('id','DESC')->get();
            return view('backend.banners.index',compact('banners'));
        }

        public function homeBanner()
        {
            $banners=Banner::where('banner_type','home')->orderBy('id','DESC')->get();
            return view('backend.banners.index',compact('banners'));
        }

        public function popupBanner()
        {
            $banners=Banner::where('banner_type','popup')->orderBy('id','DESC')->get();
            return view('backend.banners.index',compact('banners'));
        }

        public function promoBanner()
        {
            $banners=Banner::where('banner_type','promo')->orderBy('id','DESC')->get();
            return view('backend.banners.index',compact('banners'));
        }


        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('backend.banners.create');

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
                'image'=>'required|image|mimes:png,jpg,gif,jpeg,svg,webp',
                'banner_type'=>'required|in:home,popup,promo',
                'status'=>'required|in:active,inactive',
            ],[
                'banner_type.required'=>'Banner type is required',
            ]);
            $data=$request->all();

            if($request->hasFile('image')){
                if($file=$request->file('image')){

                    $imageName=\ImageUploadingHelper::UploadImage('backend/assets/img/banners/',$file,Str::random(5));

                    $data['image']=$imageName;
                }
            }
            $status=Banner::create($data);
            if($status){
                $notify[]=['success','Successfully created'];
                return redirect()->route('banner.index')->withNotify($notify);
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
            if(demoCheck()){
                return redirect()->back();
            }
            $banner=Banner::find($id);
            if($banner){
                return view('backend.banners.edit',compact('banner'));
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

            $banner=Banner::find($id);
            if($banner){
                $this->validate($request,[
                    'image'=>'nullable|image|mimes:png,jpg,gif,jpeg,svg,webp',
                    'banner_type'=>'required|in:home,popup,promo',
                    'status'=>'required|in:active,inactive',
                ]);
                $data=$request->all();
                if($request->hasFile('image')){
                    if($file=$request->file('image')){

                        if($banner->image !=null && file_exists(public_path() . '/' . $banner->image)){
                            unlink(public_path() . '/'. $banner->image);
                        }

                        $imageName=\ImageUploadingHelper::UploadImage('backend/assets/img/banners/',$file,Str::random(5));

                        $data['image']=$imageName;
                    }
                }

                $status=$banner->fill($data)->save();
                if($status){
                    $notify[]=['success','Successfully updated'];
                    return redirect()->route('banner.index')->withNotify($notify);
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
            $banner=Banner::findOrFail($id);
            if($banner){

                if($banner->image !=null && file_exists(public_path() . '/' . $banner->image)){
                    unlink(public_path() . '/'. $banner->image);
                }

                $status=$banner->delete();
                if($status){
                    $notify[]=['success','Successfully deleted'];
                    return redirect()->back()->withNotify($notify);
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

            $banners=Banner::whereIn('id',explode(",",$ids))->get();


            $banners->each(function ($banner){

                //unlink banner images
                if($banner->image !=null && file_exists(public_path() . '/' . $banner->image)){
                    unlink(public_path() . '/'. $banner->image);
                }

                $banner->delete();
            });

            return response()->json(['msg'=>"Banner successfully deleted.",'status'=>true]);
        }
    }
