<?php

namespace App\Traits;

use App\Models\File;
use App\Models\Image;
use App\Models\ProductDetail;

Trait UploadTrait
{
    /************ upload main image ******************/
    function saveimage($image , $folder , $imageable_id , $imageable_type , $type)
    {
        $albumImage = new Image();
        $fileimagename = time() . '-' . $image->getClientOriginalName();
        $path = $folder;
        $image->move($path , $fileimagename);
        $albumImage->imageable_id = $imageable_id;
        $albumImage->imageable_type = $imageable_type;
        $albumImage->type = $type;
        $albumImage->image = $fileimagename;
        $albumImage->save();
    }
    /************ edit main image ******************/
    function editimage($image , $folder , $imageable_id , $imageable_type , $type)
    {
        $imagee = Image::where('imageable_type' , $imageable_type)->where('type', $type)->where('imageable_id' , $imageable_id)->first();
        if(isset($imagee)){
            @unlink($folder.'/'. $imagee->image);
            $imagee->delete();
        }
        $albumImage = new Image();
        $fileimagename = time() . '-' . $image->getClientOriginalName();
        $path = $folder;
        $image->move($path , $fileimagename);
        $albumImage->imageable_id = $imageable_id;
        $albumImage->imageable_type = $imageable_type;
        $albumImage->type = $type;
        $albumImage->image = $fileimagename;
        $albumImage->save();
    }
    /******* upload multi images *************/
    function saveimages($images , $folder , $imageable_id , $imageable_type , $type)
    {
        foreach ($images as $image){
            $albumImage = new Image();
            $filename = time() . '--' . $image->getClientOriginalName();
            $path = $folder;
            $image->move($path , $filename);
            $albumImage->imageable_id = $imageable_id;
            $albumImage->imageable_type = $imageable_type;
            $albumImage->type = $type;
            $albumImage->image = $filename;
            $albumImage->save();
        }
    }
    /************ edit sub image ******************/
//    function editimages($images , $folder , $imageable_id , $imageable_type , $type)
//    {
//        $imagees = Image::where('imageable_type' , $imageable_type)->where('type', $type)->where('imageable_id' , $imageable_id)->get();
//        foreach ($imagees as $imagee){
//            if(isset($imagee)){
//                @unlink($folder.'/'. $imagee->image);
//                $imagee->delete();
//            }
//        }
//        foreach ($images as $image){
//            $albumImage = new Image();
//            $filename = time() . '--' . $image->getClientOriginalName();
//            $path = $folder;
//            $image->move($path , $filename);
//            $albumImage->imageable_id = $imageable_id;
//            $albumImage->imageable_type = $imageable_type;
//            $albumImage->type = $type;
//            $albumImage->image = $filename;
//            $albumImage->save();
//        }
//    }
    /**************** delete and unlink images ************/
    function deleteimages($id , $path , $imageable_type)
    {
        $images = Image::where('imageable_id' , $id)->where('imageable_type' , $imageable_type)->get();
        foreach($images as $image){
            @unlink($path . $image->image);
            $image->delete();
        }
    }
    /************ upload media ******************/
    function saveDetails($files , $proId , $type)
    {
        foreach ($files as $filee){
            $file = new ProductDetail();
            $file->product_id = $proId;
            if($type == 'size'){
                $file->size_id = $filee;
                $file->type = $type;
            }elseif($type == 'color'){
                $file->color_id = $filee;
                $file->type = $type;
            }
            $file->save();
        }
    }
    /************ edit media ******************/
    function editDetails($files , $proId , $type)
    {
        $old_files = ProductDetail::where('product_id' , $proId)->where('type' , $type)->get();
        foreach ($old_files as $old_file){
            $old_file->delete();
        }
        foreach ($files as $filee){
            $file = new ProductDetail();
            $file->product_id = $proId;
            if($type == 'size'){
                $file->size_id = $filee;
                $file->type = $type;
            }elseif($type == 'color'){
                $file->color_id = $filee;
                $file->type = $type;
            }
            $file->save();
        }
    }
}
