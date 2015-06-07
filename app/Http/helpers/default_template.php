<?php

function get_default_template($lan){
    $code = "";
    switch($lan){
        case "php":
            $code='<?php
function solution($input)
{
    //write your solution here and return the result
    return $result;
}';
            break;

        case "java":
            $code = "import java.util.*;

class Solution {
    public int solution(int[] A) {
        // write your code in Java SE 8
    }
}
";
            break;
        case "c++":
            $code ="// you can use includes, for example:
// #include <algorithm>

// you can write to stdout for debugging purposes, e.g.
// cout << 'this is a debug message/' << endl;

int solution(vector<int> &A) {
    // write your code in C++11
}";
            break;
        case "python":
            $code = "# you can use print for debugging purposes, e.g.
# print 'this is a debug message'

def solution(A):
    # write your code in Python 2.7
    pass";
            break;

    }

    return $code;
}