@extends('layouts.app')

@section('content')

<form action="/casedeleted" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label>Delete Case:</label>
    <input type='text' name= 'case_id' value="6" hidden></input>
    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</form>



@endsection


