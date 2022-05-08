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


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::find(3);
        // dd($users->organization);
        // $organizations = Organization::all()->toJson();

        // $organizations = json_decode($organizations);

        // return ($organizations);
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
        if (Gate::allows('isUser')) {
            $request->validate(['document' => 'required|mimes:txt,xlx,xls,pdf|max:2048']);

            $organization = new Organization;

            $organization->title = $request->input('title');

            if ($request->file()) {

                $fileName = time() . '.' . $request->document->extension();
                print_r($fileName);

                $request->document->move(public_path('/wesalorganizationdocuments'), $fileName);

                $organization->verificationdocuments = '/wesalorganizationdocuments/' . $fileName;
            }
            $organization->phonenumber =  $request->input('number');
            $organization->image = $request->input('image');
            $organization->description = $request->input('description');
            $organization->creator_id = Auth::user()->id;


            $organization->save();
        } else {

            dd('You are not User');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*ageb favcases mn table cases le user id mo3yn*/
    public function show($id)
    {
    
        $organization = DB::table('organizations')->where('organizations.id', $id)
            ->join('users', 'verifiedby', '=', 'users.id')
                ->select('organizations.*', 'users.name')
                    ->get();  //query builder method
                    
        // $organization = organization::find($id);  //eloquent method
        // $adminwhoverified = organization::find($id)->adminwhoVerified->user->name;
        return response()->json([
            'organization' => $organization,
            // 'organization' => $organization,
            // 'adminwhoverified' => $adminwhoverified
        ]);
    }

    public function testorgforms()
    {
        // return view('layouts.donationtest'); 
        return view('layouts.organizationtest');
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

    public function organizations()
    {

        $organizations = Organization::all();
        return response()->json([
            'organizations' => $organizations,
        ]);
    }
    // organization add case
    public function orgAddCase(Request $request){
        if (Gate::allows('isOrganization')){
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
                    'updated_at'=>0,
                 ]);
            }
        }
        else{
            dd('you are not an Organization');
            }
    }

     //organization update case
     public function orgUpdateCase(Request $request){
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        if (Gate::allows('isOrganization'))
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
            $date = new DateTime();
            DB::table('donation_cases')->where('id', $request->input('cases_id'))->update([
                'updated_at'=>$date->format('Y-m-d H:i:s'),
             ]);  
        }
        else
        {
            dd('you are not an organization');
        }
    }





    public function orgaddanycase()
    {
    return view('layouts.orgaddcase');
    }

    
    public function orgupdateanycase()
    {
    return view('layouts.orgupdatecase');
    }
}
