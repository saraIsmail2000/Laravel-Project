@extends('layouts.app')

@section('content')
<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <form method="POST" action="/viewhistory" >
                            {{ csrf_field() }} 
                           <center> <button name='his' >View History</button></center>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
-->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Workshop</div>
                <div class="panel-body" >
                    <form action="/creatingworkshop" method="POST">
                    {{ csrf_field() }} 
                   <input type="text" name="title"  placeholder="Workshop title" size="70" required/><br><br>
                   <input type="text" name="problem" placeholder="Workshop Problem" size="70" required/><br><br>
                   <input type="text" name="nbPar" placeholder="Number of participants (Minimum 6)" size="70" required/><br><br>
                   <button name="create" >Create</button><br><br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
