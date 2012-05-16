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
	public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('poll', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('poll', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();		
	}
	
	public function quickSave($request){
		
		$question = $request->getParameter('question');
		
		$this->setQuestion( $question );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( PollPeer::ENABLED, true );
		$criteria->add( PollPeer::VISIBLE, true );
		$criteria->add( PollPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( PollPeer::CREATED_AT );
		
		return PollPeer::doSelect( $criteria );
	}
}
