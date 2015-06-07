<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laracasts\Flash\Flash;

class TestsCasesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($question_id)
	{
		$testCases = Question::findOrFail($question_id);
		return ($testCases->testCases);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($question_id)
	{
		$question = Question::findOrFail($question_id);
		return view('testcases.create', compact('question'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($question_id)
	{
		$testCases = array();
		$inputs = Input::get('input');
		$outputs = Input::get('output');
		for($i=0;$i< count($inputs);$i++){
			$testCases[] = new TestCase(['input' => $inputs[$i], 'output' => $outputs[$i] ]);
		}

		$question = Question::findOrFail($question_id);

		$question->testCases()->saveMany($testCases);

		Flash::success("Test Cases Added Successfully");
		return redirect('/home');
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
