<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\Admin;
use App\Models\DonationCase;
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
       
    }
    // public function addadmin(Request $request)
    // {
    //     if (Gate::allows('isAdmin')){

    //         Auth::user()->create([
    //             'name'=> $request->input('name'),
    //             'email'=> $request->input('email'),
    //             'password'=> bcrypt($request->input('password')),
    //             'phone'=> $request->input('phone'),
    //             'address'=> $request->input('address'),
    //             'type'=> $request->input('type'),
    //         ]);
    //         $id= DB::table('users')->where('email',$request->input('email'))->value('id');
    //         DB::table('admins')->insert([
    //             'id'=> $id,
    //         ]);
    //     }
    //     else
    //     {
    //         dd('you are not admin');
    //     }
    // }
    public function addUserWithType(Request $request)
    {
        // dd($request->input('type')=='organization');
        if (Gate::allows('isAdmin')){
            Auth::user()->create([
                'name'=> $request->input('name'),
                'email'=> $request->input('email'),
                'password'=> bcrypt($request->input('password')),
                'phonenumber'=> $request->input('phone'),
                'address'=> $request->input('address'),
                'type'=> $request->input('type'),]);
                $id= DB::table('users')->where('email',$request->input('email'))->value('id');
                $request->validate(
                        [
                          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                          'verificationdocuments' => 'required|mimes:txt,xlx,xls,pdf|max:2048'
                        ]
                    );
                    $newimage = time() . '-' . $request->input('title') . '.' . $request->file('image')->extension();
                    $request->file('image')->move(public_path('orgimages'), $newimage);
                    
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
                        'image' =>$newimage,
                        'description' =>$request->input('description'),
                        'verified' => true,
                        'verifiedat' =>$date->format('Y-m-d H:i:s'),
                        'verifiedby' => Auth::id(),
                        'creator_id'=> $id,
                        'created_at' =>$date->format('Y-m-d H:i:s'),
                        'updated_at'=>$date->format('Y-m-d H:i:s'),
                     ]);
            }
           }
            else
        {
            dd('you are not admin');
        }
    }
    public function adminupdateusertoadmin(Request $request)
    {
        if (Gate::allows('isAdmin')){
            if ($request->file()){
                $newimage = time() . '-' . $request->input('name') . '.' . $request->file('user_image')->extension();
                $request->file('user_image')->move(public_path('userimages'), $newimage);
            }
            $user = User::find($request->input('user_id'));
            $user->name = $request->input('name');
            $user->phonenumber = $request->input('phone');
            $user->address = $request->input('address');
            $user->image = $newimage;
            $user->type = $request->input('type');
            if($user->type == 'admin'){
                $date = new DateTime();
                 DB::table('admins')->insert([
                    'id'=> $user->id,
                    'access_level' =>$user->name,
                    'created_at' =>$date->format('Y-m-d H:i:s'),
                    'updated_at'=>$date->format('Y-m-d H:i:s'),
                ]);
            }
    }
}
    // update user to organization
    public function adminupdateusertoorg(Request $request)
    {
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        if (Gate::allows('isAdmin'))
        {
            $user = User::find($request->input('user_id'));
            $user->type = $request->input('type');
            if($user->type == 'organization')
            {
                $request->validate(
                    [
                      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                      'verificationdocuments' => 'required|mimes:txt,xlx,xls,pdf|max:2048'
                    ]
                );
                if($request->file()){
                    $neworgimage = time() . '-' . $request->input('title') . '.' . $request->file('org_image')->extension();
                    $request->file('org_image')->move(public_path('orgimages'), $neworgimage);
                    
                    $verificationdocuments = time() . '-' . $request->input('title') . '.' . $request->file('verificationdocuments')->extension();
                    $request->file('verificationdocuments')->move(public_path('wesalorganizationdocuments'), $verificationdocuments);
                }
                $date = new DateTime();
                DB::table('organizations')->insert([
                    'title' =>$request->input('title'),
                    'verificationdocuments' =>$verificationdocuments,
                    'phonenumber' =>$request->input('phonenumber'),
                    'image' =>$neworgimage,
                    'description' =>$request->input('description'),
                    'verified' => true,
                    'verifiedat' =>$date->format('Y-m-d H:i:s'),
                    'verifiedby' => Auth::id(),
                    'creator_id'=> $user->id,
                    'created_at' =>$date->format('Y-m-d H:i:s'),
                    'updated_at'=>$date->format('Y-m-d H:i:s'),
                 ]);

            }
            $user->save();
        }
        else
        {
            dd('you are not admin');
        }
    }
    // update organization data
    public function adminupdateorganizationprofile(Request $request)
    {
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'verificationdocuments' => 'required|mimes:txt,xlx,xls,pdf|max:2048'
            ]
        );
        if (Gate::allows('isAdmin'))
        {
            if ($request->file()){
                $newimage = time() . '-' . $request->input('title') . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('orgimages'), $newimage);
                $verificationdocuments = time() . '-' . $request->input('title') . '.' . $request->file('verificationdocuments')->extension();
                $request->file('verificationdocuments')->move(public_path('wesalorganizationdocuments'), $verificationdocuments);
            }
            $organization = Organization::find($request->input('organization_id'));
            $organization->title = $request->input('title');
            $organization->phonenumber = $request->input('phonenumber');
            $organization->image = $newimage;
            $organization->description = $request->input('description');
            $organization->verificationdocuments = $verificationdocuments;
            $organization->save();
        }
        else
        {
            dd('you are not admin');
        }
    }
// admin update user profile
    public function adminupdateuserprofile(Request $request)
    {
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        if (Gate::allows('isAdmin'))
        {
            if ($request->file()){
                $newimage = time() . '-' . $request->input('name') . '.' . $request->file('user_image')->extension();
                $request->file('user_image')->move(public_path('userimages'), $newimage);
            }
            $user = User::find($request->input('user_id'));
            $user->name = $request->input('name');
            $user->phonenumber = $request->input('phone');
            $user->address = $request->input('address');
            $user->password = bcrypt($request->input('password'));
            $user->image = $newimage;
            $user->save();
        }
        else
        {
            dd('you are not admin');
        }
    }


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
            dd('you are not admin');
            }
    }

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
            dd('you are not admin');
        }
    }

    public function admindeletecase(Request $request){
        if (Gate::allows('isAdmin')){
            DB::table('donation_cases')->where('id', $request->input('case_id'))->delete();
            }
        else{
            dd('you are not admin');
            }
    }
     public function adminDeleteUser(Request $request ){
        if (Gate::allows('isAdmin')){
            DB::table('users')->where('id', $request->input('user_id'))->delete();
            }
        else{
            dd('you are not admin');
            }
    }

    public function adminDeleteOrg(Request $request){
        if (Gate::allows('isAdmin')){
            DB::table('organizations')->where('id', $request->input('org_id'))->delete();            }
        else{
            dd('you are not admin');
            }
    }




    public function admindeleteuserandorg()
    {
    return view('layouts.admindeleteuserandorg');
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
            dd('You are not Admin');
        }
    }
    //reject the organizations requests
    public function rejectrequest($id)
    {
        if (Gate::allows('isAdmin')) {
            $reject = DB::table('Organizations')->where('id', $id)->delete();
        } else {
            dd('You are not Admin');
        }
    }
}
