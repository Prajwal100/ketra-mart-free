<?php

    /*==========================================
    =   Author: Prajwal Rai                                 =
    =   Author URI: https://raiprajwal.com                  =
    =   Author GITHUB URI: https://github.com/prajwal100    =
    =   Copyright (c) 2023                                 =
    ==========================================*/

    namespace App\Http\Controllers;
    use File;

    use App\Models\Media;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Str;

    class FilemanagerController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth:admin');
        }

        public function media(){
            if(isset($_GET['target_id'])){
                Session::put('target_id', $_GET['target_id']);
                $target_id = Session::get('target_id');
            }else{
                $target_id = Session::get('target_id');
            }

//        $user_id = Session::get('seller_id');
            $user_id = Auth::guard('admin')->user()->id;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 18;

            $file_data = array();
            $data['images'] = array();
            // Get files from DB
            $files = Media::where('admin_id',$user_id)->orderBy('id','DESC')->get()->toArray();
            foreach ($files as $value) {
                $file_data[] = asset('storage/images/products/'.$value['file_name']);
            }
            $image_total = count($file_data);
            $images = array_splice($file_data, ($page - 1) * $limit, $limit);

            foreach ($images as $image) {

                $name = basename($image);
                $file = Media::where('file_name',$name)->get()->toArray();
                $file_title = $file[0]['title'];

                $data['images'][] = array(
                    'name'  => $name,
                    'title' => $file_title,
                    'type'  => 'image',
                    'image_path'  => 'storage/images/products/'.$name,
                    'href'  => asset('storage/images/products/'.$name)
                );
            }

            $num_pages = ceil($image_total / $limit);

            return view('backend.media.index')->with('media_files',$data)
                ->with('target_id',$target_id)
                ->with('page',$page)
                ->with('num_pages',$num_pages)
                ->with('total_data',$image_total)
                ->with('limit',$limit);
        }

        public function index(){

            if(isset($_GET['target_id'])){
                Session::put('target_id', $_GET['target_id']);
                $target_id = Session::get('target_id');
            }else{
                $target_id = Session::get('target_id');
            }
            $user_id = Auth::guard('admin')->user()->id;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 18;

            $file_data = array();
            $data['images'] = array();
            // Get files from DB
            $files = Media::where('admin_id',$user_id)->orderBy('id','DESC')->get()->toArray();
            foreach ($files as $value) {
                $file_data[] = asset('storage/images/products/'.$value['file_name']);
            }
            $image_total = count($file_data);
            $images = array_splice($file_data, ($page - 1) * $limit, $limit);

            foreach ($images as $image) {

                $name = basename($image);
                $file = Media::where('file_name',$name)->get()->toArray();
                $file_title = $file[0]['title'];

                $data['images'][] = array(
                    'name'  => $name,
                    'title' => $file_title,
                    'type'  => 'image',
                    'image_path'  => 'storage/images/products/'.$name,
                    'href'  => asset('storage/images/products/'.$name)
                );
            }

            $num_pages = ceil($image_total / $limit);

            return view('backend.filemanager')->with('media_files',$data)
                ->with('target_id',$target_id)
                ->with('page',$page)
                ->with('num_pages',$num_pages)
                ->with('total_data',$image_total)
                ->with('limit',$limit);

        }

        public function upload_file(Request $request){
            $user_id = Auth::guard('admin')->user()->id;
            $PATH = 'public/images/products/';
//            $this->validate($request, [
//                'file_name' => 'required|mimes:mp4,pdf,jpeg,png,jpg,gif,svg|max:2048',
//            ]);

//            dd($request->file_name);
            if($files=$request->file('file_name')){
                foreach($files as $file){
                    $input['file_name'] = Str::random(5).'-'.time().'.'.$file->getClientOriginalExtension();
                    $file->storeAs($PATH, $input['file_name']);
                    $saveLocation = storage_path('app/public/images/products/'.$input['file_name']);
                    $input['title'] = $file->getClientOriginalName();
                    $image = \Intervention\Image\Facades\Image::make($file);
                    $image->resize(640,960);
                    $image->save($saveLocation);
                    $input['admin_id'] = $user_id;
                    $result = Media::create($input);
                }
            }

            $response['success'] = "File Uploaded successfully";

            echo json_encode($response);
        }


        public function delete(Request $request){

            $paths = $request->input('path');
            $paths = explode(",",$paths);
            foreach ($paths as $path) {
                Media::where('file_name',$path)->delete();
            }
            $response['success'] = 'File Deleted successfully';
            echo json_encode($response);
        }

        public function permanentDelete(Request $request){

            $paths = $request->input('path');
            $paths = explode(",",$paths);
            foreach ($paths as $path) {

                $file_path = 'storage/images/products/'.$path;
                Media::where('file_name',$path)->delete();
                File::delete($file_path);
            }
            $response['success'] = 'File Deleted successfully';
            echo json_encode($response);
        }
    }
