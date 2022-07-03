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
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class AdminCaseController extends Controller
{
    //admin add case
    public function adminaddcase(Request $request){
        // if ($request->hasfile('image')) {
        //     $request->validate(
        //              [
        //                  'image' => 'image|mimes:jpeg,png,jpg,gif,svg|',
        //              ]
        //          );
        //     //upload image
        //     $path=cloudinary()->upload($request->file('image')->getRealPath(),$options=["folder"=>"images"])->getSecurePath();
        //}
            $date = new DateTime();
            DB::table('donation_cases')->insert([
                    'title' =>$request->input('title'),
                    'goal_amount' =>$request->input('goal'),
                    'raised_amount' =>0,
                    //'image' => $path,
                    'deadline' => $request->input('deadline'),
                    'description' => $request->input('description'),
                    'organization_id' =>$request->input('org'),
                    'category_id'=>$request->input('category'),
                    'user_id'=>Auth::id(),
                    'created_at' =>$date->format('Y-m-d H:i:s'),
                    'updated_at'=>$date->format('Y-m-d H:i:s'),
                 ]);

            return response()->json([
                'message' => 'Case added successfully',
            ], 200);
    }
    //admin update case
    public function adminupdatecase(Request $request){
        // if ($request->hasfile('image')) {
        //     $request->validate(
        //              [
        //                  'image' => 'image|mimes:jpeg,png,jpg,gif,svg|',
        //              ]
        //          );
        //     //upload image
        //     $path=cloudinary()->upload($request->file('image')->getRealPath(),$options=["folder"=>"images"])->getSecurePath();
        //}
            $case = DonationCase::find($request->input('case_id'));
            $case->title = $request->input('title');
            $case->goal_amount = $request->input('goal');
            $case->raised_amount = $request->input('raised');
            //$case->image =$path;
            // $case->deadline = $request->input('deadline');
            // $case->description = $request->input('description');
            // $case->organization_id = $request->input('organizationid');
            $case->category_id = $request->input('category');
            $case->save();

            return response()->json([
                'message' => 'Case updated successfully',
            ], 200);
    }

    //admin delete case
    public function admindeletecase(Request $request){
            DB::table('donation_cases')->where('id', $request->input('case_id'))->delete();
            return response()->json([
                'message' => 'Case deleted successfully',
            ], 200);
    }

}
