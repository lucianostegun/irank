<?php


abstract class BaseUserSiteConfig extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_site_id;


	
	protected $bankroll_tutorial_home = 0;


	
	protected $sms_validation_code;


	
	protected $sms_validation_attempts = 0;


	
	protected $agreed_sms_terms = false;

	
	protected $aUserSite;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserSiteId()
	{

		return $this->user_site_id;
	}

	
	public function getBankrollTutorialHome()
	{

		return $this->bankroll_tutorial_home;
	}

	
	public function getSmsValidationCode()
	{

		return $this->sms_validation_code;
	}

	
	public function getSmsValidationAttempts()
	{

		return $this->sms_validation_attempts;
	}

	
	public function getAgreedSmsTerms()
	{

		return $this->agreed_sms_terms;
	}

	
	public function setUserSiteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = UserSiteConfigPeer::USER_SITE_ID;
		}

		if ($this->aUserSite !== null && $this->aUserSite->getId() !== $v) {
			$this->aUserSite = null;
		}

	} 
	
	public function setBankrollTutorialHome($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bankroll_tutorial_home !== $v || $v === 0) {
			$this->bankroll_tutorial_home = $v;
			$this->modifiedColumns[] = UserSiteConfigPeer::BANKROLL_TUTORIAL_HOME;
		}

	} 
	
	public function setSmsValidationCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sms_validation_code !== $v) {
			$this->sms_validation_code = $v;
			$this->modifiedColumns[] = UserSiteConfigPeer::SMS_VALIDATION_CODE;
		}

	} 
	
	public function setSmsValidationAttempts($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sms_validation_attempts !== $v || $v === 0) {
			$this->sms_validation_attempts = $v;
			$this->modifiedColumns[] = UserSiteConfigPeer::SMS_VALIDATION_ATTEMPTS;
		}

	} 
	
	public function setAgreedSmsTerms($v)
	{

		if ($this->agreed_sms_terms !== $v || $v === false) {
			$this->agreed_sms_terms = $v;
			$this->modifiedColumns[] = UserSiteConfigPeer::AGREED_SMS_TERMS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_site_id = $rs->getInt($startcol + 0);

			$this->bankroll_tutorial_home = $rs->getInt($startcol + 1);

			$this->sms_validation_code = $rs->getString($startcol + 2);

			$this->sms_validation_attempts = $rs->getInt($startcol + 3);

			$this->agreed_sms_terms = $rs->getBoolean($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UserSiteConfig object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserSiteConfigPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserSiteConfigPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(UserSiteConfigPeer::DATABASE_NAME);

		$tableName = UserSiteConfigPeer::TABLE_NAME;
		
		try{
			
			if( !preg_match('/log$/', $tableName) )
				$columnModifiedList = Log::getModifiedColumnList($this);
			
			$isNew = $this->isNew();
			
			$con->begin();
			$affectedRows = $this->doSave($con);
			
			if( !preg_match('/log$/', $tableName) ){
			
				if( method_exists($this, 'getDeleted') && $this->getDeleted() )
	        		Log::quickLogDelete($tableName, $this->getPrimaryKey(), get_class($this));
	        	else
	        		Log::quickLog($tableName, $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
		   }
	   
			$con->commit();
			
			return $affectedRows;
		}catch(PropelException $e) {
			
			$con->rollback();
			if( !preg_match('/log$/', $tableName) )
				Log::quickLogError($tableName, $this->getPrimaryKey(), $e);
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aUserSite !== null) {
				if ($this->aUserSite->isModified()) {
					$affectedRows += $this->aUserSite->save($con);
				}
				$this->setUserSite($this->aUserSite);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserSiteConfigPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UserSiteConfigPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aUserSite !== null) {
				if (!$this->aUserSite->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSite->getValidationFailures());
				}
			}


			if (($retval = UserSiteConfigPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserSiteConfigPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserSiteId();
				break;
			case 1:
				return $this->getBankrollTutorialHome();
				break;
			case 2:
				return $this->getSmsValidationCode();
				break;
			case 3:
				return $this->getSmsValidationAttempts();
				break;
			case 4:
				return $this->getAgreedSmsTerms();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserSiteConfigPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getUserSiteId(),
			$keys[1]=>$this->getBankrollTutorialHome(),
			$keys[2]=>$this->getSmsValidationCode(),
			$keys[3]=>$this->getSmsValidationAttempts(),
			$keys[4]=>$this->getAgreedSmsTerms(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserSiteConfigPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserSiteId($value);
				break;
			case 1:
				$this->setBankrollTutorialHome($value);
				break;
			case 2:
				$this->setSmsValidationCode($value);
				break;
			case 3:
				$this->setSmsValidationAttempts($value);
				break;
			case 4:
				$this->setAgreedSmsTerms($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserSiteConfigPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserSiteId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBankrollTutorialHome($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSmsValidationCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSmsValidationAttempts($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAgreedSmsTerms($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserSiteConfigPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserSiteConfigPeer::USER_SITE_ID)) $criteria->add(UserSiteConfigPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(UserSiteConfigPeer::BANKROLL_TUTORIAL_HOME)) $criteria->add(UserSiteConfigPeer::BANKROLL_TUTORIAL_HOME, $this->bankroll_tutorial_home);
		if ($this->isColumnModified(UserSiteConfigPeer::SMS_VALIDATION_CODE)) $criteria->add(UserSiteConfigPeer::SMS_VALIDATION_CODE, $this->sms_validation_code);
		if ($this->isColumnModified(UserSiteConfigPeer::SMS_VALIDATION_ATTEMPTS)) $criteria->add(UserSiteConfigPeer::SMS_VALIDATION_ATTEMPTS, $this->sms_validation_attempts);
		if ($this->isColumnModified(UserSiteConfigPeer::AGREED_SMS_TERMS)) $criteria->add(UserSiteConfigPeer::AGREED_SMS_TERMS, $this->agreed_sms_terms);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserSiteConfigPeer::DATABASE_NAME);

		$criteria->add(UserSiteConfigPeer::USER_SITE_ID, $this->user_site_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUserSiteId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUserSiteId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setBankrollTutorialHome($this->bankroll_tutorial_home);

		$copyObj->setSmsValidationCode($this->sms_validation_code);

		$copyObj->setSmsValidationAttempts($this->sms_validation_attempts);

		$copyObj->setAgreedSmsTerms($this->agreed_sms_terms);


		$copyObj->setNew(true);

		$copyObj->setUserSiteId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserSiteConfigPeer();
		}
		return self::$peer;
	}

	
	public function setUserSite($v)
	{


		if ($v === null) {
			$this->setUserSiteId(NULL);
		} else {
			$this->setUserSiteId($v->getId());
		}


		$this->aUserSite = $v;
	}


	
	public function getUserSite($con = null)
	{
		if ($this->aUserSite === null && ($this->user_site_id !== null)) {
						include_once 'lib/model/om/BaseUserSitePeer.php';

			$this->aUserSite = UserSitePeer::retrieveByPK($this->user_site_id, $con);

			
		}
		return $this->aUserSite;
	}

} 