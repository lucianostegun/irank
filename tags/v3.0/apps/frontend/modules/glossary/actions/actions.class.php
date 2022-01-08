<?php

/**
 * glossary actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class glossaryActions extends sfActions
{

  public function preExecute(){
    
    $term       = $this->getRequestParameter('term');
    $term       = trim($term);
    $this->term = html_entity_decode($term);
  }
  
  public function executeIndex($request){
    
  }
  
  public function executeTerm($request){
    
    $this->glossaryObj = GlossaryPeer::retrieveByTerm($this->term);
    $this->letter = substr($this->term, 0, 1);
  }
  
  public function executeLetter($request){
    
    $this->letter = $request->getParameter('letter');
  }
  
  public function executeGetTerm($request){
    
    $glossaryObj = GlossaryPeer::retrieveByTerm($this->term);
    
    if( !is_object($glossaryObj) ){
    	
    	$glossaryObj = new Glossary();
		$glossaryObj->setTerm($this->term);
		$glossaryObj->setVisible(false);
		$glossaryObj->setEnabled(true);
		$glossaryObj->setDeleted(false);
		$glossaryObj->save();
    	
    	Report::sendMail('Pesquisa de termo', null, 'O termo "<b>'.$this->term.'</b>" foi pesquisado no glossário do site.', array('emailTemplate'=>'emailTemplateAdmin'));
    	
    	Util::forceError('Termo não encontrado!');
    }
    
    $description = $glossaryObj->getDescription(true);
    echo $description;
    exit;
  }
}
