<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\NewPaperResource;
use App\Models\Image;
use App\Models\NewPaper;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    public function popular(){

        $product = Product::where('star','>','0')->paginate();
        $product = $product->sortByDesc('star');
        return HomeResource::collection($product);

    }

    public function images(){
        $image=Image::all();
        return ImageResource::collection($image);
    }
      public function news(){

        $product = NewPaper::orderBy('id','DESC');
        return NewPaperResource::collection($product);

    }
     public function news_add(Request $request){
      $request->validate([
        'name' => 'required',
        'info' => 'required',
        'image' => 'required|image',
    ]);
    $filename = $request->file('image');
    $imagename = "new-papers/" . $filename->getClientOriginalName();
    $filename->move(public_path() . '/storage/new-papers/', $imagename);
    NewPaper::create([
        'image' => $imagename,
        'name'=>  request('name'),
        'info'=>  request('info'),
    ]);
    return response()->json(['success' => true]);

    }
    public function news_update(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'info' => 'required',
            'image' => 'required|image',
        ]);
        $news=NewPaper::find($request->id);
        $destination = 'storage/' . $news->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $filename = $request->file('image');
        $imagename = "new-papers/" . $filename->getClientOriginalName();
        $filename->move(public_path() . '/storage/new-papers/', $imagename);
        NewPaper::find($request->id)->update([
            'image' => $imagename,
            'name'=>  request('name'),
            'info'=>  request('info'),
        ]);
        return response()->json(['success' => true]);

    }
    public function new_updateNoImage(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'info' => 'required',
        ]);
        NewPaper::find($request->id)->update([
            'name'=>  request('name'),
            'info'=>  request('info'),
        ]);
        return response()->json(['success' => true]);
    }
    public function news_delete(Request $request){

        NewPaper::find($request->id)->delete();
        return response()->json(['success' => true]);

    }
}
