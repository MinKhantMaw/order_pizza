<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // list page
    public function index()
    {
        $pizza=Pizza::where('publish_status',0)->paginate(9);
         if (count($pizza)==0) {
            $emptyStatus=0;
        }else {
            $emptyStatus=1;
        }
        $category=Category::get();
        return view('frontend.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=>$emptyStatus]);
    }
    // pizza details page
    public function pizzaDetail($id)
    {
        $pizza=Pizza::where('pizza_id',$id)->first();
        Session::put('PIZZA_INFO',$pizza);
        return view('frontend.pizza-detail')->with(['pizza'=>$pizza]);
    }
    // category search
    public function categorySearch($id)
    {
        $pizza=Pizza::where('category_id',$id)->paginate(9);

        if (count($pizza)==0) {
            $emptyStatus=0;
        }else {
            $emptyStatus=1;
        }
        $category=Category::get();
        return view('frontend.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=>$emptyStatus]);
    }
    // pizza search
    public function pizzaSearch(Request $request)
    {
       $pizza=Pizza::where('pizza_name','like','%'.$request->search_pizza.'%')->paginate(9);
        if (count($pizza)==0) {
            $emptyStatus=0;
        }else {
            $emptyStatus=1;
        }
        $pizza->appends($request->all());
        $category=Category::get();
        return view('frontend.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=>$emptyStatus]);
    }
    // price search
    public function priceSearch(Request $request)
    {
        $min_price=$request->min_price;
        $max_price=$request->max_price;

        $query_price=Pizza::select('*');

        if(!is_null($min_price) && is_null($max_price))
        {
           $query= $query_price->where('price','>=',$min_price);
        }else if(is_null($min_price) && !is_null($max_price))
        {
            $query= $query_price->where('price','<=',$max_price);
        }else if(!is_null($min_price) && !is_null($max_price))
        {
            $query=$query_price->where('price','>=',$min_price)
                                ->where('price','<=',$max_price);
        }

        $query=$query_price->paginate(9);
         if(count($query)==0)
        {
            $emptyStatus=0;
        }else {
            $emptyStatus=1;
        }
        $category=Category::get();
        $query->appends($request->all());
        return view('frontend.home')->with(['pizza'=>$query,'category'=>$category,'status'=>$emptyStatus]);
    }
    // pizza order data get session
    public function pizzaOrder($id)
    {
        $pizza_info=Session::get('PIZZA_INFO');

        return view('frontend.order')->with(['pizza'=>$pizza_info]);
    }
    // order pizza
    public function orderCreate(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'pizzaCount' => 'required',
            'payment' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $pizza_info=Session::get('PIZZA_INFO');
        $count=$request->pizzaCount;
        $user_id=auth()->user()->id;
        $order_data=$this->requestOrderData($request,$pizza_info,$user_id);
        for($i=0;$i<$count;$i++)
        {
           Order::create($order_data);
        }
        $waitingTime=$pizza_info['waiting_time'] * $count;
        return back()->with('totalTime',$waitingTime);
    }
    private function requestOrderData($request,$pizza_info,$user_id)
    {
        return[
            'customer_id' => $user_id,
            'pizza_id' => $pizza_info['pizza_id'],
            'payment_status'=>$request->payment,
            'order_time'=>Carbon::now()
        ];
    }

}
