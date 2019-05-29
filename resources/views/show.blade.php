@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>ScheduleName : {{ $schedule->scheduleName }}</h4>
                    <h6 style="white-space:pre;">memo : {{ $schedule->memo }}</h6>
                    <p>Host Name : {{ $user->name }}</p>
                    <h3>Availability table</h3>
                     <table class="table">
                        <caption>Compare availabilities of participants</caption>
                        <tr>
                            <th>Candidate dates</th>
                            <th>{{ $user->name }}</th>
                        </tr>
                        @foreach ($candidate as $value)
                            <tr>
                                <td><a>{{ $value->candidateName }}</a></td>
                                <td>
                                @foreach ($availability as $value)
                                    <a>{{ $value->availability }}</a>
                                @endforeach
                                </td>
                            </tr>
                        @endforeach
                        <td></td>
                        @foreach ($user as $value)
                        <td>
                            <form method="post" action="{{ url('/', $schedule->scheduleId) }}">
                                {{ csrf_field() }}
                                <textarea name="comment" placeholder="add comments"></textarea>
                            </form>
                        </td>
                        @endforeach
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
