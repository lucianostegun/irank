<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//+----------------------------------------------------------------------+
//| WAMP (XP-SP1/1.3.24/4.0.12/4.3.0)                                    |
//+----------------------------------------------------------------------+
//| Copyright (c) 1992-2003 Michael Wimmer                               |
//+----------------------------------------------------------------------+
//| I don't have the time to read through all the licences to find out   |
//| what the exactly say. But it's simple. It's free for non commercial  |
//| projects, but as soon as you make money with it, i want my share :-) |
//+----------------------------------------------------------------------+
//| Authors: Michael Wimmer <flaimo@gmx.net>                             |
//+----------------------------------------------------------------------+
//
// $Id$

//error_reporting(E_ALL);
$days = (array) array (2,3);
$organizer = (array) array('Luciano Stegun', 'lucianostegun@gmail.com');
$categories = array('Game');
$attendees = (array) array(
						  'Luciano Stegun' => 'lucianostegun@gmail.com,1',
						  'João Marcelo' => 'luciano@stegun.com,2',
						  'Ivana Peria' => 'ivanaperia@gmail.com,3'
						  );  // Name => e-mail,role (see iCalEvent class)

$fb_times = (array) array(
						  time()+23456 => time()+24456 . ',0', // timestamp start => 'timestamp end,status' (for status see class)
						  time()+93956 => time()+95956 . ',1'
						  );

$alarm = (array) array(
					  0, // Action: 0 = DISPLAY, 1 = EMAIL, (not supported: 2 = AUDIO, 3 = PROCEDURE)
					  150,  // Trigger: alarm before the event in minutes
					  'iRank Poker!', // Title
					  'Não se esqueça do jogo agendado', // Description
					  $attendees, // Array (key = attendee name, value = e-mail, second value = role of the attendee [0 = CHAIR | 1 = REQ | 2 = OPT | 3 =NON])
					  5, // Duration between the alarms in minutes
					  3  // How often should the alarm be repeated
					  );

$ex_dates = (array) array(12345667,78643453);

$iCal = (object) new iCal('', 0, ''); // (ProgrammID, Method (1 = Publish | 0 = Request), Download Directory)

$iCal->addEvent(
				$organizer, // Organizer
				1048806000, // Start Time (timestamp; for an allday event the startdate has to start at YYYY-mm-dd 00:00:00)
				1048899000, // End Time (write 'allday' for an allday event instead of a timestamp)
				'Stegun\'s Poker House', // Location
				1, // Transparancy (0 = OPAQUE | 1 = TRANSPARENT)
				$categories, // Array with Strings
				'Poker night na casa do Luciano', // Description
				'Sit & Go NLHE', // Title
				1, // Class (0 = PRIVATE | 1 = PUBLIC | 2 = CONFIDENTIAL)
				$attendees, // Array (key = attendee name, value = e-mail, second value = role of the attendee [0 = CHAIR | 1 = REQ | 2 = OPT | 3 =NON])
				5, // Priority = 0-9
				5, // frequency: 0 = once, secoundly - yearly = 1-7
				10, // recurrency end: ('' = forever | integer = number of times | timestring = explicit date)
				2, // Interval for frequency (every 2,3,4 weeks...)
				$days, // Array with the number of the days the event accures (example: array(0,1,5) = Sunday, Monday, Friday
				0, // Startday of the Week ( 0 = Sunday - 6 = Saturday)
				'', // exeption dates: Array with timestamps of dates that should not be includes in the recurring event
				$alarm,  // Sets the time in minutes an alarm appears before the event in the programm. no alarm if empty string or 0
				1, // Status of the event (0 = TENTATIVE, 1 = CONFIRMED, 2 = CANCELLED)
				'http://www.irank.com.br/', // optional URL for that event
				'pt', // Language of the Strings
                '' // Optional UID for this event
			   );

//$iCal->addEvent(add more events...);

//echo $iCal->countiCalObjects();
echo '<pre>';
$iCal->outputFile('ics'); // output file as ics (xcs and rdf possible)
?>
