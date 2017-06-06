<?php

namespace App\Http\Controllers;

use App\Repository\AnswersRepository;
use Illuminate\Http\Request;
use Auth;

class VotesController extends Controller
{
    protected $answer;
    public function __construct(AnswersRepository $answer)
    {
        $this->answer = $answer;
    }

    public function users($id)
    {
        if(user('api')->hasVoteFor($id)) {
            return response()->json(['voted' => 'true']);
        }
        return response()->json(['voted' => 'false']);
    }

    public function vote()
    {
        $answer = $this->answer->byId(request('answer'));
        $voted = user('api')->voteFor(request('answer'));

        if(count($voted['attached']) > 0) {
            $answer->increment('votes_count');
            return response()->json(['voted' => true]);
        }
        $answer->decrement('votes_count');
        return response()->json(['voted' => false]);

    }
}
