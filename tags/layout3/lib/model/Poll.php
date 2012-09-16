<?php

/**
 * Subclasse de representação de objetos da tabela 'poll'.
 *
 * 
 *
 * @package lib.model
 */ 
class Poll extends BasePoll
{
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();		
	}
	
	public function quickSave($request){
		
		$question   = $request->getParameter('question');
		$answerList = $request->getParameter('answer');
		
		$this->setQuestion( $question );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save();
		
		Util::executeQuery( 'DELETE FROM poll_answer WHERE poll_id='.$this->getId() );
		
		foreach( $answerList as $answer ){
			
			$pollAnswerObj = new PollAnswer();
			$pollAnswerObj->setPollId($this->getId());
			$pollAnswerObj->setAnswer($answer);
			$pollAnswerObj->save();
		}
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( PollPeer::ENABLED, true );
		$criteria->add( PollPeer::VISIBLE, true );
		$criteria->add( PollPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( PollPeer::CREATED_AT );
		
		return PollPeer::doSelect( $criteria );
	}
	
	public function getTotalAnswers(){
		
		return Util::executeOne('SELECT SUM(user_response) FROM poll_answer WHERE poll_id='.$this->getId().' AND user_response IS NOT NULL');
	}
}
