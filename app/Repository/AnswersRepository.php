<?php
namespace App\Repository;

use App\Answer;

class AnswersRepository {
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
}