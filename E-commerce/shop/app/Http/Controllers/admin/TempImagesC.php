<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tempimage;
use Image;


class TempImagesC extends Controller
{
    public function create(Request $req)
    {
        $image=$req->image;

        if(!empty($image))
        {
            $ext = $image->getClientOriginalExtension();
            $newName=time().'.'.$ext;
            
            $ti= new tempimage(); 
            $ti->name = $newName;
            $ti->save();

            $image->move(public_path().'/temp',$newName);

            $sourcePath= public_path().'/temp/'.$newName;
            $destPath= public_path().'/temp/thumb/'.$newName;
            $image = Image::make($sourcePath);
            $image->fit(300,275);
            $image->save($destPath);

            return response()->json([
                'status' => true,
                'image_id' => $ti->id,
                'ImagePath' => asset('/temp/thumb/'.$newName),
                'message' => 'Image Successfully Uploaded!'
            ]);
        }
    }
}
