@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="w3-container w3-blue-grey">
                <div class="panel-heading w3-container w3-green" >All Done !</div>
                <div class="panel-body" >
                    <form action="/gohome" method="POST">
                    {{ csrf_field() }} 
                    Your Workshop is finished now you can go back to home and view your history .<br><br>
                   <button class="w3-pale-green" name="submit" >Go Home</button><br><br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
