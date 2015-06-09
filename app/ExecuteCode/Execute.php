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
            case "java": return $this->prepareForJava();
            case "python": return $this->prepareForPython();
            case "c": return $this->prepareForC();
            case "ruby": return $this->prepareForRuby();
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
			return $this->formatHtml($result['stdout'],$examObj->testCases->count());
		}
		if($result['return'] == 0 && $result['stderr'] != ""){
			return $this->ErrorFormat($result['stderr']);
		}
		
		if($result['return'] == 255){
			return $this->ErrorFormat($result['stderr']);
		}
        
    }

    public function prepareForPython()
    {


        //generate Random String
        $fileName = \Illuminate\Support\Str::random(10);

        $filePath = public_path() . '/files/' . $fileName . '.py';
        $code = \Request::get('code');

        $mustache = new \Mustache_Engine();

        $examObj = \App\Question::find(\Request::get('question_code'));

        $inputArray = $examObj->testCases->lists('input');
        $outPutArray = $examObj->testCases->lists('output');

        $tem = $mustache->render(file_get_contents(public_path() . "/templates/python/Single.template"), [
            'code' => $code,
            'inputArray' => '[' . implode(",", $inputArray) . ']',
            'outPutArray' => '[' . implode(",", $outPutArray) . ']'
        ]);

        file_put_contents($filePath, $tem);

        //execute program
        $result = $this->execute('python ' .$filePath);
        //return $result['stdout'];
        //delete Files

        unlink($filePath);
        //return $this->testFormat($result);
        //update results
        if($result['return'] == 0 && $result['stderr'] == ""){
            return $this->formatHtml($result['stdout'], $examObj->testCases->count());
        }
        if($result['return'] == 0 && $result['stderr'] != ""){
            return $this->ErrorFormat($result['stderr']);
        }

        if($result['return'] == 1){
            return $this->ErrorFormat($result['stderr']);
        }

    }

    public function prepareForJava()
    {


        //generate Random String
        $fileName = \Illuminate\Support\Str::random(10);

        $filePath = public_path() . '/files/' . $fileName . '.java';
        $code = \Request::get('code');

        $mustache = new \Mustache_Engine();

        $examObj = \App\Question::find(\Request::get('question_code'));

        $inputArray = $examObj->testCases->lists('input');
        $outPutArray = $examObj->testCases->lists('output');

        $tem = $mustache->render(file_get_contents(public_path() . "/templates/java/Single.template"), [
            'fileName' => $fileName,
            'code' => $code,
            'inputArray' => '{' . implode(",", $inputArray) . '}',
            'outPutArray' => '{' . implode(",", $outPutArray) . '}'
        ]);

        file_put_contents($filePath, $tem);

        //execute program
        $result = $this->execute('javac ' .$filePath);

        //return var_dump($result);
        //return $result['stdout'];
        //delete Files
        unlink($filePath);

        //return $this->testFormat($result);
        //update results

        if($result['return'] == 0 && $result['stderr'] == ""){

            $result = $this->execute('java -cp '.public_path().'/files/ '.$fileName);

            if($result['return'] == 0 && $result['stderr'] == ""){
                return $this->formatHtml($result['stdout'], $examObj->testCases->count());
            }
            if($result['return'] == 0 && $result['stderr'] != ""){
                return $this->ErrorFormat($result['stderr']);
            }

            if($result['return'] == 255){
                return $this->ErrorFormat($result['stderr']);
            }
        }
        if($result['return'] == 0 && $result['stderr'] == ""){
            return $this->formatHtml($result['stdout'], $examObj->testCases->count());
        }
        if($result['return'] == 0 && $result['stderr'] != ""){
            return $this->ErrorFormat($result['stderr']);
        }

        if($result['return'] == 1){
            return $this->ErrorFormat($result['stderr']);
        }

    }

    public function prepareForRuby()
    {


        //generate Random String
        $fileName = \Illuminate\Support\Str::random(10);

        $filePath = public_path() . '/files/' . $fileName . '.rb';
        $code = \Request::get('code');

        $mustache = new \Mustache_Engine();

        $examObj = \App\Question::find(\Request::get('question_code'));

        $inputArray = $examObj->testCases->lists('input');
        $outPutArray = $examObj->testCases->lists('output');

        $tem = $mustache->render(file_get_contents(public_path() . "/templates/ruby/Single.template"), [
            'code' => $code,
            'inputArray' => '[' . implode(",", $inputArray) . ']',
            'outPutArray' => '[' . implode(",", $outPutArray) . ']'
        ]);

        file_put_contents($filePath, $tem);

        //execute program
        $result = $this->execute('ruby ' .$filePath);
        //return $result['stdout'];
        //delete Files
        unlink($filePath);
        //unlink($ContainerPath);
		
        //return $this->testFormat($result);
        //update results
        if($result['return'] == 0 && $result['stderr'] == ""){
            return $this->formatHtml($result['stdout'], $examObj->testCases->count());
        }
        if($result['return'] == 0 && $result['stderr'] != ""){
            return $this->ErrorFormat($result['stderr']);
        }

        if($result['return'] == 1){
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

    public function formatHtml($str,$totalTestCases){

        $res = explode(",",$str);
        array_pop($res);
		
		\Session::put(\Auth::id()."testCases", count($res));
        $o = "";
		$resString[] = "";

        for($i=1;$i<=$totalTestCases;$i++){
            if(in_array($i, $res)){
				$resString[$i] = "<span class='success'>Case $i Success</span>";
			}else{
				$resString[$i] = "<span class='error'>Case $i Failed</span>";
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