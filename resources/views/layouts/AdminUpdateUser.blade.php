@extends('layouts.app')

@section('content')

<form action="/updatedone" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>user_id</label>
        <input type="text" name="user_id" value="2" ></input>
        <br> 
    <label>Name</label>
        <input type='text' name= 'name'></input>
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
        <div>
            user_image
            <input type="file" name="user_image" class="custom-file-input">
            <label class="custom-file-label" for="chooseFile">Choose image</label>   
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>    
      {{--  <input type='text' name= 'user_id' value="10" hidden></input>
        <label>type</label>
        <input type="text" name='type'></input>
        <br>
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
        <label>org_image</label>
        <input type='file' name= 'org_image' class="custom-file-input"></input>
        <br> 
        <label>description</label>
        <input type='text' name= 'description'></input>
        <br>
    <button type="submit" class="btn btn-primary">Submit</button>--}}   
    </div>
</form>
@endsection
