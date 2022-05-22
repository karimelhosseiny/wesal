@extends('layouts.app')

@section('content')

<form action="api/userdeleted" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label>Delete User:</label>
    <input type='text' name= 'user_id' value="2" hidden></input>
    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</form>

@endsection


