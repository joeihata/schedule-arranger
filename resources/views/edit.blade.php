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
                      <h5>日程名</h5>
                        <input type="text" name="scheduleName" placeholder="enter the schedule name that you want to arrange" value="{{ old('scheduleName', $schedule->scheduleName) }}">
                        {{-- バリデーション　--}}
                        @if ($errors->has('scheduleName'))
                        <span class="error">{{ $errors->first('scheduleName') }}</span>
                        @endif
                    </div>

                    <div>
                      <h5>メモ</h5>
                        <textarea name="memo" placeholder="add some memo">{{ old('memo', $schedule->memo) }}</textarea>
                        {{-- バリデーション　--}}
                        @if ($errors->has('memo'))
                        <span class="error">{{ $errors->first('memo') }}</span>
                        @endif
                    </div>

                    <div>
                      <h5>候補日一覧</h5>
                        <p>※予定を作成するときは改行して入力してください。また、半角英数字で入力をお願いいたします。</p>
                          <textarea name="candidates" placeholder="add candidate dates">@foreach($candidate as $newCandidate){{old('', $newCandidate->candidateName)}}@endforeach</textarea>
                          {{-- バリデーション　--}}
                          @if ($errors->has('candidates'))
                          <span class="error">{{ $errors->first('candidates') }}</span>
                          @endif
                    </div>

                    <button type="submit" value="Update">変更内容を保存する</button>
                  </form>
                @else
                  <a href="{{ route('login') }}">ログイン</a>
                  <a href="{{ route('register') }}">会員登録する</a>
                @endauth
              @endif
          </div>
        </div>
    </div>

</div>
@endsection