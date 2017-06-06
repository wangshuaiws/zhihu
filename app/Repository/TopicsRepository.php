<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Topic;

class TopicsRepository
{
    public function getTopicsForTagging(Request $request)
    {
        $topics = Topic::select(['id','name'])
            ->where('name','like','%'.$request->query('q').'%')
            ->get();
        return $topics;
    }
}