<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Pagination\Paginator;
use DB;
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
        $products = Product::with(['variants'])->simplePaginate("5");
        Paginator::useBootstrap();
        return view("pos",compact('products'));
    }

    public function saveOrder(Request $request){
        $timeStamp = date("Y-m-d h:i:s");
        $data = [
            'customer_id' => auth()->user()->id,
            'order_date' => $timeStamp,
            'total_items' => $request->total_items,
            'subtotal' => $request->subtotal,
            'tax' => $request->tax,
            'total_amount' => $request->total,
        ];

        DB::beginTransaction();
        try {
           $orderStore = Order::create($data);
           $itemsData = [];
           foreach($request->order_items as $items){
             $items['order_id'] = $orderStore->id;
             $items['created_at'] = $timeStamp;
             $items['updated_at'] = $timeStamp;
             $itemsData[] = $items;
           }
           $itemsInsert = OrderItem::insert($itemsData);
           DB::commit();
           return response()->json([
                'data' => [],
                'success' => true,
                'msg' => "Order Placed Successsfully",
           ],200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return response()->json([
                'data' => [],
                'success' => false,
                'msg' => "There is an error",
           ],500);
        }
    }

    public function orderList(){
        $request = request();
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $orderListQuery = Order::query();
        if($fromDate and $toDate){
            $orderListQuery->whereDate("order_date", ">=", $fromDate);
            if($toDate >= $fromDate){
                $orderListQuery->whereDate("order_date", "<=", $toDate);
            }
        }
        $orderList = $orderListQuery->with([
            'customerInfo:id,name'
        ])->get();
        return view("order-list",compact('orderList','fromDate','toDate')); 
    }

    public function viewOrder($orderId){
        $order = Order::where("id",$orderId)
        ->with([
            'customerInfo:id,name',
            'items',
            'items.product:id,name',
            'items.variant:id,color,size'
       ])->first();
       return view("order-details",compact('order'));
    }
}
