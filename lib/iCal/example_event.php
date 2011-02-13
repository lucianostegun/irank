<?php

include_once('./library/Icalendar/Event.php');

$ical = new Icalendar_Event();

$ical->setProdid('ITSoft | www.itsoft.com.pt');
$ical->setCalName('ITSoft');
$ical->setCalDesc('Sistema ITSoft');

$dtstart = $ical->getDtstart();

$event = array();
$event['DTSTAMP']       = $dtstart;
$event['ORGANIZER']     = 'ITSoft - tbrito78@hotmail.com';
$event['DATESTART']     = date('Ymd');
$event['HOURSTART']     = date('Hmi');
$event['DATEEND']       = date('Ymd');
$event['HOUREND']       = date('Hmi');
$event['UID']           = '128';
$event['CREATED']       = $ical->dateBuilder(date('Ymd'), date('Hmi'));
$event['SUMMARY']       = 'Easy iCalendar';
$event['DESCRIPTION']   = 'The best Class Calendar ever seen before!';
$event['LAST-MODIFIED'] = $ical->dateBuilder(date('Ymd'), date('Hmi'));
$event['LOCATION']      = 'Lisbon';
$event['SEQUENCE']      = 1;
$event['TRANSP']        = 'OPAQUE';
$event['STATUS']        = 'CONFIRMED';

$ical->setEvent($event);

$ical->render();
$ical->display();
// $ical->save();

?>