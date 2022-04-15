<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category list
     public function categoryList()
    {
             //session remove
            if(Session::has('CATEGORY_SEARCH')){
                Session::forget('CATEGORY_SEARCH');
            }
        $category=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                            ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                            ->groupBy('categories.category_id','categories.category_name')
                            ->paginate(5);
        // return $category->all();
        if (count($category)==0) {
            $empty_status=0;
        }else {
            $empty_status=1;
        }
        return view('backend.category.category')->with(['category'=>$category,'status'=>$empty_status]);
    }
    // category add
    public function addCategory()
    {
        return view('backend.category.add-category');
    }
    // category create
    public function createCategory(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if ($validator->fails()) {
           return back()
           ->withErrors($validator)
           ->withInput();
        }
        $data=[
            'category_name'=>$request->name,
        ];
        Category::create($data);
        return redirect()->route('admin.category-list')->with(['categorySuccess'=>"Successfully Category Added"]);
    }
    // category edit
    public function editCategory($id)
    {
         $update_category=Category::where('category_id',$id)->first();
         return view('backend.category.update-category')->with(['category'=>$update_category]);
    }
    // category update
    public function updateCategory($id,Request $request)
    {
         $validator=Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if ($validator->fails()) {
           return back()
           ->withErrors($validator)
           ->withInput();
        }
         $update_category=[
            'category_name'=>$request->name,
        ];
        Category::where('category_id',$id)->update($update_category);
        return redirect()->route('admin.category-list')->with(['categoryUpdate'=>"Successfully Category Updated"]);

    }
    // category search
    public function searchCategory(Request $request)
    {
         $search_category=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                                        ->where('categories.category_name','like','%' . $request->search_data . '%')
                                        ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                                        ->groupBy('categories.category_id','categories.category_name')
                                        ->paginate(7);
        Session::put('CATEGORY_SEARCH',$request->search_data);
         if (count($search_category)==0) {
                $empty_status=0;
          }else {
                $empty_status=1;
          }
         $search_category->appends($request->all());
          return view('backend.category.category')->with(['category'=>$search_category,'status'=>$empty_status]);
    }
    // category delete
    public function deleteCategory($id)
    {
       Category::where('category_id',$id)->delete();
      return redirect()->route('admin.category-list')->with(['deleteCategory'=>"Category Deleted Successfully"]);
    }
    // category download
    public function downloadCategory()
    {
        if(Session::has('CATEGORY_SEARCH')){

             $category=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                                            ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                                            ->where('categories.category_name','like','%' . (Session::get('CATEGORY_SEARCH')) . '%')
                                            ->groupBy('categories.category_id','categories.category_name')
                                            ->get(7);

        }else{
            $category=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                                 ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                                 ->groupBy('categories.category_id','categories.category_name')
                                 ->get();
        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($category, [
            'category_id' => 'id',
            'category_name' => 'name',
            'count' => 'Product count',
            'created_at' => 'Create Date',
            'updated_at' => 'Update Date',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'category.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

}
