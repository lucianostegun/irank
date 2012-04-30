<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_live_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLivePlayer extends BaseRankingLivePlayer
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('ranking_live_player', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking_live_player', $this->getPrimaryKey(), $e);
        }
    }
	
	public function updateScore(){
		
		$totalScore = Util::executeOne('SELECT SUM(event_live_player.SCORE) FROM event_live_player, event_live WHERE event_live.ENABLED AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$this->setTotalScore( $totalScore );
	}
	
	public function updateBalance(){
		
		$totalPaid  = Util::executeOne('SELECT SUM(event_live_player.ENTRANCE_FEE+event_live_player.BUYIN+event_live_player.REBUY+event_live_player.ADDON) FROM event_live_player, event_live WHERE event_live.ENABLED AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$totalPrize = Util::executeOne('SELECT SUM(event_live_player.PRIZE) FROM event_live_player, event_live WHERE event_live.ENABLED AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $totalPrize-$totalPaid;
		$this->setTotalPaid(($totalPaid?$totalPaid:0.00));
		$this->setTotalPrize(($totalPrize?$totalPrize:0.00));
		$this->setTotalBalance(($balanceValue?$balanceValue:0.00));
		$this->setTotalAverage(($totalPaid?($totalPrize/$totalPaid):0));
	}
	
	public function updateEvents(){
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_live_player, event_live WHERE event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live_player.ENABLED=TRUE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'int');
		$this->setTotalEvents($events);
	}
	
	public function updateInfo(){

		$this->updateBalance();
		$this->updateEvents();
		$this->updateScore();
		$this->save(); 
	}
	
	public function getLastHistory($rankingDate){
		
		// Pega o último histórico de ranking
		$criteria = new Criteria();
		$criteria->add( RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->getRankingLiveId() );
		$criteria->add( RankingLiveHistoryPeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->add( RankingLiveHistoryPeer::RANKING_DATE, $rankingDate, Criteria::LESS_THAN );
		$criteria->addDescendingOrderByColumn( RankingLiveHistoryPeer::RANKING_DATE );
		$rankingLiveHistoryObj = RankingLiveHistoryPeer::doSelectOne($criteria);
		
		if( !is_object($rankingLiveHistoryObj) ){
			
			$rankingLiveHistoryObj = new RankingLiveHistory();
			$rankingLiveHistoryObj->setRankingLiveId($this->getRankingLiveId());
			$rankingLiveHistoryObj->setPeopleId($this->getPeopleId());
		}
		
		return $rankingLiveHistoryObj;
	}
	
	public function setTotalAverage($totalAverage){
		
		parent::setTotalAverage( Util::formatFloat($totalAverage, false, 3) );
	}
	
	
	/* Métodos de compatibilidade de resultado Evento x Ranking */
	public function getPrize(){
		
		return $this->getTotalPrize();
	}

	public function getScore(){
		
		return $this->getTotalScore();
	}

	public function getEvents(){
		
		return $this->getTotalEvents();
	}
	/* FIM dos métodos de compatibilidade de resultado Evento x Ranking */
}
