<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Candidate;
use App\Availability;
use App\Comment;
use App\User;
use Webpatser\Uuid\Uuid;

class SchedulesController extends Controller
{

    public function index() {
        $schedules = Schedule::latest()->get();
        return view('home')->with('schedules', $schedule);
    }
    
    //詳細ページの情報を取得し表示するための処理
    public function show($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $user = User::findOrFail(Auth::id());
        $candidates = $schedule->candidates;
        $availabilities = $schedule->availabilities;
        $comment = $schedule->comments;
        $candidateAvailabilityArray = [];
        foreach ($candidates as $candidate) {
            $candidateName = $candidate->candidateName;
            $availability = Candidate::findOrFail($candidate->candidateId)->availability->availability;
            $candidateAvailabilityArray[$candidateName] = $availability;
        }
        return view('show')->with([
            'schedule' => $schedule,
            'user' => $user,
            'candidateAvailabilityArray' => $candidateAvailabilityArray,
            'comment' => $comment
            ]);
    }

    //スケジュール調整自体を削除したい時の処理
    public function destroy($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->delete();
        return redirect('/home');
    }

    //新しいスケジュールを作る時のページ情報を返す処理
    public function create() {
        return view('new');
    }

    //スケジュールを新しく作成する時の処理
    public function store(Request $request) {
        $this->validate($request, [
            'scheduleName' => 'required',
            'memo' => 'required',
            'candidates' => 'required',
        ]);
        $schedule = new Schedule();
            $schedule->scheduleId = Uuid::generate()->string;
            $schedule->scheduleName = $request->scheduleName;
            $schedule->memo = $request->memo;
            $schedule->createdBy = Auth::user();
            $schedule->save();
            $candidatesRows = explode("\r\n", $request->candidates);
            foreach($candidatesRows as $newCandidate) {
                $candidate = new Candidate();
                    $candidate->candidateName = $newCandidate;
                    $candidate->scheduleId = $schedule->scheduleId;
                    $candidate->save();
                $availability = new Availability();
                    $user = User::findOrFail(Auth::id());
                    $availability->candidateId = $candidate->candidateId;
                    $availability->userId = $user->id;
                    $availability->availability = config('const.DEFAULT_VALUE');
                    $availability->scheduleId = $schedule->scheduleId;
                    $availability->save();
            }
        return redirect('/home');
    }

    //編集画面までのデータ処理
    public function edit($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $user = User::findOrFail(Auth::id());
        $candidates = $schedule->candidates;
        $availabilities = $schedule->availabilities;    
        return view('edit')->with([
            'schedule' => $schedule,
            'candidate' => $candidates,
            'user' => $user,
            'availability' => $availabilities,
            ]);
    }

    //編集の処理
    public function update(Request $request, $scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
            $schedule->scheduleName = $request->scheduleName;
            $schedule->memo = $request->memo;
            $schedule->createdBy = Auth::id();
            $schedule->save();
        $user = User::findOrFail(Auth::id());
        $candidatesRows = explode("\r\n", $request->candidates);
        foreach($candidatesRows as $newCandidate) {
            $candidate = new Candidate();
                $candidate->candidateName = $newCandidate;
                $candidate->scheduleId = $schedule->scheduleId;
                $candidate->save();
            $availability = new Availability();
                $availability->candidateId = $candidate->candidateId;
                $availability->userId = $user->id;
                $availability->availability = config('const.DEFAULT_VALUE');
                $availability->scheduleId = $schedule->scheduleId;
                $availability->save();
        }
        return redirect('/home');
    }
}
