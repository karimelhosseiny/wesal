@extends('layouts.app')

@section('content')

<form action="/categoryupdated" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
    <input type="text" name="category_id" value="5" hidden ></input>
        <br>
    <label>Update Category:</label>
    <br>
        <label>title</label>
        <input type='text' name= 'title'></input>
        <br>
        <label>description</label>
        <input type='text' name= 'description'></input>
        <br>
        
       
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
