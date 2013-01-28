<?php

/**
 * util actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class utilActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
  }

  public function executeGetAddressByZipcode($request){
  	
  	$zipcode = $request->getParameter('zipcode');
  	
	echo Util::getAddressByZipcode($zipcode, false);
	exit;
  }
  
  public function executeObfuscate($request){
	
	$fileList = array();
	
	// create a handler for the directory
	$handler = opendir(Util::getFilePath('/js'));
	
	// open directory and walk through the filenames
	while($file = readdir($handler))
		if( preg_match('/.js$/', $file) )
			$fileList[] = $file;
	
	// tidy up: close the handler
	closedir($handler);
	
	foreach($fileList as $file){
		
		ob_start();
		ignore_user_abort(true);
		
		$microtimeStart = microtime(true);
		$script = $this->obfuscate($file);
		$filePath = Util::getFilePath('/js/'.$file);
		$fp = fopen($filePath, 'w');
		fwrite($fp, $script);
		fclose($fp);
		$microtimeStop = microtime(true);
		
		echo 'OK - '.$filePath.' - '.number_format($microtimeStop*1000-$microtimeStart*1000, 5).'ms<br/>';
		
		$content = ob_get_contents();
		ob_end_clean();
		$len = strlen($content);             // Get the length
//		header('Connection: close');         // Tell the client to close connection
//		header("Content-Length: $size");
		echo $content;                       // Output content
		flush();
	}
	
	exit;
  }
  
  private function obfuscate($file){
    
	$url = 'http://closure-compiler.appspot.com/compile';
	$code_url = 'http://www.irank.com.br/js/'.$file;
	$compilation_level = 'SIMPLE_OPTIMIZATIONS';
	$output_format = 'text';
	$output_info = 'compiled_code';

	$params = array('code_url'=>$code_url,
				    'compilation_level'=>$compilation_level,
				    'output_format'=>$output_format,
				    'output_info'=>$output_info);
    
	$string = '';
	$first = true;
	foreach($params as $field=>$param){
  	
		$param = ($param);
		
		if( !$first )
			$string .= '&';
		
		$string .= $field.'='.$param;
		$first = false;
	}

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $string);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$script = curl_exec($curl);
	curl_close($curl);
	
	
	
	
	
	
	
	
	$url = 'http://www.phpblog.com.br/exemplos/encodejavascript/index.php';
	$params = array ('src'=>urlencode($script),
					 'ascii_encoding'=>10);
					 
	$string = '';
	$first = true;
	foreach($params as $field=>$param){
  	
		$param = ($param);
		
		if( !$first )
			$string .= '&';
		
		$string .= $field.'='.$param;
		$first = false;
	}

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $string);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_TIMEOUT, 20);
	$content = curl_exec($curl);
	curl_close($curl);

	preg_match('/<textarea id="packed" class="result" rows="10" cols="80" readonly="readonly">(.*)/im', $content, $matches);
	$script = $matches[1];
	$script = html_entity_decode($script);
	
	return $script;
  }
}
