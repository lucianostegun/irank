#!/usr/bin/env php
<?php

$domainId = 5;
$domain   = 'irank.com.br';
$root     = '/var/qmail';
$home     = $root.'/mailnames';
$mailbox  = 'pokerfriends2013';

if( !file_exists($home.'/'.$domain.'/'.$mailbox) ){
	
	mkdir($home.'/'.$domain.'/'.$mailbox);
	mkdir($home.'/'.$domain.'/'.$mailbox.'/@attachments');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/cur');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/new');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/tmp');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/.Spam');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/.Spam/cur');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/.Spam/new');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/Maildir/.Spam/tmp');
	mkdir($home.'/'.$domain.'/'.$mailbox.'/.spamassassin');
}

exec("chmod 700 $home/$domain/$mailbox -R");
exec("chown popuser:popuser $home/$domain/$mailbox -R");

$fp = fopen($home.'/'.$domain.'/'.$mailbox.'/Maildir/maildirsize', 'a');
fwrite($fp, "104853504S,0C\n");
fwrite($fp, "           0           0\n");
fclose($fp);

$emailAddressList = array('lucianostegun@gmail.com', 'luciano@irank.com.br', 'luciano@newai.com.br', 'lucianostegun@hotmail.com');

$fp = fopen($home.'/'.$domain.'/'.$mailbox.'/.qmail', 'a');
fwrite($fp, "| true\n");
foreach($emailAddressList as $emailAddress)
	fwrite($fp, "&$emailAddress\n");
fclose($fp);

$assign = file($root.'/users/assign');
unset($assign[count($assign)-1]);
$assign[] = "={$domainId}-{$mailbox}:popuser:110:31:/var/qmail/mailnames/{$domain}/{$mailbox}:::\n";
$assign = array_unique($assign);
sort($assign);
$assign[] = ".";

$fp = fopen($root.'/users/assign', 'w');
fwrite($fp, implode('', $assign));
fclose($fp);

exec("$root/bin/qmail-newu");
//echo("/etc/init.d/qmail restart\n");
//passthru("/etc/init.d/qmail restart");
echo("finished");
exit;
?>