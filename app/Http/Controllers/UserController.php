<?php

namespace App\Http\Controllers;

use App\Models\DonationCase;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
