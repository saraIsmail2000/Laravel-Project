@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    <div class="row"><center>
        <div class="col-md- col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">{{$w->Title}}</div>
                <div class="panel-body" >
               @if($w->stage == 3 )
                    <form method="post" action="/workshop/makegroups">
                        {{ csrf_field() }} 
                           
                           <table class="table table-hover">
                            <tr>
                                <td>Idea ID</td>
                                <td>Participant Name</td>
                                <td>Idea</td>
                                <td>Rate</td>
                                <td>Choose here</td>
                            </tr>
                            @foreach ($w->ideas()->orderBy('rating','DESC')->get() as $idea)
                            <tr>
                                <?php $owner = $idea->user ; ?>
                                <td>{{$idea->id}}</td>
                                <td>{{$owner->name}}</td>
                                <td>{{$idea->solution}}</td>
                                <td>{{$idea->rating}}</td>
                                <td><input type="checkbox" name="groups[]" value={{$idea->id}} ></td>
                            </tr>
                            @endforeach
                        </table>
                        Pick The best ideas and make groups to work on.<br>
                        <button class="w3-container w3-pink" name="make" value={{$w->id}} type=Submit >Generate groups</button>
                    </form>

                @else
                    <table class="table table-hover">
                        <tr>
                            <td>Idea ID</td>
                            <td>Participant Name</td>
                            <td>Idea</td>
                            <td>Rate</td>
                            <td></td>
                        </tr>
                        @foreach ($w->ideas as $idea)
                        <tr>
                            <?php $owner = $idea->user ; ?>
                            <td>{{$idea->id}}</td>
                            <td>{{$owner->name}}</td>
                            <td>{{$idea->solution}}</td>
                            <td>{{$idea->rating}}</td>
                        </tr>
                        @endforeach
                    </table>
           
                </div>

                <div class="panel-heading"> <center>

                @if( $w->stage == 1 && $w->ideas()->count() == ($w->nb_users))
                <form method="post" action="/workshop/firstround">
                 {{ csrf_field() }} 
                    <button class="w3-container w3-pink" type=Submit >Begin Rating Rounds</button>
                </form>
                @endif
               @if($w->stage == 2 && $w->nbRates ==  ($w->nb_users) ) 
                 
                        <form method="post" action="/workshop/nextRound">
                            {{ csrf_field() }} 
                            <button class="w3-container w3-pink" type=Submit >Next Round</button>
                        </form>
                @endif
                
           @endif
               </center>
            </div>
        </div>
        </div></center>
    </div>
</div>
@endsection
