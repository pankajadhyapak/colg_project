<?php namespace App\DefaultTemplates;


class Template {

    public function get($lan)
    {
        $code = "";
        switch($lan){
            case "php": $code= $this->getPhpTemplate(); break;
            case "c":$code = $this->getCTemplate(); break;
        }


        return $code;
    }

    private function getPhpTemplate(){
        return '<?php
function solution($input)
{
    //write your solution here and return the result
     return array_sum(str_split($input));
}';
    }

    private function getCTemplate(){
        return 'int solution(int a) {
    // write your code in C99

    return a+10;
}';
    }



}