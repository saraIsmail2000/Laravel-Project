@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md-0 col-md-offset-1">
            <div class="panel panel-default">
                <center><div class="panel-heading"><center>Workshop Title :<br></center></div>
                @foreach($groups as $group)
                <div class="panel-body" >
                    <form method="post" action="/workshop/joingroup">
                    {{ csrf_field() }} 
                    <table class="w3-table w3-bordered w3-striped ">
                        <tr class="w3-black">
                            <td>Group ID</td>
                            <td colspan="2">The idea :</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>{{$group->id}}</td>
                            <td colspan="2">{{$group->idea->solution}}</td>
                            <td>
                                <button name='join' value={{$group->id}} >Join Group</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <br><hr>
                </div>
                @endforeach
            </center></div>
        </div>
    </div>
</div>
@endsection
