@extends('layouts.app')

@section('title', 'New Schedule')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{ url('/home') }}" class="header-menu">Back</a>
          <div class="panel panel-default">
              @if (Route::has('login'))
                @auth
                  <form method="post" action="{{ url('/post') }}">
                    {{ csrf_field() }}
                    <div>
                      <h5>Schedule Name</h5>
                      <input type="text" name="scheduleName" placeholder="enter the schedule name that you want to arrange"><br>
                      @if ($errors->has('scheduleName'))
                      <span class="error">{{ $errors->first('scheduleName') }}</span>
                      @endif
                    </div>
                    <div>
                      <h5>Memo</h5>
                      <textarea name="memo"></textarea><br>
                      @if ($errors->has('memo'))
                      <span class="error">{{ $errors->first('memo') }}</span>
                      @endif
                    </div>
                    <div>
                      <h5>Candidate Schedule</h5>
                      <p>You should make new line to listup candidate schedule.</p>
                      <textarea name="candidates"></textarea><br>
                      @if ($errors->has('candidates'))
                      <span class="error">{{ $errors->first('candidates') }}</span>
                      @endif
                    </div>
                    <button type="submit">Make Schedule</button>
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