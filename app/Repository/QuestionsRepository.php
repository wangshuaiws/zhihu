<?php
namespace App\Repository;

use App\Question;
use App\Topic;

class QuestionsRepository{

    public function byIdWithTopics($id)
    {
        return Question::with('topics')->findOrFail($id);
    }

    public function create($data)
    {
        return Question::create($data);
    }

    public function deal(array $topics)
    {
        return collect($topics)->map(function ($topic){
            if(is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int) $topic;
            }
            $newTopic = Topic::create(['name' => $topic,'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();

    }

    public function byId($id)
    {
        return Question::findOrFail($id);
    }

    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();

    }
}