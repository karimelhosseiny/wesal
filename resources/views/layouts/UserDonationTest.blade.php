@extends('layouts.app')

@section('content')

<form action="/donationdone" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type='text' name= 'case_id' value="3" hidden></input>
        <label>Amount</label>
        <input type='text' name= 'amount'></input>
        <br>
        <label>currency</label>
        <input type='text'name= 'currency'></input>
        <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
