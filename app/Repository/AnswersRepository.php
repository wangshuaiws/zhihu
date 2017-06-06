<?php
namespace App\Repository;

use App\Answer;

class AnswersRepository {
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }

    public function byId($id)
    {
        return Answer::findOrFail($id);
    }

    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with('comments','comments.user')->where('id',$id)->first();

        return $answer->comments;
    }

}