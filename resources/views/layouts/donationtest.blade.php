@extends('layouts.app')

@section('content')
<form action="/cases  " method="POST">
    @csrf
    <div class="form-group">
        <input type='text' name= 'user_id' value="1"></input>
        <input type='text' name= 'case_id' value="1"></input>
        <input type='text' name= 'amount'></input>
        <input type='text' name= 'currency'></input> 
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
