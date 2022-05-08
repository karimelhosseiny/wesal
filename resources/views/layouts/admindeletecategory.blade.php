@extends('layouts.app')

@section('content')

<form action="/categorydeleted" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label>Delete Category:</label>
    <input type='text' name= 'category_id' value="3" hidden></input>
    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</form>



@endsection


