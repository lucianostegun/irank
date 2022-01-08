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
		
		$microtimeStart = microtime(true);
		$status = null;
		$filePath = Util::getFilePath('/js/'.$file);
		
		$fileObj = file($filePath);
		if( count($fileObj)==1 || preg_match('/^eval\(/', $fileObj[0]) )
			continue;
		
		try{
			
			$script = $this->obfuscate($file);
			$fp = fopen($filePath, 'w');
			fwrite($fp, $script);
			fclose($fp);
			$status = 'OK';
		}catch(Exception $e){
			
			$status = 'ERRO '.$e->getMessage();
		}
		
		$microtimeStop = microtime(true);
		echo $status.' - '.$filePath.' - '.number_format($microtimeStop*1000-$microtimeStart*1000, 5).'ms<br/>';
		
		exit;
	}
	
	exit;
  }
  
  private function obfuscate($file){

	set_time_limit(15);    
	$url = 'http://closure-compiler.appspot.com/compile';
	$code_url = 'http://www.irank.com.br/js/'.$file.'?time='.time();
	
	$compilation_level = 'SIMPLE_OPTIMIZATIONS';
	$output_format = 'text';
	$output_format = 'json';
	$output_info = 'compiled_code';
	$output_info = 'errors';

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
//	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$script = curl_exec($curl);
	curl_close($curl);
	
	if( !$script )
		throw new Exception('LEVEL_1_ERROR');
	if( preg_match('/Error\(([0-9]*)\): (.*)/', $script, $matches) )
		throw new Exception('ERROR '.$matches[1]);
	
	echo "<hr>";
	echo $script;
	
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
//	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_TIMEOUT, 20);
	$content = curl_exec($curl);
	curl_close($curl);

	preg_match('/<textarea id="packed" class="result" rows="10" cols="80" readonly="readonly">(.*)/im', $content, $matches);
	$script = $matches[1];
	$script = preg_replace('/<\/textarea>$/', '', $script);
	
	$script = html_entity_decode($script);
	if( !$script )
		throw new Exception('EMPTY');
	
	return $script;
  }
  
  public function executeReimport(){
  	
  	$criteria = new Criteria();
  	$criteria->setDistinct( RankingPeer::ID );
  	$criteria->add( RankingPeer::RANKING_TAG, null, Criteria::NOT_EQUAL );
  	$criteria->addAnd( RankingPeer::RANKING_TAG, '', Criteria::NOT_EQUAL );
  	
  	$rankingObjList = Ranking::getList(false, false, $criteria);

  	foreach($rankingObjList as $rankingObj){
  		
  		$rankingTag = $rankingObj->getRankingTag();
  		
	 	if( $rankingObj->updateEmailGroup() )
			echo 'Grupo '.$rankingTag.' criado com sucesso<br/>';
		else
			echo 'Erro ao criar o grupo '.$rankingTag.'<br/>';
  	}
  	
	exit;  	
  }
  
  public function executeTest(){
  	
	$stegunApiObj = new StegunApi();
	echo $stegunApiObj->updateEmailRedirect('teste', array('lucianostegun@gmail.com', 'luciano@stegun.com'));
// 	echo $stegunApiObj->deleteEmailRedirect('teste');
  	
	exit;  	
  }
  
  public function executeEmail(){
  	
  	$emailSubject     = 'Mensagem de teste';
  	$emailAddressList = 'lucianostegun@gmail.com';
  	$emailContent     = 'Mensagem de teste enviada pelo novo servidor do site';
	Report::sendMail($emailSubject, $emailAddressList, $emailContent);
  	
	exit;  	
  }
}
