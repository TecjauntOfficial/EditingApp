<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
class CategoryController extends Controller
{
    Public function CreateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => $validator->errors()
            
            ], 401);
        }

        $categories = new Category();
        $categories->name = $request->name;
        $categories->date = $request->date;

        if ($request->hasFile('image')) {
            $categories->image = $request->file('image')
                ->storeAs(
                    'image',
                    str_replace(' ', '_', $request->file('image')->getClientOriginalName()),
                    'public'
                );
        }

        $categories->save();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Category created successfully',
            'data' => $categories
        ], 200);

    }

    public function ViewAllCateogires()
    {
        if(Category::all()->isEmpty())
        {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => 'No Categories Found',
            ], 401);
        }
        
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'All Categories',
            'data' => $categories
        ], 200);
    }
}
