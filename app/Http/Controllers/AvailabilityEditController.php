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

class AvailabilityEditController extends Controller
{
    public function edit($scheduleId) {
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
        return view('availabilityEdit')->with([
            'schedule' => $schedule,
            'candidate' => $candidates,
            'user' => $user,
            'availability' => $availabilities,
            'array' => $array,
            'comment' => $comment
            ]);
    }

    public function update(Request $request, $scheduleId) {
        $availabilities = Availability::where('scheduleId', $scheduleId)->get();
        $count = 2;
        dd($request->$count);
         foreach($availabilities as $availability) {
            $availability->update(['availability' => $request->$count]);
            $count++;
        }
        return redirect('/home');
    }
}
