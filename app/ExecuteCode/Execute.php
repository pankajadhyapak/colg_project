<?php namespace App\ExecuteCode;


class Execute {

//    private $lang;
//
//    public function __construct($lang){
//        $this->lang = $lang;
//
//    }
    public function run($lang){

        switch($lang) {
            case "php": return $this->prepareForPhp();
            case "java": return $this->prepareForPhp();
            case "c": return $this->prepareForC();
        }
    }

    private function execute($cmd,$stdin=null){
        $proc=proc_open($cmd,array(0=>array('pipe','r'),1=>array('pipe','w'),2=>array('pipe','w')),$pipes);
        fwrite($pipes[0],$stdin);                      fclose($pipes[0]);
        $stdout=stream_get_contents($pipes[1]);        fclose($pipes[1]);
        $stderr=stream_get_contents($pipes[2]);        fclose($pipes[2]);
        $return=proc_close($proc);
        return array( 'stdout'=>$stdout, 'stderr'=>$stderr, 'return'=>$return );
    }


    public function prepareForPhp()
    {
        //generate Random String
        $fileName = \Illuminate\Support\Str::random(10);

        $filePath = public_path() . '/files/' . $fileName . '.php';
        \File::put($filePath, \Request::get('code'));

        $ContainerPath = public_path() . '/files/' . $fileName . 'Conatiner.php';

        $mustache = new \Mustache_Engine();

        $examObj = \App\Question::find(\Request::get('question_code'));

        $inputArray = $examObj->testCases->lists('input');
        $outPutArray = $examObj->testCases->lists('output');

        $tem = $mustache->render(file_get_contents(public_path() . "/templates/php/Single.template"), [
            'fileName' => $fileName,
            'inputArray' => '[' . implode(",", $inputArray) . ']',
            'outPutArray' => '[' . implode(",", $outPutArray) . ']'
        ]);

        file_put_contents($ContainerPath, $tem);

        //execute program
        $result = $this->execute('php ' . $ContainerPath);

        //delete Files
        unlink($filePath);
        unlink($ContainerPath);

		//return $this->testFormat($result);
        //update results
		if($result['return'] == 0 && $result['stderr'] == ""){
			return $this->formatHtml($result['stdout']);
		}
		if($result['return'] == 0 && $result['stderr'] != ""){
			return $this->ErrorFormat($result['stderr']);
		}
		
		if($result['return'] == 255){
			return $this->ErrorFormat($result['stderr']);
		}
        
    }
	
	public function ErrorFormat($str){
		return "<span class='error'>$str</span>";
	}
	
	public function testFormat($str){
		$a = "";
		foreach($str as $key => $st){
			$a .= $key." => ".$st ."<br/>";
		}
		
		return $a;
	}

    public function formatHtml($str){
        $res = explode(",",$str);
        $o = "";
		$resString[] = "";
		
		for($i=0;$i<5;$i++){
			$caseNo = $i+1;
			
			if(sizeof($res) > $i){
				$check = $res[$i];
			}else{
				$check = 0;
			}
			if($check == $caseNo){
				$resString[$i] = "<span class='success'>Case $caseNo Success</span>";
			}else{
				$resString[$i] = "<span class='error'>Case $caseNo Failed</span>";
			}
		}
        foreach($resString as $r){
            $o.= $r . "<br/>";
        }
		return $o;

    }
    public function prepareForC()
    {
        //generate Random String
        $fileName = \Illuminate\Support\Str::random(10);

        $filePath = public_path() . '/files/' . $fileName . '.c';
        //\File::put($filePath, \Request::get('code'));

        $ContainerPath = public_path() . '/files/' . $fileName . 'Container.c';

        $mustache = new \Mustache_Engine();

        $examObj = \App\Question::find(\Request::get('question_code'));

        $inputArray = $examObj->testCases->lists('input');
        $outPutArray = $examObj->testCases->lists('output');

        $tem = $mustache->render(file_get_contents(public_path() . "/templates/c/Single.template"), [
            'fileName' => $fileName,
            'inputArray' => '{' . implode(",", $inputArray) . '}',
            'outPutArray' => '{' . implode(",", $outPutArray) . '}'
        ]);

        file_put_contents($ContainerPath, $tem);

        //execute program
        $result = $this->execute('gcc ' . $ContainerPath);

//        //delete Files
//        unlink($filePath);
//        unlink($ContainerPath);


        //update results

        return $result;
    }


}