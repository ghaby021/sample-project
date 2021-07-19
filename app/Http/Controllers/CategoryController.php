<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function AllCat(){
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index', compact('categories','trashCat'));


    }
    //Add Category
    public function AddCat(Request $request){
        //validation
        $validatedData = $request->validate([
            'category_name'=> 'required|unique:categories|max:255',

            ],
    
            [
            'category_name.required'=> 'Please Input Category Name',
            'category_name.max'=> 'Category Name must be less tahn 255 char',    
            ]
    
        );
        //create data
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

         //send response

         return Redirect()->back()->with('success','Category Inserted Successfully');

    }
    
     //Edit Category
    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));


    }
        //Update Category
    public function UpdateCat(Request $request, $id){
       $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id



       ]);
       //send response
       return Redirect()->route('all.category')->with('success','Category Updated Successfull');
    
    }

    //softdelete
    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete Successfully');

    }
    //restore category
    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Successfully');

    }
    //permanent delete
    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted');


    }


}
