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
  	
  	$this->getUser()->setAttribute('forceClassic', '1');

  	$response = sfContext::getResponse();
  	
    echo '<html><head><meta http-equiv="refresh" content="0;url=/index.php"/></head></html>';
    
  	exit;
  }
}
