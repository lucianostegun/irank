<?php

class searchActions extends sfActions
{

  public function executeIndex($request){
  	
  	$this->keyWord = $request->getParameter('mainSearch');
  	
	try{

		$keywords = $this->keyWord;
		$keywords = pg_escape_string($keywords);
		
		$sql = "INSERT INTO search_log(keywords, created_at)
					VALUES('$keywords', CURRENT_TIMESTAMP)";

		Util::executeQuery($sql, null, 'log');
	}catch(Exception $e){}
  }
}
