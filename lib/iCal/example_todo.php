<?php

include_once('./library/Icalendar/Todo.php');

$ical = new Icalendar_Todo();

$ical->setProdid('ITSoft | www.itsoft.com.pt');
$ical->setCalName('ITSoft');
$ical->setCalDesc('Sistema ITSoft');

$dtstart = $ical->getDtstart();

$todo = array();
$todo['SEQUENCE']  = '0';
$todo['UID']       = '14';
$todo['DTSTAMP']   = $ical->dateBuilder(date('Ymd'), date('Hmi'));
$todo['ORGANIZER'] = 'Thiago Brito - tbrito78@hotmail.com';
$todo['ATTENDEE']  = '';
$todo['DUE']       = 'DUE';
$todo['STATUS']    = 'CONFIRMED';
$todo['SUMMARY']   = 'TODO - ITSoft';

$alarm = array();
$alarm['ACTION']   = 'action';
$alarm['TRIGGER']  = 'trigger';
$alarm['REPEAT']   = 'NO';
$alarm['DURATION'] = '1h';

$todo['VALARM']    = $alarm;

$ical->setTodo($todo);

$ical->render();
$ical->display();
// $ical->save();

?>