<?php

class homeActions extends sfActions
{

  public function executeIndex($request){

  }

  public function executeResume($request){

    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('home/component/resume'));
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
	
	echo 'var _imageRoot = "http://'.$request->getHost() .'/images";'.$nl;
	echo 'var _CurrentPeopleId = "'.$peopleId.'";'.$nl;
	
	echo 'var i18n_culture             = "'.$this->getUser()->getCulture().'";'.$nl;
	echo 'var i18n_record_exitAlert    = "'.__('record.exitAlert').'";'.$nl;
	echo 'var i18n_tryAgain            = "'.__('tryAgain').'";'.$nl;
	echo 'var i18n_disable             = "'.__('disable').'";'.$nl;
	echo 'var i18n_enable              = "'.__('enable').'";'.$nl;
	echo 'var i18n_zero_zeroZero       = "'.__('zero.zeroZero').'";'.$nl;
	echo 'var i18n_innerLoading        = "'.__('layout.innerLoading').'";'.$nl;
	echo 'var i18n_changeLanguageError = "'.__('layout.changeLanguageError').'";'.$nl;
	exit;
  }
}
