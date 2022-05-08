@extends('layouts.app')

@section('content')

<form action="/newcaseadded" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
    <label>organizationid</label>
        <input type="text" name="organizationid" value="20" ></input>
        <br>
        <label>title</label>
        <input type='text' name= 'title'></input>
        <br>
        <label>goalamount</label>
        <input type='text'name= 'goalamount'></input>
        <br>
        <label>image</label>
        <input type='file' name= 'image' class="custom-file-input"></input>
        <br> 
        <label>deadline</label>
        <input type='date' name= 'deadline'></input>
        <br>
        <label>description</label>
        <input type='text' name= 'description'></input>
        <br>
        <label>categoryid</label>
        <input type='text' name= 'categoryid'></input>
        <br>
       
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
