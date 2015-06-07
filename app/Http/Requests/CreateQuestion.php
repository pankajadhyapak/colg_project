<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Auth\Guard;

class CreateQuestion extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		if($auth->check() && $auth->user()->role == "faculty"){
			return true;
		}

		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			"title" => "required",
  			"body" => "required",
  			"language" => "required",

		];
	}

}
