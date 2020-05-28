<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Image;

class ImageController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $image = new Image();
        $this->validate($request,[
          'path' => 'required|image'
        ]);

        $filenameWithExtension = $request->file('path')->getClientOriginalName();

        $fileName = pathinfo($filenameWithExtension, PATH_FILENAME);

        $extension = $request->file('path')->getClientOriginalExtension();

        $filenameToStore = $filename . '_' .time(). '.' .$extension;

        $request->file('path')->storeAs('public/phones/' . $request->input('image-id'), $filenameToStore);

        $image = new Image();
        $image->image = $filenameToStore;
        $image->phone_id = $request->input('album-id');
        $image->save();

        return redirect('/phones/'. $request->input('phone-id'))->with('succeses', 'Photo uploaded successfuly');
    }
}
