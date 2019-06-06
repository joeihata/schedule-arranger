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
        $candidateAvailabilityArray = [];
        foreach ($candidates as $newCandidate) {
            $candidateName = $newCandidate->candidateName;
            $availability = Schedule::findOrFail($scheduleId)->availabilities->first();
            $availability = $availability->availability;
            $candidateAvailabilityArray[$candidateName] = $availability;
        }
        return view('availabilityEdit')->with([
            'schedule' => $schedule,
            'candidate' => $candidates,
            'user' => $user,
            'availability' => $availabilities,
            'candidateAvailabilityArray' => $candidateAvailabilityArray,
            'comment' => $comment
            ]);
    }

    public function update(Request $request, $scheduleId) {
        $availabilities = Availability::where('scheduleId', $scheduleId)->get();
        $count = 1;
        foreach($availabilities as $availability) {
            $availabilityValue = $request->$count;
            $availability->update(['availability' => $availabilityValue ]);
            $count++;
        }
        return redirect('/home');
    }
}
