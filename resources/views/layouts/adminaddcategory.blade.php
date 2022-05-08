@extends('layouts.app')

@section('content')

<form action="/categoryadded" method="POST" enctype="multipart/form-data">
    
    @csrf
    <div class="form-group">
    <label>Add New Category:</label>
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
