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
                <div class="panel-heading">Join Workshop</div>

                <div class="panel-body" >
    
                    <form method="POST" action="/joiningworkshop" >
                        {{ csrf_field() }} 
                   <input type="text" name="link"  placeholder="Enter Workshop link" size="50" /><br><br>
                   <button name="join" >Join</button><br><br>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
