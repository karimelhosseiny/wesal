@extends('layouts.app')

@section('content')

<form action="/adduser" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
    <label>Name</label>
        <input type='text' name= 'name'></input>
        <br>
        <label>Email</label>
        <input type='email'name= 'email'></input>
        <br>
        <label>phone</label>
        <input type='text' name= 'phone'></input>
        <br>
        <label>Address</label>
        <input type='text' name= 'address'></input>
        <br> 
        <label>password</label>
        <input type='password' name= 'password'></input>
        <br>





        <label>title</label>
        <input type='text' name= 'title'></input>
        <br>
        <label>documents</label>
        <input type='file'name= 'verificationdocuments'></input>
        <br>
        <label>phone</label>
        <input type='text' name= 'phonenumber'></input>
        <br>
        <label>image</label>
        <input type='file' name= 'image' class="custom-file-input"></input>
        <br> 
        <label>description</label>
        <input type='text' name= 'description'></input>
        <br>
        <label>type</label>
        <input type="text" name='type'></input>
        <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
