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

    public function addUserWithType(Request $request)
    {
        // dd($request->input('type')=='organization');
        if ($request->input('type') =='admin'){
            DB::table('users')->insert([
                'name'=> $request->input('name'),
                'email'=> $request->input('email'),
                'password'=> bcrypt($request->input('password')),
                'phonenumber'=> $request->input('phone'),
                'address'=> $request->input('address'),
                'type'=> $request->input('type'),]);
                $id= DB::table('users')->where('email',$request->input('email'))->value('id');
                $request->validate(
                        [
                        //   'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                          'verificationdocuments' => 'required|mimes:txt,xlx,xls,pdf|max:2048'
                        ]
                    );
                    // $newimage = time() . '-' . $request->input('title') . '.' . $request->file('image')->extension();
                    // $request->file('image')->move(public_path('orgimages'), $newimage);
                    
                    $verificationdocuments = time() . '-' . $request->input('title') . '.' . $request->file('verificationdocuments')->extension();
                    $request->file('verificationdocuments')->move(public_path('wesalorganizationdocuments'), $verificationdocuments);
            
            if($request->input('type') =='admin'){
                $date = new DateTime();
                 DB::table('admins')->insert([
                    'id'=> $id,
                    'access_level' =>$request->input('name'),
                    'created_at' =>$date->format('Y-m-d H:i:s'),
                    'updated_at'=>$date->format('Y-m-d H:i:s'),
                ]);
            }
            elseif($request->input('type') =='organization'){
                $date = new DateTime();
                DB::table('organizations')->insert([
                        'title' =>$request->input('title'),
                        'verificationdocuments' =>$verificationdocuments,
                        'phonenumber' =>$request->input('phonenumber'),
                        // 'image' =>$newimage,
                        'description' =>$request->input('description'),
                        'verified' => true,
                        'verifiedat' =>$date->format('Y-m-d H:i:s'),
                        'verifiedby' => $request->input('admin_id'),
                        'creator_id'=> $id,
                        'created_at' =>$date->format('Y-m-d H:i:s'),
                        'updated_at'=>0,
                     ]);
            }
           }
            else
        {
            return  response()->json([
                'message' => 'You are not an admin',
            ], 401);
        }
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
