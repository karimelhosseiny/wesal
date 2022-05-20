<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\Admin;
use App\Models\DonationCase;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;


class AdminCaseController extends Controller
{
    //admin add case
    public function adminaddcase(Request $request){
        if (Gate::allows('isAdmin')){
            if ($request->file()){
                $newimage = time() . '-' . $request->input('name') . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('caseimages'), $newimage);
            
            $date = new DateTime();
            DB::table('donation_cases')->insert([
                    'title' =>$request->input('title'),
                    'goal_amount' =>$request->input('goalamount'),
                    'raised_amount' =>0,
                    'image' =>$newimage,
                    'deadline' => $request->input('deadline'),
                    'description' => $request->input('description'),
                    'organization_id' =>$request->input('organizationid'),
                    'category_id'=>$request->input('categoryid'),
                    'user_id'=>Auth::id(),
                    'created_at' =>$date->format('Y-m-d H:i:s'),
                    'updated_at'=>$date->format('Y-m-d H:i:s'),
                 ]);
            }
        }
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
            }
    }
    //admin update case
    public function adminupdatecase(Request $request){
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        if (Gate::allows('isAdmin'))
        {
            if ($request->file()){
                $newimage = time() . '-' . $request->input('title') . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('caseimages'), $newimage);
                 }
            $case = DonationCase::find($request->input('case_id'));
            $case->title = $request->input('title');
            $case->goal_amount = $request->input('goalamount');
            $case->raised_amount = $request->input('raisedamount');
            $case->image = $newimage;
            $case->deadline = $request->input('deadline');
            $case->description = $request->input('description');
            $case->organization_id = $request->input('organizationid');
            $case->category_id = $request->input('categoryid');
            $case->save();
        }
        else
        {
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
        }
    }

    //admin delete case
    public function admindeletecase(Request $request){
        if (Gate::allows('isAdmin')){
            DB::table('donation_cases')->where('id', $request->input('case_id'))->delete();
            }
        else{
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
            }
    }

}
