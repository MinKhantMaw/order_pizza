<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    // pizza list
    public function pizzaList()
    {
        // session remove
        if(Session::has('PIZZA_SEARCH')){
            Session::forget('PIZZA_SEARCH');
        }
        $pizza=Pizza::paginate(5);
        if (count($pizza) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }
        return view('backend.pizza.pizza')->with(['pizza' => $pizza, 'status' => $emptyStatus]);
    }
    // pizza create
    public function pizzaCreate()
    {
         $pizza = Category::get();
        return view('backend.pizza.create-pizza')->with(['category'=>$pizza]);
    }
    // pizza add
    public function pizzaAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOnegetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $image = $request->file('image');
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->move(public_path() . '/image/', $imageName);

        $data = $this->requestPizzaData($request, $imageName);
        Pizza::create($data);
        return redirect()->route('admin.pizza-list')->with(['create' => "Pizza Created"]);
    }
    // pizza details
    public function pizzaDetail($id)
    {
        $pizza=Pizza::where('pizza_id',$id)->first();
        $category=Category::get();
        return view('backend.pizza.pizza-detail')->with(['pizza'=>$pizza,'category'=>$category]);
    }
    // pizza edit
    public function pizzaEdit($id)
    {
        $category=Category::get();
        $pizza_edit=Pizza::select('pizzas.*','categories.category_name','categories.category_id')
                            ->join('categories','pizzas.category_id','categories.category_id')
                            ->where('pizza_id',$id)
                            ->first();
        return view('backend.pizza.pizza-edit')->with(['pizza'=>$pizza_edit,'category'=>$category]);
    }
    // pizza update
    public function pizzaUpdate(Request $request,$id)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOnegetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = $this->requestUpdatePizzaData($request);
        if (isset($updateData['image'])) {

            // get old image from pizza table
            $image = Pizza::select('image')->where('pizza_id', $id)->first();
            $imageName = $image['image'];

            // old image delete from pizza table
            if (File::exists(public_path() . '/image/' . $imageName)) {
                File::delete(public_path() . '/image/' . $imageName);
            }

            // create new image
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path() . '/image/', $imageName);
            $updateData['image'] = $imageName;
            //  dd($updateData['image']);
            // image update
            Pizza::where('pizza_id', $id)->update($updateData);
            // dd("image update ok");
            return redirect()->route('admin.pizza-list')->with(['update' => 'Successfully Pizza Updated']);
        } else {
            Pizza::where('pizza_id', $id)->update($updateData);
            return redirect()->route('admin.pizza-list')->with(['update' => 'Successfully Pizza Updated']);
        }
    }
    // pizza delete
     public function pizzaDelete($id)
    {
        // image delete CODE
        $data = Pizza::select('image')->where('pizza_id', $id)->first();
        $imageName = $data['image'];
        Pizza::where('pizza_id', $id)->delete(); //database delete
        if (File::exists(public_path() . '/image/' . $imageName)) {
            File::delete(public_path() . '/image/' . $imageName);
        }
        return back()->with(['delete' => 'Pizza Deleted']);
    }
    // pizza search
    public function pizzaSearch(Request $request)
    {
        $search_pizza=Pizza::where('pizza_name','like','%' . $request->search_data . '%')
                            ->Orwhere('price','like','%' . $request->search_data . '%')
                            ->paginate(5);
            $search_pizza->appends($request->all());
            Session::put('PIZZA_SEARCH',$search_pizza);
    if (count($search_pizza) == 0) {
        $empty_status = 0;
    } else {
        $empty_status = 1;
    }
        $search_pizza->appends($request->all());
       return view('backend.pizza.pizza')->with(['pizza'=>$search_pizza,'status'=>$empty_status]);
    }
    // category item
    public function categoryItem($id)
    {
            $pizza=Pizza::where('category_id',$id)->paginate(5);
            return view('backend.category.category-item')->with(['pizza'=>$pizza]);
    }
    // pizza csv download
     public function downloadPizza()
    {
        if (Session::has('PIZZA_SEARCH')) {
            $pizza=Pizza::where('pizza_name','like','%' . Session::get('PIZZA_SEARCH') . '%')
                            ->Orwhere('price','like','%' . Session::get('PIZZA_SEARCH') . '%')
                            ->get();
        }else{
            $pizza = Pizza::get();
        }

        // dd($pizza->toArray());

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($pizza, [
            'pizza_id' => 'id',
            'pizza_name' => 'name',
            'price' => 'price',
            'discount_price' => 'Discount Price',
            'buy_one_get_one_status'=>'Buy One Get One',
            'waiting_time'=>'Waiting Time',
            'publish_status'=>'Publish Status',
            'description'=>'Description',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'pizza.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
    private function requestPizzaData($request, $imageName)
    {
        return [
            'pizza_name' => $request->name,
            'image' => $imageName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOnegetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
    private function requestUpdatePizzaData($request)
    {
        $arr = [
            'pizza_name' => $request->name,
            // 'image' => $imageName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOnegetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->image)) {
            $arr['image'] = $request->image;
        }
        return $arr;
    }

}
