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
        if (Gate::allows('isAdmin')){
            $date = new DateTime();
            DB::table('categories')->insert([
                'title' =>$request->input('title'),
                'description' => $request->input('description'),
                'created_at' =>$date->format('Y-m-d H:i:s'),
                'updated_at'=>$date->format('Y-m-d H:i:s'),
             ]);
            }
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
            }
    }
    //admin update cateogry
    public function adminupdatecategory(Request $request){
        if (Gate::allows('isAdmin'))
        {
            $category = Category::find($request->input('category_id'));
            $category->title = $request->input('title');
            $category->description = $request->input('description');
            $category->save();
            $date = new DateTime();
            DB::table('categories')->where('id', $request->input('category_id'))->update([
                'updated_at'=>$date->format('Y-m-d H:i:s'),
             ]);            
        }  
        else
        {
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
        }
    }
    //admin delete category
    public function admindeletecategory(Request $request){
        if (Gate::allows('isAdmin')){
            DB::table('categories')->where('id', $request->input('category_id'))->delete();
            }
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
            }
    }
}
