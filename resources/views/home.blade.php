@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>
                        <a href="{{ url('/new') }}" class="header-menu">Create New Schedule</a>
                    </h5>
                    <h2>Your schedules below</h2>
                    <table class="table">
                        <caption>Schedule aranged table</caption>
                        <tr>
                            <th>Schedule Name</th>
                            <th>Updated date</th>
                        </tr>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td><a href="{{ action('SchedulesController@show', $schedule) }}">{{ $schedule->scheduleName }}</a></td>
                                <td><a>{{ $schedule->updated_at }}</a></td>
                            </tr>
                        @empty
                            <TR>
                                <td>No schedule yet.</td>
                                <td>-</td>
                            </TR>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
