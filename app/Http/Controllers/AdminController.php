<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
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

    //retrieve the organization requests
    public function retrieverequests()
    {
        if (Gate::allows('isAdmin')) {
            $organization = DB::table('Organizations')->where('verified', '=', 0)->get();
            return response()->json([
                'organization' => $organization
            ]);
            // return view('layouts.deciderequest', ['pendingorganizations' => $organization]);
        } else {
            dd('You are not admin');
        }
    }
    //accept the organization requests 
    public function acceptrequest(Request $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $accept = DB::table('Organizations')->where('id', $id)->update(['verified' => 1, 'verifiedby' =>  Auth::user()->id]);
        } else {
            dd('You are not User');
        }
    }
    //reject the organizations requests
    public function rejectrequest($id)
    {
        if (Gate::allows('isAdmin')) {
            $reject = DB::table('Organizations')->where('id', $id)->delete();
        } else {
            dd('You are not User');
        }
    }
}
