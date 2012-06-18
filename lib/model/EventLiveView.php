<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_view'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLiveView extends BaseEventLiveView
{
	
	public function toString(){
	
		$stepNumber      = $this->getStepNumber();
		$guaranteedPrize = $this->getGuaranteedPrize();
		$isSatellite     = $this->getIsSatellite();
		
		if( $stepNumber )
			$stepNumber = $stepNumber.'ª Etapa ';
		
		if( $guaranteedPrize ){
			
			if( $guaranteedPrize >=1000 && !$isSatellite )
				$guaranteedPrize = ($guaranteedPrize/1000).'K';
			
			$guaranteedPrize = " - $guaranteedPrize ".($isSatellite?'VGS ':'')."GTD";
		}else
			$guaranteedPrize = '';
		
		return $stepNumber.$this->getEventName().$guaranteedPrize;
	}
	
	public function isPastDate(){
		
		$eventDateTime   = $this->getEventDate('Y-m-d').' '.$this->getStartTime('H:i:s');
		$currentDateTime = time();
		
		return $currentDateTime > strtotime($eventDateTime);
	}
	
	public function getGameStyle($returnTagName=false){
		
		$rankingLiveId = $this->getRankingLiveId();
		
		if( !$rankingLiveId )
			return new VirtualTable();
		
		return $this->getRankingLive()->getGameStyle($returnTagName);
	}
	
	public function getGameType($returnTagName=false){
		
		$rankingLiveId = $this->getRankingLiveId();
		
		if( !$rankingLiveId )
			return new VirtualTable();
		
		return $this->getRankingLive()->getGameType($returnTagName);
	}
	
	public function getDescription($convertTags=true){
		
		$description = parent::getDescription();
		
		if( $convertTags ){
			
			$rankingDescription = $this->getRankingLive()->getDescription();
			if( empty($rankingDescription) )
				$rankingDescription = 'Sem descrição';
			
			$description = preg_replace('/[descri[çc]+[ã]+o ?do ?ranking]/i', $rankingDescription, $description);
			$description = preg_replace('/[\n]/i', '<br/>', $description);
		}
		
		return $description;
	}
	
	public function getStackChips($displayShort=false){
		
		$stackChips = parent::getStackChips();
		
		if( $displayShort )
			$stackChips = ($stackChips/1000).'K';
			
		return $stackChips;
	}
	
	public function getWeekDay(){
		
		return Util::getWeekDay($this->getEventDate('d/m/Y'));
	}
	
	public function getRankingLive($con=null){
		
		$rankingLiveObj = parent::getRankingLive($con);
		
		if( !is_object($rankingLiveObj) )
			$rankingLiveObj = new RankingLive();
			
		return $rankingLiveObj;
	}
	
	public function getFileNameLogo(){
		
		$fileNameLogo = $this->getRankingLive()->getFileNameLogo();
	
		if( $fileNameLogo=='noImage.png' )
			$fileNameLogo = 'club/original/'.$this->getClub()->getFileNameLogo();
		else
			$fileNameLogo = 'ranking/small/'.$fileNameLogo;
		
		return $fileNameLogo;
	}
}
