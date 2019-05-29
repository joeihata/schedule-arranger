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
                  <form method="post" action="{{ url('/', $schedule->scheduleId) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div>
                      <h5>Schedule Name</h5>
                      <input type="text" name="scheduleName" 
                        placeholder="enter the schedule name that you want to arrange"
                        value="{{ old('scheduleName', $schedule->scheduleName) }}"
                      >
                    </div>
                    <div>
                      <h5>Memo</h5>
                      <textarea name="memo" placeholder="add some memo">{{ old('memo', $schedule->memo) }}</textarea>
                    </div>
                    <div>
                      <h5>Candidate Dates</h5>
                      <p>You should make new line to listup candidate dates.</p>
                      <textarea name="candidates" placeholder="add candidate dates">@foreach($candidate as $value){{old('', $value->candidateName)}}@endforeach</textarea>
                    </div>
                    <button type="submit" value="Update">Edit Schedule</button>
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