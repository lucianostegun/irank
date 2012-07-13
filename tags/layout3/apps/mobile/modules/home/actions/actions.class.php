<?php

/**
 * Classe de controle do módulo de entrada do sistema , 
 * contém os métodos que representam as regras de negócio dentro do módulo
 * e precedem a execução da classe de exibição
 *
 * @package    Research beta
 * @subpackage home
 * @author     Luciano Stegun
 */
class homeActions extends sfActions
{

  public function executeIndex($request){
  }

  public function executeClassic($request){
  	
    	echo '<html><head><meta http-equiv="refresh" content="0;url=http://www.irank.com.br?fc=1"/></head></html>';
    
  	exit;
  }
  
  public function executeChangeLanguage($request){
	
	$culture = $request->getParameter('culture');
	$this->getUser()->setCulture($culture);
	$this->getUser()->setAttribute('culture', $culture);
	exit;
  }
  
  public function executeJavascript($request){
	
	Util::getHelper('i18n');
	
    header('Content-type: text/x-javascript');
		
	$nl = chr(10);
	
	$peopleId   = $this->getUser()->getAttribute('peopleId');
	
	echo 'var i18n_culture             = "'.$this->getUser()->getCulture().'";'.$nl;
	echo 'var i18n_innerLoading        = "'.__('layout.innerLoading').'";'.$nl;
	echo 'var i18n_changeLanguageError = "'.__('layout.changeLanguageError').'";'.$nl;
	exit;
  }
}
