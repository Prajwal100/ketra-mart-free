<?php

class ImageUploadingHelper{
    private static $mainImgWidth = 700;
    private static $mainImgHeight = 700;


    public static function public_path(){
        return url('/') . DIRECTORY_SEPARATOR;
    }
    public static function real_public_path(){
        return public_path() . DIRECTORY_SEPARATOR;
    }

    public static function UploadImage($destinationPath, $field, $newName='',$width=0,$height=0){
        if($width>0 && $height>0){
            self::$mainImgHeight=$height;
            self::$mainImgWidth=$width;
        }

//        $destinationPath=ImageUploadingHelper::real_public_path() . $destinationPath;
        $extension=$field->getClientOriginalExtension();
        $fileName=\Illuminate\Support\Str::slug($newName,'-') . '-' . time() . '-' . rand(1,999) . '.' . $extension;
        $field->move(public_path($destinationPath),$fileName);

        /************** Start Resizing Images ****************/

//        $imageToResize=\Intervention\Image\Image::make($destinationPath . '/' . $fileName);
//        $imageToResize->resize(self::$mainImgWidth,self::$mainImgHeight,function ($constraint){
//            $constraint->aspectRatio();
//            $constraint->upsize();
//        })->save($destinationPath . '/' . $fileName);

        /************** End Resizing Images ****************/

        return $destinationPath.$fileName;
    }
}
