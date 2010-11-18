<?php

class eventActions extends sfActions
{

  public function executeReminder($request){

	$this->getUser()->setAttribute('cron', true);
	
	$days = $request->getParameter('days', 7);
	$createdAt = date('Y-m-d', mktime(0,0,0,date('m'), date('d')-2, date('Y')));
	$eventDate = date('Y-m-d', mktime(0,0,0,date('m'), date('d')+$days, date('Y')));

	$criteria = new Criteria();
	$criteria->setNoFilter(true);
	$criteria->add( EventPeer::ENABLED, true );
	$criteria->add( EventPeer::VISIBLE, true );
	$criteria->add( EventPeer::DELETED, false );
	$criteria->add( EventPeer::EVENT_DATE, $eventDate );
//	$criteria->add( EventPeer::CREATED_AT, $createdAt, Criteria::LESS_EQUAL );
	$eventObjList = EventPeer::doSelect($criteria);
	
	foreach($eventObjList as $eventObj)
		$eventObj->notifyReminder($days);
	
	$this->getUser()->getAttributeHolder()->remove('cron');
	
	echo 'Notificações enviadas com sucesso para '.count($eventObjList).' evento(s)';
	exit;
  }
}
