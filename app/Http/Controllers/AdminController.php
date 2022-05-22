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

    

    //layouts

    public function admindeleteanyuser()
    {
    return view('layouts.admindeleteuserwithtype');
    }
    public function Adminupdateorg()
    {
        return view('layouts.AdminUpdateOrganization');
    }
    public function Adminupdateuser()
    {
        return view('layouts.AdminUpdateUser');
    }
    public function testadduser()
    {
        return view('layouts.adduserbyadmin');
    }
    public function testaddorg()
    {
        return view('layouts.addorgbyadmin');
    }
    public function adminaddnewcase()
    {
    return view('layouts.adminaddcase');
    }
    public function admindeleteanycase()
    {
    return view('layouts.admindeletecase');
    }
    public function adminupdateanycase()
    {
    return view('layouts.adminupdatecase');
    }
    public function adminaddnewcategory()
    {
    return view('layouts.adminaddcategory');
    }
    public function admindeleteanycategory(){
        return view('layouts.admindeletecategory');
     }
     public function adminupdateanycategory(){
        return view('layouts.adminupdatecategory');

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