<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;

class PhonesController extends Controller
{

  public function __construct()
  {
      $this->middleware(['auth', 'verified']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$phones = Auth::user()->phones;
        //$phones = $phones->paginate(4);
        $phones = Phone::where('user_id', [Auth::id()])->paginate(4);

        return view('yourPhones')->with('phones', $phones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($phoneId)
    {
        return view('create')->with('phoneid', $phoneId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required',
            'model' => 'required',
            'screenSize' => 'required',
            'ramSize' => 'required',
            'storageSize' => 'required',
            'color' => 'required',
            'price' => 'required'
        ]);



        $phone = new Phone();
        $phone->user_id = Auth::id();
        $phone->brand = $request->input('brand');
        $phone->model = $request->input('model');
        $phone->screenSize = $request->input('screenSize');
        $phone->ramSize = $request->input('ramSize');
        $phone->storageSize = $request->input('storageSize');
        $phone->color = $request->input('color');
        $phone->price = $request->input('price');



        $paths = request()->file('paths');
        if($paths != null){
          foreach ($paths as $path) {
            $filenameWithExtension = $path->getClientOriginalName();

            $fileName = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $path->getClientOriginalExtension();

            $filenameToStore = $fileName . '_' . time(). '.' .$extension;

            $path->storeAs('public/phones/' . $request->input('phone_id'), $filenameToStore);

            $image = new Image();
            $image->path = $filenameToStore;
            $this->validate($request,[
              'path' => 'image'
            ]);
            $phone->save();
            $image->phone_id = $phone->id;

            $image->save();
          }

        }
        else{
          $image = new Image();
          $image->path = 'standart.jpg';
          $this->validate($request,[
            'paths' => 'image'
          ]);
          $phone->save();
          $image->phone_id = $phone->id;

          $image->save();
        }


        return redirect()->to('home')->with('success', 'Phone added succesfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phone = Phone::with('images')->find($id);
        $user = Auth::user();
        //dd($phone);
        return view('show', compact('phone', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()){
        $phone = Phone::find($id);
        return view('edit')->with('phone', $phone);
      }
      else{
        return redirect('/login');
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
      $this->validate($request, [
          'brand' => 'required',
          'model' => 'required',
          'screenSize' => 'required',
          'ramSize' => 'required',
          'storageSize' => 'required',
          'color' => 'required',
          'price' => 'required'
      ]);

      $phone = Phone::find($id);
      $phone->user_id = Auth::id();
      $phone->brand = $request->input('brand');
      $phone->model = $request->input('model');
      $phone->screenSize = $request->input('screenSize');
      $phone->ramSize = $request->input('ramSize');
      $phone->storageSize = $request->input('storageSize');
      $phone->color = $request->input('color');
      $phone->price = $request->input('price');
      $phone->save();

      $paths = request()->file('paths');
      if($paths != null){
        $images = Image::where('phone_id', $id)->get();
        foreach($images as $image){
          Image::where('phone_id', $id) -> firstOrFail() -> delete();
        }
        foreach ($paths as $path) {
          $filenameWithExtension = $path->getClientOriginalName();

          $fileName = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

          $extension = $path->getClientOriginalExtension();

          $filenameToStore = $fileName . '_' . time(). '.' .$extension;

          $path->storeAs('public/phones/' . $request->input('phone_id'), $filenameToStore);

          $image = new Image();
          $image->path = $filenameToStore;
          $this->validate($request,[
            'path' => 'image'
          ]);
          $phone->save();
          $image->phone_id = $phone->id;

          $image->save();
        }
      }




      return redirect()->to('yourPhones')->with('success', 'Phone updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = Phone::find($id);
        $phone->delete();

        return redirect('/yourPhones')->with('success', 'Phone deleted succesfully');
    }

    public function search (Request $request)
    {
      $request->validate([
        'query' => 'required'
      ]);

      $query = $request->input('query');

      $phones = Phone::where('brand', 'like', "%$query%")
                      ->orWhere('model', 'like', "%$query%")
                      ->orWhere('ramSize', 'like', "$query")
                      ->orWhere('screenSize', 'like', "$query")
                      ->orWhere('price', 'like', "$query")
                      ->paginate(4);

      //$phones = Phone::search($query)->paginate(4);



      //$phones = Phone::with('images')->paginate(4);

      return view('home')->with('phones', $phones);
    }

    public function cheapests(Request $request){
      $phones = Phone::where('price', '<=', 200)->paginate(4);
      return view('home')->with('phones', $phones);
    }

    public function forGaming(Request $request){
      $phones = Phone::where([
        ['ramSize', '>=', 6],
        ['storageSize', '>=', 120],
        ['screenSize', '>=', 6]
      ])->paginate(4);
     return view('home')->with('phones', $phones);
  }
}
