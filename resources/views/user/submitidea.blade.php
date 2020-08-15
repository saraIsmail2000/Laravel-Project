@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="w3-container w3-blue-grey">
                <div class="panel-heading">Submit your Solution</div>
                <div class="panel-body" >
                    <form action="/submitIdea" method="POST">
                    {{ csrf_field() }} 
                    <textarea class="w3-container w3-white w3-text-black" name="idea" rows="4" cols="50"></textarea><br><br>
                   <button class="w3-container w3-pink w3-text-white" name="submit" >Submit</button><br><br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
