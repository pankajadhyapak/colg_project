<?php


function solution($input)
{
    //write your solution here and return the result
    return array_sum(str_split($input));
}

$inp = [12345,12346,12347,12348,12349];

$out = [15,16,17,18,19];

$result ="";

for($i=0;$i<count($inp);$i++){
    if(solution($inp[$i]) == $out[$i]){
        $result .= $i+1;
                $result .=",";
    }
}

echo $result;