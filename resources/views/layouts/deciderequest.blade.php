@extends('layouts.app')

@section('content')

@if (count($pendingorganizations) > 0)
<div class="container sergiFix">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Unapproved Organizations</div>

                @forelse ($pendingorganizations as $pendingorganization)
                <div class="card-body">
                    Title: {{ $pendingorganization->title }} <br>
                    Documents: {{ $pendingorganization->verificationdocuments }} <br>
                    PhoneNumber: {{ $pendingorganization->phonenumber }} <br>
                    Image: {{ $pendingorganization->image }} <br>
                    Description: {{ $pendingorganization->description }} <br>
                    <a href="{{ $pendingorganization->verificationdocuments }}" target="__blank">verificationdocuments</a><br>
                    <!-- <form action="api/accepted/{{$pendingorganization->id}}" method="Post">
                        @csrf
                        @method('put')
                        <button>accept</button>
                    </form> -->
                   
                    <!-- <form action="api/rejected/{{$pendingorganization->id}}" method="Post">
                        @csrf
                        @method('delete')
                        <button>reject</button>
                    </form> -->
                     <a href="api/accepted/{{$pendingorganization->id}}">Approve</a><br>
                    <a href="api/rejected/{{$pendingorganization->id}}">UnApprove (delete)</a><br>
                </div>
                @empty
                <div class="header">No unapproved applications</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endif
@endsection