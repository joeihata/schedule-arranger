@extends('layouts.app')

@section('title', 'Edit Schedule')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{ url('/home') }}" class="header-menu">Back</a>
          <div class="panel panel-default">
              @if (Route::has('login'))
                @auth
                  <form method="post" action="{{ url('/attend', $schedule->scheduleId) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
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
                        @php
                          $count = 1;
                        @endphp
                        @foreach ($candidateAvailabilityArray as $candidateName => $availability)
                            <tr>
                                <td><p>{{ $candidateName }}</p></td>
                                <td>
                                  <select name="{{ $count }}">
                                    <option value="欠席">欠席</option>
                                    <option value="未定">未定</option>
                                    <option value="出席">出席</option>
                                  </select>
                                </td>
                            </tr>
                            @php
                              $count++;
                            @endphp
                        @endforeach
                        <button type="submit" value="Update">Edit Availability</button>
                      </table> 
                    </form>
                @else
                  <a href="{{ route('login') }}">Login</a>
                  <a href="{{ route('register') }}">Register</a>
                @endauth
              @endif
          </div>
        </div>
    </div>
</div>

@endsection