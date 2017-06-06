<?php

namespace App\Http\Controllers;

use App\Repository\QuestionsRepository;
use Auth;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    protected $question;
    public function __construct(QuestionsRepository $question)
    {
        $this->question = $question;
        $this->middleware('auth');

    }
    public function follow($question)
    {
        Auth::user()->followThis($question);

        return back();
    }

    public function follower(Request $request)
    {
        if(user('api')->followed($request->get('question'))) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    public function following(Request $request)
    {
        $question = $this->question->byId($request->get('question'));
        $followed = user('api')->followThis($question->id);
        if(count($followed['detached']) > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }

        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
