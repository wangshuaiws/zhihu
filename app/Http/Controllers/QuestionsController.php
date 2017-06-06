<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repository\QuestionsRepository;
use Illuminate\Http\Request;
use Auth;

class QuestionsController extends Controller
{
    private $questionrepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(QuestionsRepository $questionrepository)
    {
       $this->middleware('auth')->except(['index','show']);
        $this->questionrepository = $questionrepository;
    }

    public function index()
    {
        $questions = $this->questionrepository->getQuestionsFeed();
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        //将验证规则写入StoreQuestionRequestion中 通过依赖注入来实现验证规则 使控制器的代码变得简单
//        $rules = [
//           'title' => 'required|min:6|max:196',
//           'body' => 'required|min:26',
//        ];
//        $messages = [
//            'title.required' => '标题不能为空',
//            'title.min' => '标题至少为6个字符',
//            'body.required' => '填写的内容不能为空',
//            'body.min' => '填写的内容至少为26个字符',
//        ];
//        $this->validate($request,$rules,$messages);
        $topics = $this->questionrepository->deal($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
        ];
        $question = $this->questionrepository->create($data);
        $question->topics()->attach($topics);
        return redirect()->route('question.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$question = Question::where('id',$id)->with('topics')->first();
        $question = $this->questionrepository->byIdWithTopicsAndAnswers($id);
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionrepository->byId($id);
        if(Auth::user()->owns($question)) {
            return view('questions.edit',compact('question'));
        }
       return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $question = $this->questionrepository->byId($id);

        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);
        $topics = $this->questionrepository->deal($request->get('topics'));
        $question->topics()->sync($topics);
        return redirect()->route('question.show',[$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->questionrepository->byId($id);
        if(Auth::user()->owns($question)) {
            $question->delete();

            return redirect('/');
        }

        abort(403,'Forbidden'); //也可以失败直接返回 return back();
    }
}
