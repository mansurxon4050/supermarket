<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\NewPaperResource;
use App\Models\Banner;
use App\Models\Image;
use App\Models\NewPaper;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function popular(){

        $product = Product::where('star','>','0')->paginate();
        return HomeResource::collection($product);
    }
    public function images(){

        $product = Image::all();
        return ImageResource::collection($product);
    }
      public function news(){

        $product = NewPaper::all();
        return NewPaperResource::collection($product);

    }
}
