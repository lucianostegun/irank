<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLive extends BaseRankingLive
{
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$rankingName   = $request->getParameter('rankingName');
		$rankingTypeId = $request->getParameter('rankingTypeId');
		$gameTypeId    = $request->getParameter('gameTypeId');
		$gameStyleId   = $request->getParameter('gameStyleId');
		$startDate     = $request->getParameter('startDate');
		$finishDate    = $request->getParameter('finishDate');
		$isPrivate     = $request->getParameter('isPrivate');
		$defaultBuyin  = $request->getParameter('defaultBuyin');
		$scoreFormula  = $request->getParameter('scoreFormula');
		
		$this->setRankingName($rankingName);
		$this->setRankingTypeId($rankingTypeId);
		$this->setGameTypeId($gameTypeId);
		$this->setGameStyleId($gameStyleId);
		$this->setStartDate(Util::formatDate($startDate));
		$this->setFinishDate(($finishDate?Util::formatDate($finishDate):null));
		$this->setIsPrivate(($isPrivate?true:false));
		$this->setDefaultBuyin(Util::formatFloat($defaultBuyin));
		$this->setScoreFormula($scoreFormula);
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( RankingLivePeer::ENABLED, true );
		$criteria->add( RankingLivePeer::VISIBLE, true );
		$criteria->add( RankingLivePeer::DELETED, false );
		
		return RankingLivePeer::doSelect($criteria);
	}
	
	public function toString(){
		
		return $this->getRankingName();
	}
	
	public function cleanRecord(){
		
		$this->setFileNameLogo(null);
	}
	
	public function getFileNameLogo($original=false){
		
		$fileNameLogo = parent::getFileNameLogo();
		
		if( $original ){
			
			$rankingLiveId = $this->getId();
			$fileNameLogo  = preg_replace('/-[0-9]*(\.[^\.]*)$/', '\1', $fileNameLogo);
		}
		
		return $fileNameLogo;
	}
	
	public function getGameStyle(){
		
		return $this->getVirtualTableRelatedByGameStyleId();
	}
	
	public function getGameType(){
		
		return $this->getVirtualTableRelatedByGameTypeId();
	}
	
	public function getRankingType(){
		
		return $this->getVirtualTableRelatedByRankingTypeId();
	}
}
