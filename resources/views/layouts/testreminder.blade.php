@extends('layouts.app')

@section('content')
<form action="/setreminder" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type='date' name= 'remind_at'></input>
    <input type='text' name= 'message'></input>
    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</form>
<form action="/deletereminder" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</form>
@endsection