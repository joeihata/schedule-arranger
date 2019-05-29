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
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td><a href="{{ action('SchedulesController@show', $schedule) }}">{{ $schedule->scheduleName }}</a></td>
                                <td>{{ $schedule->updated_at }}</td>
                                <td><a href="{{ action('SchedulesController@edit', $schedule) }}" class="edit">[ edit ]</a></td>
                                <td>
                                    <form method="post" action="{{ url('/posts', $schedule->scheduleId) }}" id="form_{{ $schedule->scheduleId }}">
                                        <input type="submit" class="del" data-id="{{ $schedule->scheduleId }}" value="[ delete ]">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                    </form>
                                </td>
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
