<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use Auth;
use App\Repository\AnswersRepository;

class AnswerController extends Controller
{
    protected $answer;
    public function __construct(AnswersRepository $answer)
    {
        $this->answer = $answer;
    }


    public function store(StoreAnswerRequest $request, $question)
    {
        //dd($request->all());
        $answer = $this->answer->create([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);
        $answer->question()->increment('answers_count');

        return back();
    }
}
