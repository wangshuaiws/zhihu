<?php

namespace App\Http\Controllers;

use App\Repository\AnswersRepository;
use App\Repository\CommentRepository;
use App\Repository\QuestionsRepository;
use Illuminate\Http\Request;
use Auth;

class CommentsController extends Controller
{
    protected $answer;
    protected $question;
    protected $comment;

    public function __construct(AnswersRepository $answer,QuestionsRepository $question,CommentRepository $comment)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->comment = $comment;
    }

    public function answer($id)
    {
        return $this->answer->getAnswerCommentsById($id);
    }

    public function question($id)
    {
        return $this->question->getQuestionCommentsById($id);
    }

    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));
        return $comment = $this->comment->create([
            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => user('api')->id,
            'body' => request('body')
        ]);
    }

    public function getModelNameFromType($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
