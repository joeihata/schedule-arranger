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

class CommentController extends Controller
{
    public function store(Request $request, $scheduleId) {
        $comments = new Comment();
            $comments->scheduleId = $scheduleId;
            $comments->userId = Auth::id();
            $comments->comment = $request->comment;
            $comments->save();
        return redirect('/home');
    }
}
