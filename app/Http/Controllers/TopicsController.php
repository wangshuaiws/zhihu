<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TopicsRepository;

class TopicsController extends Controller
{
    protected $topics;
    public function __construct(TopicsRepository $topics)
    {
        $this->topics = $topics;
    }

    public function index(Request $request)
    {
        return $this->topics->getTopicsForTagging($request);
    }
}
