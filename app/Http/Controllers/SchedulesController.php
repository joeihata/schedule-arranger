<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Candidate;
use App\User;
use Webpatser\Uuid\Uuid;

class SchedulesController extends Controller
{
    public function index() {
        $schedules = Schedule::latest()->get();
        dd($schedules->toArray());
        return view('home')->with('schedules', $schedule);
    }

    public function show($scheduleId) {
        $schedule = Schedule::findOrFail($scheduleId);
        $user = User::findOrFail(Auth::id());
        $candidate = Schedule::findOrFail($scheduleId)->candidate;
        $availability = Schedule::findOrFail($scheduleId)->availability;
        //$comment = Schedule::findOrFail($scheduleId)->comment;
        $availabilityArray = [];
        foreach ($candidate as $value) {
            var_dump($value);
            $availabilityArray = $value->candidateName;
            $availability = Schedule::findOrFail($scheduleId)->availability;
            $availabilityArray = $availability->availability;
        }

        return view('show')->with([
            'schedule' => $schedule,
            'candidate' => $candidate,
            'user' => $user,
            'availability' => $availability,
            'comment' => $comment
            ]);
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
        }
        return redirect('/home');
    }
    
}
