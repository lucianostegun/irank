<?php

/**
 * Subclasse de representação de objetos da tabela 'event_prize_config'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPrizeConfig extends BaseEventPrizeConfig
{
	
	public function getPrizeValue(){
		
		$prizeValue = parent::getPrizeValue();
		$isPercent  = $this->getIsPercent();
		
		if( $isPercent )
			$prizeValue .= '%';
		
		return $prizeValue;
	}
}
