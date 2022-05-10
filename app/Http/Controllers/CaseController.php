<?php

namespace App\Http\Controllers;

use App\Models\DonationCase;
use App\Models\DonationOperation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function userdonation(Request $request)
    {
        Auth::User()->donationOperations()->attach($request->input('case_id'), [
            "amount" => $request->input('amount'),
            "currency" => $request->input('currency')
        ]);
    }
    public function userdonate()
    {
        return view('layouts.UserDonationTest');
    }
    //ana hyegy mn front 
    //case id we ana 3amel access 3ala user id mn auth 
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $cases = DonationCase::find($id)->toJson();
         $cases = json_decode($cases);
         return ($cases);
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

    public function cases()
    {
        $cases = DonationCase::with(['organization' => function ($query) {
            $query->select(['id', 'title']);
        }])->get();
        return response()->json([
            'cases' => $cases,
        ]);
    }
}
