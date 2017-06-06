<?php

namespace App\Repository;

use App\Comment;

class CommentRepository
{
    public function create($attribute)
    {
        return Comment::create($attribute);
    }
}