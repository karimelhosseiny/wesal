<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\DonationCase;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return response()->json([
            'users' => $users
        ]);

         // $orgs= Admin::all();
        // dd($orgs[0]->verifiedOrganizations);


        // $admin = Organization::all();
        // dd($admin[0]->adminwhoVerified->user);


        // $users = User::all();
        // dd($users[0]->reminders);

        // $users= User::all();
        // dd($users[0]->admin);
        // // $cases= DonationCase::all();
        // dd($cases[0]->categories);
        // $case = DonationCase::find(1);
        // dd($case->usersDonated->currency[0]);

       // $case = User::find(3)->donationOperations;
        //dd($case[0]->pivot);

        // foreach (User::find(3)->donationOperations as $donation) {
        //     dd($donation->pivot);
        // }


        // foreach (DonationCase::find(1)->usersDonated as $donation) {
        //     print_r($donation->pivot);
        // }



        // $users = User::find(1);
        // dd($users->favoriteCases);

        // $users = User::all()->toJson();

        // $users = json_decode($users);

        // return ($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $users = User::find($id)->toJson();

           $users = json_decode($users);
           
           return($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]
        );
        $newimage = time().'-'.$request->name.'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('images'), $newimage);
        if($id==Auth::id())
        { 
            $user=User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phonenumber' => $request->input('phone'),
            'address' => $request->input('address'),
            'image' => $newimage,
            ]);
        }
        return print_r('mama 7elwa');
        /*Auth::User()->attach($id,[
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phonenumber' => $request->input('phone'),
            'address' => $request->input('address'),
            'image' => $newimage,
        ])->save();*/
    }
    public function userprofile($id)
    {
        $donationcase = User::find($id)->donationOperations->groupBy('id');
        $user = User::find($id);
        $donationhistory = DB::table('donation_operations')->where('user_id', $id)->get();
        return response()->json([
            'user' => $user,
            'donationhistory' => $donationhistory,
            'donationcase' => $donationcase
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function edittest()
    {
        return view('layouts.donationtest');
    }

}
