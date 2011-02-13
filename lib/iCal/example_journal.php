<?php

include_once('./library/Icalendar/Journal.php');

$ical = new Icalendar_Journal();

$ical->setProdid('ITSoft | www.itsoft.com.pt');
$ical->setCalName('ITSoft');
$ical->setCalDesc('Sistema ITSoft');

$dtstart = $ical->getDtstart();

$journal = array();
$journal['DTSTAMP']     = $dtstart;
$journal['ORGANIZER']   = 'ITSoft - tbrito78@hotmail.com';
$journal['UID']         = '129';
$journal['CATEGORY']    = 'iCalendar';
$journal['DESCRIPTION'] = 'The best Class Calendar ever seen before!';
$journal['CLASS']       = '';

$ical->setJournal($journal);

$ical->render();
$ical->display();
// $ical->save();

?>