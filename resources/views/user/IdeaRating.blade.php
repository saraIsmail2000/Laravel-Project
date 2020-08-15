@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="w3-container w3-teal">
                <div class="panel-heading">Rate The following Idea</div>
                <div class="panel-body" >
                    <form action="/workshop/rated" method="POST">
                    {{ csrf_field() }} 
                    {{ $idea->solution }} 
                    <br><br>
                    <select class="w3-container w3-black w3-text-white w3-hover-gray" style="width:25%;" name="ratings" >
                        <option value=1 > 1</option>
                        <option value=2 > 2</option>
                        <option value=3 > 3</option>
                        <option value=4 > 4</option>
                        <option value=5 > 5</option>
                    </select><br><br>
                   <button class="w3-container w3-black w3-text-white w3-hover-pale-pink" value={{$idea->id}} name="myRate" >Ok</button><br><br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
