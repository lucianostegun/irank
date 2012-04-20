<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_live_history'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLiveHistory extends BaseRankingLiveHistory
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('ranking_live_history', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking_live_history', $this->getPrimaryKey(), $e);
        }
    }
	
	public function updateScore(){
		
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$score = Util::executeOne('SELECT SUM(event_live_player.SCORE) FROM event_live_player, event_live WHERE event_live.EVENT_DATE = \''.$rankingDate.'\' AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'float');

		$score = ($score?$score:0);

		$this->setTotalScore($this->getTotalScore()+$score);
		$this->setScore($score);
	}
	
	public function updateBalance(){
			
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$paidValue  = Util::executeOne('SELECT SUM(event_live_player.ENTRANCE_FEE+event_live_player.BUYIN+event_live_player.REBUY+event_live_player.ADDON) FROM event_live_player, event_live WHERE event_live.EVENT_DATE = \''.$rankingDate.'\' AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		$prizeValue = Util::executeOne('SELECT SUM(event_live_player.PRIZE) FROM event_live_player, event_live WHERE event_live.EVENT_DATE = \''.$rankingDate.'\' AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'float');
		
		$balanceValue = $prizeValue-$paidValue;
		
		$this->setTotalPaid( $this->getTotalPaid()+$paidValue );
		$this->setTotalPrize( $this->getTotalPrize()+$prizeValue );
		$this->setTotalBalance( $this->getTotalBalance()+$balanceValue );
		
		$this->setTotalAverage( ($this->getTotalPaid()>0?($this->getTotalPrize()/$this->getTotalPaid()):0) );
		
		$this->setPaidValue( ($paidValue?$paidValue:0) );
		$this->setPrizeValue( ($prizeValue?$prizeValue:0) );
		$this->setBalanceValue( ($balanceValue?$balanceValue:0) );
		$this->setAverage( ($this->getPaidValue()>0?($this->getPrizeValue()/$this->getPaidValue()):0) );
	}
	
	public function updateEvents(){
		
		$rankingDate = $this->getRankingDate('Y-m-d');
		
		$events = Util::executeOne('SELECT COUNT(1) FROM event_live_player, event_live WHERE event_live.EVENT_DATE = \''.$rankingDate.'\' AND event_live.VISIBLE AND event_live.ENABLED AND NOT event_live.DELETED AND event_live_player.ENABLED AND event_live.SAVED_RESULT AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID='.$this->getRankingLiveId().' AND event_live_player.PEOPLE_ID='.$this->getPeopleId(), 'int');
		
		$this->setEvents($events);
		$this->setTotalEvents($this->getTotalEvents()+$events);
	}
	
	public function updateInfo(){

		$this->updateBalance();
		$this->updateEvents();
		$this->updateScore();
	}
	
	// Função que atualiza todos as datas do ranking
	// Não deve ser utilizada se a consistencia dos eventos do ranking estiverem certa
	public static function saveResults($rankingLiveObj){
		
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLivePeer::START_TIME );
		
		$eventLiveObjList         = $rankingLiveObj->getEventList($criteria);
		$rankingLivePlayerObjList = $rankingLiveObj->getPlayerList();

		$eventDateList = array();
		foreach($eventLiveObjList as $eventLiveObj)
			$eventDateList[] = Util::formatDate($eventLiveObj->getEventDate('d/m/Y'));
		
		$eventDateList = array_unique($eventDateList);
		$firstDate     = Util::formatDate($eventDateList[0]);

		foreach( $eventDateList as $eventDate){
			
			foreach($rankingLivePlayerObjList as $rankingLivePlayerObj){
				
				$rankingLiveHistoryObj = new RankingLiveHistory();
				$rankingLiveHistoryObj->setPeopleId( $rankingLivePlayerObj->getPeopleId() );
				$rankingLiveHistoryObj->setRankingLiveId( $rankingLivePlayerObj->getRankingLiveId() );
				$rankingLiveHistoryObj->setRankingDate( $eventDate );
				$rankingLiveHistoryObj->updateInfo($firstDate, $eventDate);
				$rankingLiveHistoryObj->save();
			}
		}
	}
	
	// Sobrescreve os métodos para formatar os valores com duas casas decimais
	public function setAverage($average){
		
		parent::setAverage( Util::formatFloat($average, false, 3) );
	}
	
	public function setTotalAverage($totalAverage){
		
		parent::setTotalAverage( Util::formatFloat($totalAverage, false, 3) );
	}
}
