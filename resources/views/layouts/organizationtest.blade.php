@extends('layouts.app')

@section('content')
<form action="/postorg" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        title
        <input type="text" name="title" >
    </div>
    
    <div>
        document
        <input type="file" name="document" class="custom-file-input">
        <label class="custom-file-label" for="chooseFile">Choose file</label>   
    </div>

    <div>
        number
        <input type="text" name="number">
    </div>

    <div>
        image
        <input type="text" name="image">
    </div>
    
    <div>
        description
        <input type="text" name="description">
    </div>
    

    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
        Submit
    </button>
</form>
@endsection