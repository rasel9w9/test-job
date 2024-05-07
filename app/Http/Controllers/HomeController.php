<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Pagination\Paginator;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('home');
    }

    public function productEntry(){
        return view("product-entry");
    }

    public function saveProduct(Request $request){
        $data = $request->all();
        if($request->image){
            $extension = $request->file("image")->getClientOriginalExtension();
            $imageName = $request->file("image")->storeAs('public/product_images',time().".$extension");
            $imageName = str_replace("public/","",$imageName);
        }else{
            $imageName = null;
        }
        $data['image'] = $imageName;
        $productStore = Product::create($data);
        $variantsData = [];
        if($request->has_variants){
            $timeStamp = date("Y-m-d h:i:s");
            foreach($request->variant_color as $key=>$color){
                $data = [];
                $data['product_id'] = $productStore->id;
                $data['color'] = $color;
                $data['size'] = $request->variant_size[$key];
                $data['price'] = $request->variant_price[$key];
                $data['created_at'] = $timeStamp;
                $data['updated_at'] = $timeStamp;
                $variantsData[] = $data;
            }
        }
        if(count($variantsData) > 0){
            ProductVariant::insert($variantsData);
        }
        return redirect()->back()->with("successMessage","Product Stored");
    }

    public function pointOfSale(){
        $products = Product::with(['variants'])->simplePaginate("4");
        Paginator::useBootstrap();
        return view("pos",compact('products'));
    }

    public function orderList(){
       return view("order-list"); 
    }
}
