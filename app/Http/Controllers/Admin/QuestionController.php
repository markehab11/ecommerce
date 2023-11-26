<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('admin.pages.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.pages.questions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        Question::create([
            'key' => $request->key,
            'value' => $request->value,
        ]);
        return redirect()->route('questions.index')->with('message', 'Successfully!');
    }

    public function show(Question $question)
    {
        //
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.pages.questions.edit', compact('question'));
    }

    public function update(Request $request, $id )
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $questions = Question::findOrFail($id);
        $questions->update([
            'key' => $request->key,
            'value' => $request->value,
        ]);
        return redirect()->route('questions.index')->with('message', 'Successfully!');
    }

    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->route('questions.index');
    }
}
