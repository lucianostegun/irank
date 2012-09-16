<?php


abstract class BaseFaqI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $faq_id;


	
	protected $culture;


	
	protected $question_i18n;


	
	protected $answer_i18n;

	
	protected $aFaq;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getFaqId()
	{

		return $this->faq_id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function getQuestionI18n()
	{

		return $this->question_i18n;
	}

	
	public function getAnswerI18n()
	{

		return $this->answer_i18n;
	}

	
	public function setFaqId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->faq_id !== $v) {
			$this->faq_id = $v;
			$this->modifiedColumns[] = FaqI18nPeer::FAQ_ID;
		}

		if ($this->aFaq !== null && $this->aFaq->getId() !== $v) {
			$this->aFaq = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = FaqI18nPeer::CULTURE;
		}

	} 
	
	public function setQuestionI18n($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->question_i18n !== $v) {
			$this->question_i18n = $v;
			$this->modifiedColumns[] = FaqI18nPeer::QUESTION_I18N;
		}

	} 
	
	public function setAnswerI18n($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->answer_i18n !== $v) {
			$this->answer_i18n = $v;
			$this->modifiedColumns[] = FaqI18nPeer::ANSWER_I18N;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->faq_id = $rs->getInt($startcol + 0);

			$this->culture = $rs->getString($startcol + 1);

			$this->question_i18n = $rs->getString($startcol + 2);

			$this->answer_i18n = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FaqI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FaqI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FaqI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FaqI18nPeer::DATABASE_NAME);
		}

		$tableName = FaqI18nPeer::TABLE_NAME;
		
		try {
			
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
		} catch (PropelException $e) {
			
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


												
			if ($this->aFaq !== null) {
				if ($this->aFaq->isModified() || $this->aFaq->getCurrentFaqI18n()->isModified()) {
					$affectedRows += $this->aFaq->save($con);
				}
				$this->setFaq($this->aFaq);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FaqI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FaqI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aFaq !== null) {
				if (!$this->aFaq->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFaq->getValidationFailures());
				}
			}


			if (($retval = FaqI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FaqI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getFaqId();
				break;
			case 1:
				return $this->getCulture();
				break;
			case 2:
				return $this->getQuestionI18n();
				break;
			case 3:
				return $this->getAnswerI18n();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FaqI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getFaqId(),
			$keys[1]=>$this->getCulture(),
			$keys[2]=>$this->getQuestionI18n(),
			$keys[3]=>$this->getAnswerI18n(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FaqI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setFaqId($value);
				break;
			case 1:
				$this->setCulture($value);
				break;
			case 2:
				$this->setQuestionI18n($value);
				break;
			case 3:
				$this->setAnswerI18n($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FaqI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFaqId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setQuestionI18n($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAnswerI18n($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FaqI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(FaqI18nPeer::FAQ_ID)) $criteria->add(FaqI18nPeer::FAQ_ID, $this->faq_id);
		if ($this->isColumnModified(FaqI18nPeer::CULTURE)) $criteria->add(FaqI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(FaqI18nPeer::QUESTION_I18N)) $criteria->add(FaqI18nPeer::QUESTION_I18N, $this->question_i18n);
		if ($this->isColumnModified(FaqI18nPeer::ANSWER_I18N)) $criteria->add(FaqI18nPeer::ANSWER_I18N, $this->answer_i18n);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FaqI18nPeer::DATABASE_NAME);

		$criteria->add(FaqI18nPeer::FAQ_ID, $this->faq_id);
		$criteria->add(FaqI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getFaqId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setFaqId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setQuestionI18n($this->question_i18n);

		$copyObj->setAnswerI18n($this->answer_i18n);


		$copyObj->setNew(true);

		$copyObj->setFaqId(NULL); 
		$copyObj->setCulture(NULL); 
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
			self::$peer = new FaqI18nPeer();
		}
		return self::$peer;
	}

	
	public function setFaq($v)
	{


		if ($v === null) {
			$this->setFaqId(NULL);
		} else {
			$this->setFaqId($v->getId());
		}


		$this->aFaq = $v;
	}


	
	public function getFaq($con = null)
	{
		if ($this->aFaq === null && ($this->faq_id !== null)) {
						include_once 'lib/model/om/BaseFaqPeer.php';

			$this->aFaq = FaqPeer::retrieveByPK($this->faq_id, $con);

			
		}
		return $this->aFaq;
	}

} 