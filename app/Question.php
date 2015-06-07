<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model {

    protected $fillable = ['title', 'body','language','created_by','note','exam_code'];

    public function setExamCodeAttribute($value)
    {
        $this->attributes['exam_code'] = $this->genExamCode();
    }

    public function testCases()
    {
        return $this->hasMany('App\TestCase');
    }

    public function  genExamCode(){


        $examCode = bin2hex(openssl_random_pseudo_bytes(3));

        if(Question::where('exam_code', $examCode)->first()){
            $this->genExamCode();
        }else{
            return $examCode;
        }
    }
}
