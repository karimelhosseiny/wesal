@extends('layouts.app')

@section('content')

<form action="/newcaseupdated" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
        <input type="text" name="case_id" value="7" hidden ></input>
        <br>
        <label>title</label>
        <input type='text' name= 'title'></input>
        <br>
        <label>goalamount</label>
        <input type='text'name= 'goalamount'></input>
        <br>
        <label>raisedamount</label>
        <input type='text'name= 'raisedamount'></input>
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
        <label>organizationid</label>
        <input type='text' name= 'organizationid'></input>
        <br>
        <label>categoryid</label>
        <input type='text' name= 'categoryid'></input>
        <br>
       
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
