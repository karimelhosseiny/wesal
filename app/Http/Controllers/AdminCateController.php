<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Models\Admin;
use App\Models\DonationCase;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;



class AdminCateController extends Controller
{
    //admin add category
    public function adminaddcategory(Request $request){
            $date = new DateTime();
            DB::table('categories')->insert([
                'title' =>$request->input('title'),
                'description' => $request->input('description'),
                'created_at' =>$date->format('Y-m-d H:i:s'),
                'updated_at'=>$date->format('Y-m-d H:i:s'),
             ]);
            
             return response()->json([
                'message' => 'Category added successfully',
            ], 200);
    }

    //admin update cateogry
    public function adminupdatecategory(Request $request){
        
            $category = Category::find($request->input('category_id'));
            $category->title = $request->input('title');
            $category->description = $request->input('description');
            $category->save();
            $date = new DateTime();
            DB::table('categories')->where('id', $request->input('category_id'))->update([
                'updated_at'=>$date->format('Y-m-d H:i:s'),
             ]);            
        
             return response()->json([
                'message' => 'Category updated successfully',
            ], 200);
    }

    //admin delete category
    public function admindeletecategory(Request $request){
            DB::table('categories')->where('id', $request->input('category_id'))->delete();
            
            return response()->json([
                'message' => 'Category deleted successfully',
            ], 200);
    }
}
