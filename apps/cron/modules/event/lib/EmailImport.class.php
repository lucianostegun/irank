<?php

class EmailImport
{
	
	private $connection;
	private $server;
	private $username;
	private $password;
	private $defaultFolder;
	private $protocol;
	private $port;
	private $imapParameters;
		
	public function __construct( $protocol, $autoConnect=true ){
		
		$protocol = strtolower($protocol);
		switch( $protocol ){
			case 'imap':
				$this->setProtocol('imap');
				$this->setPort(143);
				break;
			case 'pop':
			case 'pop3':
				$this->setProtocol('pop3');
				$this->setPort(110);
				break;
			default:
				throw Exception('Protocolo de conexão desconhecido');
		}
		
		if( $autoConnect )
			$this->connect();
	}
	
	public function connect(){
	
		switch( $this->getProtocol() ){
			case 'imap':
				$this->getImapConnection();
				break;
			case 'pop3':
				$this->getPop3Connection();
				break;
		}
	}
	
	public function getImapConnection(){
	
		$server = '{'.$this->getServer().':'.$this->getPort().$this->getImapParameters().'}'.$this->getDefaultFolder();
		$this->connection = imap_open($server, $this->getUsername(), $this->getPassword());
	}
	
	public function getPopConnection(){
	
		$server = '{'.$this->getServer().':'.$this->getPort().$this->getImapParameters().'}'.$this->getDefaultFolder();
		$this->connection = imap_open($server, $this->getUsername(), $this->getPassword());
	}
	
	public function close(){
		
		imap_close($this->getConnection());
	}
	
	
	public function getConnection(){
		
		return $this->connection;
	}
	
	
	public function setServer( $server ){
	
		$this->server = $server;
	}
	
	public function setUsername( $username ){
	
		$this->username = $username;
	}
	
	public function setPassword( $password ){
	
		$this->password = $password;
	}
	
	public function setDefaultFolder( $defaultFolder ){
	
		$this->defaultFolder = $defaultFolder;
	}
	
	public function setProtocol( $protocol ){
	
		$this->protocol = $protocol;
	}
	
	public function setPort( $port ){
	
		$this->port = $port;
	}
	
	public function setImapParameters( $imapParameters ){
	
		$this->imapParameters = $imapParameters;
	}
	
	
	
	
	
	private function getServer(){
	
		return $this->server;
	}
	
	private function getUsername(){
	
		return $this->username;
	}
	
	private function getPassword(){
	
		return $this->password;
	}
	
	private function getDefaultFolder(){
	
		return $this->defaultFolder;
	}
	
	private function getProtocol(){
	
		return $this->protocol;
	}
	
	private function getPort(){
	
		return $this->port;
	}
	
	private function getImapParameters(){
	
		return $this->imapParameters;
	}
	
	
	
	public function getMailBoxes(){
		
		$mailBoxList = imap_listmailbox($this->getConnection(), '{'.$this->getServer().':'.$this->getPort().'}', '*');
		
		if($mailBoxList==false)		    
		    throw Exception('Não foi possível recuperar as informações as pastas do servidor!');
		else
			return $mailBoxList;
	}
	public function getMessageCount(){
	
		switch( $this->getProtocol() ){
			case 'imap':
				return imap_num_msg($this->getConnection());
				break;
			case 'pop3':
				return popimap_num_msg($this->getConnection())
				break;
		}
	}
	
	public function getHeader( $index ){
		
		return imap_header($this->getConnection(), $index);
	}
	
	public function getNewMessages(){

		$messageList = array();
		for($i=1; $i <= $this->getMessageCount(); $i++){
			
	  		$messageHeader = $this->getHeader($i);

	        switch ( $this->getProtocol() ) {
				case 'imap':
					$genericMessageObj = new ImapMessage( $i, $this->getConnection(), $messageHeader );
					break;
			}
			
			$messageList[] = $genericMessageObj;
		}
		
		return array_reverse($messageList);
	}
}

class ImapMessage {
	
	private $id;
	private $index;
	private $messageNumber;
	private $subject;
	private $senderName;
	private $senderAddress;
	private $date;
	private $body;
	private $connection;
	private $deleted = false;
	
	public function __construct( $index, $connection, $messageHeader ){
		
		$this->connection = $connection;
		
		$messageId     = $messageHeader->message_id;
        $subject       = $messageHeader->subject;
        $from          = $messageHeader->from;
        $senderName    = (isset($from[0]->personal)?$from[0]->personal:'Não especificado');
        $senderAddress = $from[0]->mailbox.'@'.$from[0]->host;
        $date          = $messageHeader->date;
        
        $body = imap_fetchbody($connection, $index, 1);
        
        
        $this->setIndex( $index );
		$this->setSubject( $subject );
		$this->setSenderName( $senderName );
		$this->setSenderAddress( $senderAddress );
		$this->setDate( $date );
		$this->setBody( $body );
	}
	
	public function move( $newFolder ){
		
		imap_mail_move( $this->connection, $this->getIndex(), $newFolder); 
	}
	
	public function delete(){

		imap_delete( $this->connection, $this->getMessageNumber());
		$this->setDeleted( true );
	}
	
	public function setIndex( $index ){
	
		$this->index = $index;
		$this->setId( $index );
	}
	
	public function setId( $index ){
	
		$this->id = imap_uid( $this->connection, $index );
		$this->messageNumber = imap_msgno( $this->connection, $this->id );
	}
	
	public function setSubject( $subject ){
	
		$subject = imap_mime_header_decode($subject);
		$this->subject = $subject[0]->text;
	}
	
	public function setSenderName( $senderName ){
	
		$this->senderName = $senderName;
	}
	
	public function setSenderAddress( $senderAddress ){
	
		$this->senderAddress = $senderAddress;
	}
	
	public function setDate( $date ){
		
        $date = strtotime($date);        
		$this->date = $date;
	}
	
	public function setBody( $body ){

        $body = quoted_printable_decode($body);
        $body = str_ireplace('enviado de meu iphone', '', $body);
        $body = trim($body);
        $body = rtrim($body, '<br/>');
		$body = imap_mime_header_decode($body);
		$body = $body[0]->text;
        
		$this->body = $body;
	}
	
	private function setDeleted( $deleted ){
		
		$this->deleted = $deleted;
	}
	
	
	
	public function getId(){
	
		return $this->id;
	}
	
	public function getIndex(){
	
		return $this->index;
	}
	
	public function getMessageNumber(){
	
		return $this->messageNumber;
	}
	
	public function getSubject(){
	
		return $this->subject;
	}
	
	public function getSenderName(){
	
		return $this->senderName;
	}
	
	public function getSenderAddress(){
	
		return $this->senderAddress;
	}
	
	public function getDate( $format=null ){
	
		$date = $this->date;
		if( $format )
        	$date = date($format, $date);

		return $date;
	}
	
	public function getBody(){
	
		return $this->body;
	}
	
	private function isDeleted(){
		
		return $this->deleted;
	}
}