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
                            <th>
                                {{ $user->name }}
                                <a href="{{ action('AvailabilityEditController@edit', $schedule) }}" class="edit">[ Availability edit ]</a>
                            </th>
                        </tr>
                        @foreach ($array as $key => $value)
                            <tr>
                                <td><p>{{ $key}}</p></td>
                                <td>
                                    <p>{{ $value }}</p>
                                </td>
                            </tr>
                        @endforeach
                        <td></td>
                        <td>
                        @if ($comment)
                            @foreach( $comment as $value)
                                <p>{{ $value->comment }}</p><br>
                            @endforeach
                            <form method="post" action="{{ url('/post/comment', $schedule->scheduleId) }}">
                                {{ csrf_field() }}
                                <textarea name="comment" placeholder="add comments"></textarea>
                                <br>
                                @if ($errors->has('comment'))
                                    <span class="error">{{ $errors->first('comment') }}</span>
                                @endif
                                <br>
                                <button type="submit" value="Update">Add Comment</button>
                                
                            </form>
                        @else 
                            <form method="post" action="{{ url('/post/comment', $schedule->scheduleId) }}">
                                {{ csrf_field() }}
                                <textarea name="comment" placeholder="add comments"></textarea>
                                <br>
                                @if ($errors->has('comment'))
                                    <span class="error">{{ $errors->first('comment') }}</span>
                                @endif
                                <br>
                                <button type="submit" value="Update">Add Comment</button>
                            </form>
                        @endif
                        </td>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
