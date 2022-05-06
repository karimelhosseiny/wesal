<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\DonationCase;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
            'allusers' => $users,
        ]);
        // $users = User::find(1);
        // dd($users->admin);

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

        return ($users);
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
    public function update(Request $request)
    {
    
    }
    public function editprofile(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        //upload image
        if ($request->file()){
            $newimage = time() . '-' . $request->input('name') . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('userimages'), $newimage);
        }
        if (Auth::id() != 0) {
            $user = User::find(Auth::id());
            $user->update([
                'name' => $request->input('name'),
                'password'=> bcrypt($request->input('password')),
                'phonenumber' => $request->input('phone'),
                'address' => $request->input('address'),
                'image' =>  $newimage,
            ]);
        }
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
    public function createfavcase(Request $request)
    {
        $request->validate([
            'case_id' => ['required', 'exists:donation_cases,id'],
        ]);
        
       if(Auth::User()->favoriteCases()->where('case_id', $request->input('case_id'))->exists()){
        return ('already exists');
       }
       else{
        Auth::User()->favoriteCases()->attach($request->input('case_id'));
       }
    }
    public function deletefavcase(Request $request)
    {
        Auth::User()->favoriteCases()->detach($request->input('case_id'));
    }
    public function deletereminder(Request $request)
    {
        Auth::User()->reminders()->delete(Auth::id());
    }
    public function setreminder(Request $request){
        $request->validate(
            [
                'remind_at' => 'required',
                'message' => 'required',
            ]
        );
        Auth::User()->reminders()->create([
            'remind_at'=>$request->input('remind_at'),
            'message'=>$request->input('message'),
            'user_id'=>Auth::id()
        ]);
        
    }

    public function remindertest(){
        return view('layouts.testreminder');   
    }
    public function favcasepage()
    {
        return view('layouts.favcasetest');
    }
    /*user 3ando kaza case we ana bsgl case id we user id fa ana 3ayez ageb cases */
    public function showfavcase()
    {
        $Favcases=User::find(Auth::id())->showfavcases()->get();
        return response()->json([
            'favcase' => $Favcases
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
    public function usersadmins()
    {
        $admins = User::all()->where('type', '=', 'admin');
        return response()->json([
            'admins' => $admins,
        ]);
    }

    public function usersnotadmins()
    {
        $users = User::all()->where('type', '!=', 'admin');
        return response()->json([
            'usersnotadmins' => $users,
        ]);
    }
}