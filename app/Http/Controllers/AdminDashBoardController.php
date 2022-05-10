<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Models\Admin;
use App\Models\DonationCase;
use App\Models\Reminder;
use App\Models\DonationOperation;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;


class AdminDashBoardController extends Controller
{

    //user dashboard
    public function userDashBoard(){
        $totalusers = DB::table('users')->count();
        $totaldonations = DB::table('donation_operations')->count();
        $users = User::all();


       
        return response()->json([
            'Total Users' => $totalusers,
            'Total Donations' => $totaldonations,
            'Users' => $users
        ]);
    }

    //category dashboard
    public function cateDashBoard(){
        $totalcategories = DB::table('categories')->count();
        $cases  = Category::withCount(['cases'])->get();
        $totalcases = [];
            
            foreach ($cases as $case){
              $items = ['id'=>$case->id,'title'=>$case->title,'description'=>$case->description,'totalcases'=>$case->cases_count];
                array_push($totalcases, $items);
            }

            return response()->json([
                   'Total Categories'=> $totalcases
                                    ]);
    }

    //organization dashboard
    public function orgDashboard(){
        $totalorganizations = DB::table('organizations')->count(); 
        $cases = DB::table('donation_cases')->count();
        $totaldonations = DB::table('donation_operations')->count(); 


        $orgs  = Organization::withCount(['orgcases'])->get();
        $totalcases = [];
            
            foreach ($orgs as $org){
              $items = ['id'=>$org->id,'title'=>$org->title,'description'=>$org->description,'totalcases'=>$org->orgcases_count];
                array_push($totalcases, $items);
            }

        return response()->json([
            'Total Organizations' => $totalorganizations,
            'Total Cases' => $cases,
            'Organizations'=> $totalcases,
            'Total Donations' => $totaldonations

        ]);
    }

    //reminders dashboard
    public function remindersDashBoard(){
        $totalreminders = Reminder::all();
        $allreminders = DB::table('reminders')->count();
        $users  = User::withCount(['reminders'])->get();
        $reminders = [];
            
        foreach ($users as $user){
          $items = ['id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'totalreminders'=>$user->reminders_count];
            array_push($reminders, $items);
        }

        return response()->json([
            'totalreminders' => $totalreminders,
            'allreminders' => $allreminders,
            'reminders' => $reminders
                             ]);

    }

    //donations dashboard
    public function donationsDashBoard(){
        $totaldonations = DonationOperation::all();
        // $users = User::withCount(['donationOperations','usersDonated'])->get();
        // $donations = [];

        // foreach ($users as $user){
        //     $items = ['totaldonations'=>$user->donationOperations_count];
        //     array_push($donations, $items);
        // }

        
        return response()->json([
            'totaldonations' => $totaldonations,
            // 'donations' => $donations
                             ]);
    }

}
