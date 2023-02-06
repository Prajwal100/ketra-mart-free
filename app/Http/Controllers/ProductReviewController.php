<?php
    /*==========================================
    =   Author: Prajwal Rai                                 =
    =   Author URI: https://raiprajwal.com                  =
    =   Author GITHUB URI: https://github.com/prajwal100    =
    =   Copyright (c) 2023                                  =
    ==========================================*/
namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewStatus(Request $request){
        if($request->mode=='true'){
            DB::table('product_reviews')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('product_reviews')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }
    public function productReview(Request $request){
        $this->validate($request,[
            'rate'=>'required|numeric',
            'name'=>'required|string',
            'review'=>'nullable|string',
        ]);


        $data=$request->all();

        $data['product_id']=$request->input('product_id');

        $data['status']='active';
        $status=ProductReview::create($data);
        if($status){
            $notify[]=['success','Thanks for your feedback!'];
            return back()->withNotify($notify);
        }
        else{
            $notify[]=['warning','Please try again!'];
            return back()->withNotify($notify);
        }


    }

    public function loadReviews(Request $request,$id){
        if($request->ajax()){
            $skip=$request->skip;
            $take=2;
            $reviews=ProductReview::where(['status'=>'active','product_id'=>$id])->orderBy('id','DESC')->skip($skip)->take($take)->get();
            $data=view('frontend.partials._review_list',compact('reviews'))->render();

            return response()->json(['status'=>true,'data'=>$data,'reviews'=>$reviews]);
        }
        else{
            return response()->json(['status'=>false,'data'=>null]);
        }
    }

    public function index()
    {
        $reviews=ProductReview::orderBy('id','DESC')->get();
        return view('backend.review.index',compact('reviews'));
    }
    public function pendingReview()
    {
        $reviews=ProductReview::where('status','pending')->orderBy('id','DESC')->get();
        return view('backend.review.index',compact('reviews'));
    }

    public function acceptedReview()
    {
        $reviews=ProductReview::where('status','accept')->orderBy('id','DESC')->get();
        return view('backend.review.index',compact('reviews'));
    }

    public function rejectedReview()
    {
        $reviews=ProductReview::where('status','reject')->orderBy('id','DESC')->get();
        return view('backend.review.index',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review=ProductReview::findOrFail($id);
        if($review){
            return view('backend.review.show',compact('review'));
        }
        else{
            $notify[]=['warning','Data not found'];
            return back()->withNotify($notify);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $review=ProductReview::findOrFail($id);
        if($review){
            $status=$review->update(['status'=>$request->input('status')]);
            if($status){
                $notify[]=['success','Successfully updated'];
                return redirect()->route('reviews.index')->withNotify($notify);
            }
            else{
                $notify[]=['error','Something went wrong!'];
                return redirect()->back()->withNotify($notify);            }
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
        $review=ProductReview::find($id);
        if($review){
            $status=$review->delete();
            if($status){
                $notify[]=['success','Successfully deleted!'];
                return redirect()->route('reviews.index')->withNotify($notify);
            }
            else{
                $notify[]=['error','Something went wrong!'];
                return redirect()->back()->withNotify($notify);
            }
        }
        else{
            $notify[]=['warning','Data not found!'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function deleteAll(Request $request){
        if(demoCheck()){
            return redirect()->back();
        }
        $ids=$request->ids;

        $reviews=ProductReview::whereIn('id',explode(",",$ids))->get();

        $reviews->each(function ($review){
            $review->delete();
        });

        return response()->json(['msg'=>"Review successfully deleted.",'status'=>true]);
    }
}
