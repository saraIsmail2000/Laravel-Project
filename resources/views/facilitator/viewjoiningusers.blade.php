@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md- col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Workshop Title : {{$w->Title}}<br>Link : {{$w->Link}}</center></div>
                <div class="panel-body" >
                    <form method="post" action="/workshop/kick">
                    {{ csrf_field() }} 
                          <table class="w3-table w3-bordered w3-striped">
                        <tr class="w3-teal">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td></td>
                        </tr>
                        @foreach ($w->users as $user)
                        <tr>
                            @if($user->id != auth()->user()->id)
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td><button type=Submit name="userid" value={{$user->id}}>Kick Out</button></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </form>
                @if(auth()->user()->workshop->users()->count() > 5)
                <div class="panel-body">
                <form method="post" action="/workshop/begin">
                    {{ csrf_field() }} 
                <center><button class="w3-gray w3-text-black w3-hover-text-white" type=Submit>Begin Workshop</button></center>
                </form>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
