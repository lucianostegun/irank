<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingPlayer extends BaseRankingPlayer
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('ranking_player', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking_player', $this->getPrimaryKey(), $e);
        }
    }
	
	public function updateScore(){
		
		$totalScore = Util::executeOne('SELECT SUM(event_player.SCORE) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$this->setTotalScore( $totalScore );
	}
	
	public function updateBalance(){
		
		$totalPaid  = Util::executeOne('SELECT SUM(event_player.BUYIN+event_player.REBUY+event_player.ADDON) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$totalPrize = Util::executeOne('SELECT SUM(event_player.PRIZE) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $totalPrize-$totalPaid;
		$this->setTotalPaid(($totalPaid?$totalPaid:0.00));
		$this->setTotalPrize(($totalPrize?$totalPrize:0.00));
		$this->setTotalBalance(($balanceValue?$balanceValue:0.00));
		$this->setTotalAverage(($totalPaid?($totalPrize/$totalPaid):0));
	}
	
	public function updateEvents(){
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event_player.ENABLED=TRUE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID='.$this->getRankingId().' AND event_player.PEOPLE_ID='.$this->getPeopleId(), 'int');
		$this->setTotalEvents($events);
	}
	
	public function updateInfo(){

		$this->updateBalance();
		$this->updateEvents();
		$this->updateScore();
		$this->save(); 
	}
	
	public function getLastHistory($eventDate){
		
		// Pega o último histórico de ranking
		$criteria = new Criteria();
		$criteria->add( RankingHistoryPeer::RANKING_ID, $this->getRankingId() );
		$criteria->add( RankingHistoryPeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->add( RankingHistoryPeer::RANKING_DATE, $eventDate, Criteria::LESS_THAN );
		$criteria->addDescendingOrderByColumn( RankingHistoryPeer::RANKING_DATE );
		$rankingHistoryObj = RankingHistoryPeer::doSelectOne($criteria);
		
		if( !is_object($rankingHistoryObj) ){
			
			$rankingHistoryObj = new RankingHistory();
			$rankingHistoryObj->setRankingId($this->getRankingId());
			$rankingHistoryObj->setPeopleId($this->getPeopleId());
		}
		
		return $rankingHistoryObj;
	}
	
	public function setTotalAverage($totalAverage){
		
		parent::setTotalAverage( Util::formatFloat($totalAverage, false, 3) );
	}
}
