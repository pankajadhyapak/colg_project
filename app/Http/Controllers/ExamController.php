<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ExamController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		if( \Auth::check()){
			
			if($excode = Input::has('exam_code')){
				if($question = Question::where('exam_code', Input::get('exam_code'))->firstOrFail()){
					$template = \Template::get($question->language);
					$student = true;
					return view('exams.create', compact('question','template','student'));
				}
			}
			
			if($excode = Input::has('eval_code')){
				if($question = Exam::where('exam_code', Input::get('eval_code'))->firstOrFail()){
					$template = \Template::get($question->language);
					$student = false;
					return view('exams.create', compact('question','template','student'));
				}
			}
			
		}else{
			return redirect('/auth/login');
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
