<?php

/**
 * Subclasse de representação de objetos da tabela 'timer'.
 *
 * 
 *
 * @package lib.model
 */ 
class Timer extends BaseTimer
{
	
	public function getTotalDuration(){
		
		return Util::executeOne('SELECT SUM(duration) FROM timer_level WHERE timer_id = '.$this->getId());
	}
}
