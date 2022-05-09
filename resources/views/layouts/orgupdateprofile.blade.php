@extends('layouts.app')

@section('content')

<form action="/orgprofileupdated" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
        <input type="text" name="organization_id" value="20" hidden></input>
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
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
