<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_player_score'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerScore extends BaseEventLivePlayerScore
{
	
	public static function quickSave($eventLiveId, $peopleId, $score, $label, $orderSeq){
		
		$eventLivePlayerScoreObj = new EventLivePlayerScore();
		$eventLivePlayerScoreObj->setEventLiveId($eventLiveId);
		$eventLivePlayerScoreObj->setPeopleId($peopleId);
		$eventLivePlayerScoreObj->setScore($score);
		$eventLivePlayerScoreObj->setLabel($label);
		$eventLivePlayerScoreObj->setOrderSeq($orderSeq);
		$eventLivePlayerScoreObj->save();
	}
}
