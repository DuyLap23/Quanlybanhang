<?php

namespace App\Http\Controllers;

use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::query()->where(["is_active" => 1])->orderBy("id","desc")->limit(12)->get();
        $productNew = Product::query()->where(["is_active" => 1 ,"is_new"=>1])->orderBy("id","desc")->get();

        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $catalogue = Catelogue::query()->get();

//         dd($products);
        return view('client.home.home' ,compact("products","productNew","catalogue","colors","sizes")); ;
    }
}
