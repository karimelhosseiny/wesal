<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $organizations = Organization::all()->toJson();

        $organizations = json_decode($organizations);

        return ($organizations);
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
