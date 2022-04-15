<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // order list
    public function orderList()
    {
       $order_list= Order::select('orders.*','users.name as customer_name','pizzas.pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                            ->join('users','users.id','orders.customer_id')
                            ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                            ->groupBy('orders.customer_id','orders.pizza_id')
                            ->paginate();
                //   dd($order_list->toArray());
       return view('backend.order.order-list')->with('order_list',$order_list);
    }
    // order search
    public function orderSearch(Request $request)
    {
        $order_search=Order::select('orders.*','users.name as customer_name','pizzas.pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
                            ->join('users','users.id','orders.customer_id')
                            ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                            ->groupBy('orders.customer_id','orders.pizza_id')
                            ->where('users.name','like','%'.$request->search_order.'%')
                            ->orWhere('pizzas.pizza_name','like','%'.$request->search_order.'%')
                            ->paginate(5);
        $order_search->appends($request->all());
        return view('backend.order.order-list')->with('order_list',$order_search);
    }

}
