<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\Admin;
use App\Models\DonationCase;
use App\Models\DonationOperation;
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
            $request->validate(['document' => 'required|mimes:txt,xlx,xls,pdf|max:2048']);
            if ($request->file()) {

                $fileName = time() . '.' . $request->document->extension();
                print_r($fileName);

                $request->document->move(public_path('/wesalorganizationdocuments'), $fileName);

                $organization->verificationdocuments = '/wesalorganizationdocuments/' . $fileName;
            }

            $organization = new Organization;
            $organization->title = $request->input('title');
            $organization->phonenumber =  $request->input('number');
            $organization->image = $request->input('image');
            $organization->description = $request->input('description');
            $organization->creator_id = Auth::user()->id;
            $organization->save();

            return response()->json([
                'message' => 'Request sent to admin successfully',
            ], 200);
        
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
            return response()->json([
                'message' => 'Case added successfully',
            ], 200);
       
    }

     //organization update case
     public function orgUpdateCase(Request $request){
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
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
         return response()->json([
                'message' => 'Case updated successfully',
            ], 200);
    }

         //organization delete case
    public function orgDeleteCase(Request $request){
            DB::table('donation_cases')->where('id', $request->input('case_id'))->delete();
            return response()->json([
                'message' => 'Case deleted successfully',
            ], 200);
    }

    //organization update its profile
    public function orgUpdateProfile(Request $request)
    {
        $request->validate(
            [
              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'verificationdocuments' => 'required|mimes:txt,xlx,xls,pdf|max:2048'
            ]
        );
            if ($request->file()){
                $newimage = time() . '-' . $request->input('title') . '.' . $request->file('image')->getClientOriginalExtension;
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
            $date = new DateTime();
            DB::table('organizations')->where('id', $request->input('org_id'))->update([
                'updated_at'=>$date->format('Y-m-d H:i:s'),
             ]); 
             return response()->json([
                'message' => 'Organization profile updated  successfully',
            ], 200);
    }

    public function orgData(){
        $orgs  = Organization::withCount(['orgcases'])->get();
        $organizations = Organization::all();
        $organizationWithCases = [];
            foreach ($orgs as $org){
              $items = [
              'id'=>$org->id,
              'title'=>$org->title,
              'verificationdocuments'=>$org->verificationdocuments,
              'phonenumber'=>$org->phonenumber,
              'description'=>$org->description,
              'verified'=>$org->verified,
              'verifiedby'=>$org->verifiedby,
              'creator_id'=>$org->creator_id,
              'totalcases'=>$org->orgcases_count,
              'casesdata'=>$org->orgcases
            ];
                array_push($organizationWithCases, $items);
            }

            // $cases = DB::table('donation_cases')
            //             ->join('donation_operations','donation_cases.id','=','donation_operations.case_id')
            //             ->count('donation_operations.amount');
                       

            //             $users = DB::table('users')
            //                         ->join('donation_operations','users.id','=','donation_operations.user_id')
            //                         ->select('users.*')
            //                         ->get();

                        // DB::table('website_tags')
                        // ->join('assigned_tags', 'website_tags.id', '=', 'assigned_tags.tag_id')
                        // ->select('website_tags.id as id', 'website_tags.title as title', DB::raw("count(assigned_tags.tag_id) as count"))
                        // ->groupBy('website_tags.id')
                        // ->get();

        return response()->json([
            'organziationWithCases' => $organizationWithCases,
            // 'cases' => $cases,
            // 'user' => $users,

            

        ]);
    }




    public function orgaddanycase()
    {
    return view('layouts.orgaddcase');
    }
    public function orgupdateanycase()
    {
    return view('layouts.orgupdatecase');
    }
    public function orgdeleteanycase()
    {
    return view('layouts.orgdeletecase');
    }
    public function orgupdateitsprofile()
    {
    return view('layouts.orgupdateprofile');
    }
    
}
