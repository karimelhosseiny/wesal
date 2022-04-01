<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\DonationCase;
use App\Models\Organization;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class PagesController extends Controller
{
    //data shown in user homepgae
    public function userhomepage($id)
    {

        $users = User::find($id);
        $n = count($users->donationOperations) - 1;
        $lastdonation = $users->donationOperations[$n];
        $users['donation_operations'] = $lastdonation;

        $cases = DonationCase::all();

        $reminders = $users->reminders;

        return response()->json([
            'users' => $users,
            'cases' => $cases,
            'lastdonation' => $lastdonation
        ]);
    }

    //data shown in organization homepage
    public function orghomepage($id)
    {

        $organization = Organization::find($id);

        $orgcases = $organization->orgcases;
        $n = count($orgcases);

        //$sumcases = DB::table('donation_cases')->where('organization_id', $id)->sum('raised_amount');
        $sumcases = Organization::find($id)->orgcases->sum('raised_amount');


        return response()->json([
            'organization' => $organization,
            'total cases:'  => $n,
            'total donations:' => $sumcases
        ]);
    }

    //data shown in casepage
    public function casepage($id)
    {
        // first method (eloquent)
        $case = DonationCase::find($id);


        //second method (query builder) 
        // $case = DB::table('donation_cases')->where('id', $id)->select('title', 'image', 'goal_amount', 'raised_amount', 'description')->get();

        $caseorg = DonationCase::find($id)->organization['title'];

        $casecat= DonationCase::find($id)->categories['title'];


        $totaldonors = DB::table('donation_operations')->where('case_id', $id)->count();
    


        return response()->json([
            'case' => $case,
            'organizationtitle' => $caseorg,
            'categorytitle' => $casecat,
            'totaldonors' => $totaldonors
            
        ]);
    }
    //data shown in user profile page
    public function userprofile($id){
        $donationcase = User::find($id)->donationOperations->groupBy('id');
        $user = User::find($id);
        $donationhistory = DB::table('donation_operations')->where('user_id',$id)->get();
        return response()->json([
            'user'=> $user,
            'donationhistory' => $donationhistory,
            'donationcase' => $donationcase
        ]);
    }
}
