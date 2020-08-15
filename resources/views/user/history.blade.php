@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header"><center>Workshop History</center></div><br><br>

    @if($workshops->count() != null)
    <div class="card-body">
        As a facilitator:
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="4">Workshops you created before :</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Problem</th>
                    <th>Date</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($workshops as $w)
                <tr>
                    <td>{{$w->Title}} </td>
                    <td>{{$w->Problem}} </td>
                    <td>{{$w->created_at}} </td>
                    <td>
                    <button type="button" class="btn btn-outline-success btn-sm float-right" onclick="window.location.href = '/gohome' ">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($ideas->count() != null)
    <div class="card-body">
        As a participant:
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Problem</th>
                    <th>Date</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($ideas as $i)
                <tr>
                    <td>{{$i->workshop->Title}} </td>
                    <td>{{$i->workshop->Problem}} </td>
                    <td>{{$i->workshop->created_at}} </td>
                    <td>
                    <button type="button" class="btn btn-outline-success btn-sm float-right" onclick="window.location.href = '/home' ">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
</div>
</div>
</div>
@endsection