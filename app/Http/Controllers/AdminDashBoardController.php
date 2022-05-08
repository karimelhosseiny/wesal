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


class AdminDashBoardController extends Controller
{
    public function userDashBoard(){
        $totalusers = DB::table('users')->count();
        $totaldonations = DB::table('donation_operations')->count();
        $users = DB::table('users')->select('id','name','image','email','address','phonenumber','type')->get();
        return response()->json([
            'Total Users' => $totalusers,
            'Total Donations' => $totaldonations,
            'Users' => $users
        ]);
    }
    public function cateDashBoard(){
        $totalcategories = DB::table('categories')->count();
        $categories =  DB::table('categories')->select('id','title','description')->get();
        
        // $cases = DB::table('categories')
        //         ->join('Donation_cases' ,'categories.id','=', 'Donation_cases.category_id')
        //         ->get();

        //         $cases = DonationCase::selectRaw('count(id) as count')
        //         ->where('donation_cases.category_id', '?')
        //         ->toSql();
         
        //  $n = Category::selectRaw(DB::raw("categories.*, ({$cases}) as case_count"))
        //         ->setBindings([true, DB::raw('categories.id')], 'select')
        //         ->get();

        // $n = DonationCase::join('categories','donation_cases.category_id','=','categories.id')
        // //->where('posts.type','=','politics')
        // //->where('users.account_type','=','active')
        // //->where('posts.date','=','Your selected date')
        // ->select('donation_cases.*')
        // ->get();

        // $categories = Category::all();
 
        // $cases= DonationCase::categories()($categories)->get();
        // $users = DB::table('users')->whereIn('id', array(1, 2, 3))->get();

        // $categories = Category::all();
        // $cases = $categories->$cases;
        // $n = count($cases);
        // $cases = DonationCase::with(['categories' => function ($query) {
        //     $query->select(['id', 'title']);
        // }])->count();
        
        
        return response()->json([
            'Total Categories' => $totalcategories,
            'Categories' => $categories,
            // 'cases' => $cases,
            // 'n' => $n
            
        ]);
    }
}
