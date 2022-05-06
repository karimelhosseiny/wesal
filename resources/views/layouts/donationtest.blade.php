@extends('layouts.app')

@section('content')

<form action="/edituser" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type='text' name= 'user_id' value="6" hidden></input>
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
        <div>
            Image
            <input type="file" name="image" class="custom-file-input">
            <label class="custom-file-label" for="chooseFile">Choose image</label>   
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
