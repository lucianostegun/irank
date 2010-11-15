<?php

/**
 * Subclasse de representação de objetos da tabela 'people'.
 *
 * 
 *
 * @package lib.model
 */ 
class People extends BasePeople
{
	
	public function toString(){
		
		return $this->getName();
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isColumnModified( PeoplePeer::VISIBLE );
//			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
//        	Log::quickLog('people', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
   
        } catch ( Exception $e ) {
        	
//            Log::quickLogError('people', $this->getPrimaryKey(), $e);
        }
    }
    
	public function delete($con = null){

		$this->setDeleted( true );
		$this->setVisible( false );
		$this->setActive( false );
		$this->save();
		
//		Log::quickLogDelete('people', $this->getPrimaryKey());
	}
	
	public function cleanRecord(){
		
	}
	
	public function getName(){
		
		$firstName = $this->getFirstName();
		$lastName  = $this->getLastName();
		
		return $firstName.($lastName?' '.$lastName:'');
	}
	
	public static function getQuickPeople($firstName, $lastName=null, $peopleType, $peopleId=null){

		$peopleTypeId = VirtualTable::getIdByTagName('peopleType', $peopleType);

		if( $peopleId )
			$peopleObj = PeoplePeer::retrieveByPK($peopleId);
		else
			$peopleObj = new People();

		$peopleObj->setPeopleTypeId($peopleTypeId);
		$peopleObj->setFirstName($firstName);
		$peopleObj->setLastName($lastName);
		$peopleObj->setFullName($firstName.($lastName?' '.$lastName:''));
		$peopleObj->setEnabled(true);
		$peopleObj->setVisible(true);
		$peopleObj->save();
		
		return $peopleObj;
	}
	
	public function quickSave($request){
		
	  	$firstName = $request->getParameter('firstName');
	  	$lastName  = $request->getParameter('lastName');
	  	$birthday  = $request->getParameter('birthday');
	
	  	$this->setFirstName( $firstName );
	  	$this->setLastName( $lastName );
	  	$this->setBirthday( Util::formatDate($birthday) );
	  	$this->setEnabled(true);
	  	$this->setVisible(true);
	  	$this->save();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( PeoplePeer::ENABLED, true );
		$criteria->add( PeoplePeer::VISIBLE, true );
		$criteria->add( PeoplePeer::DELETED, false );
		
		return PeoplePeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false ){
		
		$peopleObjList = self::getList();
		
		$optionList = array();
		$optionList[''] = 'Selecione';
		foreach( $peopleObjList as $peopleObj )			
			$optionList[$peopleObj->getId()] = $peopleObj->getFirstName();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function isPeopleType($tagName){
		
		return $this->getVirtualTable()->getTagName()==$tagName;
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']         = $this->getId();
		$infoList['firstName']  = $this->getFirstName();
		$infoList['lastName']   = $this->getLastName();
		$infoList['birthday']   = $this->getBirthday('d/m/Y');
		$infoList['enabled']    = $this->getEnabled();
		$infoList['visible']    = $this->getVisible();
		$infoList['deleted']    = $this->getDeleted();
		$infoList['locked']     = $this->getLocked();
		$infoList['createdAt']  = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']  = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
