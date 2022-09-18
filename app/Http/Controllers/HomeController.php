<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){


        return Banner::get('image');

    }  public function star(){

        $product = Product::where('star','>','0')->paginate();


        return HomeResource::collection($product);

    }
}
