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
use App\Models\FavouriteCase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;


class AdminDashBoardController extends Controller
{

    //user dashboard
    public function userDashBoard(){
        // if (Gate::allows('isAdmin')){
        $totalusers = DB::table('users')->count();
        $totalcases = DB::table('donation_cases')->count();
        $totaldonations = DB::table('donation_operations')->count();
        $users = User::all();



        return response()->json([
            'Total_Users' => $totalusers,
            'Total_Donations' => $totaldonations,
            'Total_Cases' => $totalcases,
            'Users' => $users
        ]);
        // }
        // else{
        //   return  response()->json([
        //     'message' => 'You are not an admin',
        // ], 401);
        //     }
            }
    //category dashboard
    public function cateDashBoard(){
        if (Gate::allows('isAdmin')){
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
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
            }
    }
    //organization dashboard
    public function orgDashboard(){
        // if (Gate::allows('isAdmin')){
        $allOrganizations = DB::table('organizations')->count();
        $allCases = DB::table('donation_cases')->count();
        $allDonations = DB::table('donation_operations')->count();

        $orgs  = Organization::withCount(['orgcases'])->get();
        $organizations = Organization::all();
        $organizationWithCases = [];
            foreach ($orgs as $org){
              $items = [
              'id'=>$org->id,
              'title'=>$org->title,
              'verificationdocuments'=>$org->verificationdocuments,
              'phonenumber'=>$org->phonenumber,
              'description'=>$org->description,
              'verifiedby'=>$org->verifiedby,
              'creator_id'=>$org->creator_id,
              'totalcases'=>$org->orgcases_count
            ];
                array_push($organizationWithCases, $items);
            }
        return response()->json([
            'All Organizations' => $allOrganizations,
            'All Cases' => $allCases,
            'All Donations' => $allDonations,

            'Organization With Cases'=> $organizationWithCases,
        ]);
        // }
        // else{
        //     return  response()->json([
        //         'message' => 'You are not an admin',
        //     ], 401);
        // }
        }
    //reminders dashboard
    public function remindersDashBoard(){
        if (Gate::allows('isAdmin')){
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
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
            }
    }
    //favcase dashboard
    public function favCaseDashBoard(){
        if (Gate::allows('isAdmin')){
        $favcases = FavouriteCase:: all();
        $totalfavcases = DB::table('favourite_cases')->count();
        return response()->json([
            'favcases' => $favcases,
            'totalfavcases' => $totalfavcases
            ]);
        }
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);            }
    }
    //donations dashboard
    public function donationsDashBoard(){
        if (Gate::allows('isAdmin')){
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
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);            }
        }

}
