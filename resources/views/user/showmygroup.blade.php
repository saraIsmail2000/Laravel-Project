@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row">
        <div class="col-md-0 col-md-offset-1">
            <div class="panel panel-default">
                <center><div class="panel-heading"><center>Workshop Title : {{auth()->user()->workshop->Title}}<br></center></div>
                <hr>
                <div class="panel-body" >
                        <div class="panel-heading">The group you joined lately</div>
                        <div class="panel-body" >
                            <form method="post" action="/workshop/exitgroup">
                            {{ csrf_field() }} 
                            <?php $group = auth()->user()->group; ?>
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
                                        <button class="w3-container w3-pink w3-text-white" name="submit" >Exit Group</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>
              
                </div>
            </center></div>
        </div>
    </div>
</div>
@endsection
