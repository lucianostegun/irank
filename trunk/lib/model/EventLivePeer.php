<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePeer extends BaseEventLivePeer
{
	
	public static function search($criteria=null){
		
		$request = MyTools::getRequest();
		$clubId  = $request->getParameter('clubId');
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );

		$criterion = $criteria->getNewCriterion( RankingLivePeer::ENABLED, true );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::VISIBLE, true ) );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::DELETED, false ) );
		
		$criterion2 = $criteria->getNewCriterion( EventLivePeer::RANKING_LIVE_ID, NULL );
		$criterion->addOr($criterion2);
		$criteria->add($criterion);
		
		if( $clubId )
			$criteria->add( EventLivePeer::CLUB_ID, $clubId );
		
		$criteria->addJoin( EventLivePeer::CLUB_ID, ClubPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID, Criteria::LEFT_JOIN );
		
		$criteria->addAscendingOrderByColumn( EventLivePeer::ENROLLMENT_START_DATE );
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLivePeer::START_TIME );
		
		return EventLivePeer::doSelect($criteria);
	}
	
	public static function validateChips($stackChips){
		
		return preg_match('/^[0-9]*[,\.]?[0-9]*[kK]?$/', $stackChips);
	}
	
	public static function validateEventDate($eventDate, $rankingLiveId=null){
		
		$rankingLiveId = MyTools::getRequestParameter('rankingLiveId', $rankingLiveId);

		$criteria = new Criteria();
		$criteria->add( EventLivePeer::RANKING_LIVE_ID, $rankingLiveId );
		$criteria->add( EventLivePeer::EVENT_DATE, Util::formatDate($eventDate), Criteria::GREATER_THAN );
		$criteria->add( EventLivePeer::SAVED_RESULT, true );
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$eventLiveCount = EventLivePeer::doCount($criteria);

		return ($eventLiveCount==0);
	}
	
	public static function validateStepDays($isMultiday){
		
		$request             = MyTools::getRequest();
		$stepDayCurrentIndex = $request->getParameter('stepDayCurrentIndex');
		
		$stepEventDateList = $request->getParameter('stepEventDate');
		$stepStartTimeList = $request->getParameter('stepStartTime');
		$stepDayList       = $request->getParameter('stepDay');
		
		// INICIO - Verifica se não possu duas linhas iguais
		$checkList = array();
		foreach($stepEventDateList as $key=>$stepEventDate)
			$checkList[] = $stepEventDate.'-'.$stepStartTimeList[$key];
		
		$checkList = array_unique($checkList);
		if( count($checkList) < count($stepEventDateList) )
			MyTools::setError('stepEventDate', 'Não é possível cadastrar duas datas com o mesmo horário');
		// FIM
		
		// INICIO - Verifica se a data mais curta ainda pode ser utilizada para eventos
		$eventDateList = array();
		foreach($stepEventDateList as $key=>$stepEventDate)
			$eventDateList[] = Util::formatDate($stepEventDate);
		$minEventDate = min($eventDateList);
		
		if( !self::validateEventDate(Util::formatDate($minEventDate, 'screen')) )
			MyTools::setError('stepEventDate', 'form.error.expiredDate');
		// FIM
		 
		foreach($stepEventDateList as $stepEventDate){
			
			if( !Validate::validateDate($stepEventDate) ){
				
				MyTools::setError('stepEventDate', 'Informe corretamente todas as datas das etapas');
				break;
			}

			if( empty($stepEventDate) ){
				
				MyTools::setError('stepEventDate', 'Informe todas as datas das etapas');
				break;
			}
		}

		foreach($stepDayList as $stepDay){
			
			if( !$stepDay ){
				
				MyTools::setError('stepDay', 'Informe a indicação do dia de cada etapa');
				break;
			}
		}

		return !$request->hasErrors();
	}
}
