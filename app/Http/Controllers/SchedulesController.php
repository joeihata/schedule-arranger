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

    public function show($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $user = User::findOrFail(Auth::id());
        $candidates = Schedule::findOrFail($scheduleId)->candidates;
        $availabilities = Schedule::findOrFail($scheduleId)->availabilities;
        $comment = Schedule::findOrFail($scheduleId)->comments;
        $array = [];
        foreach ($candidates as $value) {
            $candidateName = $value->candidateName;
            $availability = Schedule::findOrFail($scheduleId)->availabilities->first();
            $availability = $availability->availability;
            $array[$candidateName] = $availability;
        }
        return view('show')->with([
            'schedule' => $schedule,
            'candidate' => $candidates,
            'user' => $user,
            'availability' => $availabilities,
            'array' => $array,
            'comment' => $comment
            ]);
    }

    public function destroy($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->delete();
        return redirect('/home');
    }

    public function create() {
        return view('new');
    }

    public function store(Request $request) {
        $schedule = new Schedule();
            $schedule->scheduleId = Uuid::generate()->string;
            $rows = explode("\r\n", $request->candidates);
            $schedule->scheduleName = $request->scheduleName;
            $schedule->memo = $request->memo;
            $schedule->createdBy = Auth::user();
            $schedule->save();
            foreach($rows as $value) {
                $candidate = new Candidate();
                    $candidate->candidateName = $value;
                    $candidate->scheduleId = $schedule->scheduleId;
                    $candidate->save();
                $availability = new Availability();
                    $user = User::findOrFail(Auth::id());                    
                    $availability->candidateId = $candidate->candidateId;
                    $availability->userId = $user->id;
                    $availability->availability = '欠席';
                    $availability->scheduleId = $schedule->scheduleId;
                    $availability->save();
            }
        return redirect('/home');
    }

    public function edit($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $user = User::findOrFail(Auth::id());
        $candidates = Schedule::findOrFail($scheduleId)->candidates;
        $availabilities = Schedule::findOrFail($scheduleId)->availabilities;
        $availabilityArray = [];
        foreach ($candidates as $value) {
            $availabilityArray = $value->candidateName;
            $availability = Schedule::findOrFail($scheduleId)->availabilities->first();
            $availabilityArray = $availability->availability;
        }
        return view('edit')->with([
            'schedule' => $schedule,
            'candidate' => $candidates,
            'user' => $user,
            'availability' => $availabilities,
            ]);
    }

    public function update(Request $request, $scheduleId) {
        //$schedule->scheduleId = Uuid::generate()->string;
        $rows = explode("\r\n", $request->candidates);
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->scheduleName = $request->scheduleName;
        $schedule->memo = $request->memo;
        $schedule->createdBy = Auth::id();
        $schedule->save();
        foreach($rows as $value) {
            $candidate = new Candidate();
                $candidate->candidateName = $value;
                $candidate->scheduleId = $schedule->scheduleId;
                $candidate->save();
                $user = User::findOrFail(Auth::id());
            $availability = new Availability();
                $availability->candidateId = $candidate->candidateId;
                $availability->userId = $user->id;
                $availability->availability = 0;
                $availability->scheduleId = $schedule->scheduleId;
                $availability->save();
        }
        return redirect('/home');
    }
}
