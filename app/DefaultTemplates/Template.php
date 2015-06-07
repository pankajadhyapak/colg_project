<?php namespace App\DefaultTemplates;


class Template {

    public function get($lan)
    {
        $code = "";
        switch($lan){
            case "php": $code= $this->getPhpTemplate(); break;
            case "c":$code = $this->getCTemplate(); break;
            case "python":$code = $this->getPythonTemplate(); break;
            case "ruby":$code = $this->getRubyTemplate(); break;
            case "java":$code = $this->getJavaTemplate(); break;
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


    private function getPythonTemplate(){
        return '# you can use print for debugging purposes, e.g.
# print "this is a debug message"

def solution(a):
    # write your code in Python 2.7
    return a+10';
    }

    private function getRubyTemplate(){
        return '# you can use puts for debugging purposes, e.g.
# puts "this is a debug message"

def solution(a)
    # write your code in Ruby 2.2
end';
    }

    private function getJavaTemplate(){
        return '// you can also use imports, for example:
// import java.util.*;

// you can use System.out.println for debugging purposes, e.g.
// System.out.println("this is a debug message");

class Solution {
    public int solution(int a) {
        // write your code in Java SE 8
        return a+10;
    }
}';
    }



}