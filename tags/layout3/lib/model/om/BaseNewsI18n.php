<?php


abstract class BaseNewsI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $news_id;


	
	protected $culture;


	
	protected $news_title_i18n;


	
	protected $description_i18n;

	
	protected $aNews;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getNewsId()
	{

		return $this->news_id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function getNewsTitleI18n()
	{

		return $this->news_title_i18n;
	}

	
	public function getDescriptionI18n()
	{

		return $this->description_i18n;
	}

	
	public function setNewsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->news_id !== $v) {
			$this->news_id = $v;
			$this->modifiedColumns[] = NewsI18nPeer::NEWS_ID;
		}

		if ($this->aNews !== null && $this->aNews->getId() !== $v) {
			$this->aNews = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = NewsI18nPeer::CULTURE;
		}

	} 
	
	public function setNewsTitleI18n($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->news_title_i18n !== $v) {
			$this->news_title_i18n = $v;
			$this->modifiedColumns[] = NewsI18nPeer::NEWS_TITLE_I18N;
		}

	} 
	
	public function setDescriptionI18n($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description_i18n !== $v) {
			$this->description_i18n = $v;
			$this->modifiedColumns[] = NewsI18nPeer::DESCRIPTION_I18N;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->news_id = $rs->getInt($startcol + 0);

			$this->culture = $rs->getString($startcol + 1);

			$this->news_title_i18n = $rs->getString($startcol + 2);

			$this->description_i18n = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating NewsI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NewsI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NewsI18nPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(NewsI18nPeer::DATABASE_NAME);
		}

		$tableName = NewsI18nPeer::TABLE_NAME;
		
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


												
			if ($this->aNews !== null) {
				if ($this->aNews->isModified() || $this->aNews->getCurrentNewsI18n()->isModified()) {
					$affectedRows += $this->aNews->save($con);
				}
				$this->setNews($this->aNews);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NewsI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += NewsI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aNews !== null) {
				if (!$this->aNews->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNews->getValidationFailures());
				}
			}


			if (($retval = NewsI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NewsI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getNewsId();
				break;
			case 1:
				return $this->getCulture();
				break;
			case 2:
				return $this->getNewsTitleI18n();
				break;
			case 3:
				return $this->getDescriptionI18n();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NewsI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getNewsId(),
			$keys[1]=>$this->getCulture(),
			$keys[2]=>$this->getNewsTitleI18n(),
			$keys[3]=>$this->getDescriptionI18n(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NewsI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setNewsId($value);
				break;
			case 1:
				$this->setCulture($value);
				break;
			case 2:
				$this->setNewsTitleI18n($value);
				break;
			case 3:
				$this->setDescriptionI18n($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NewsI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNewsId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNewsTitleI18n($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescriptionI18n($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NewsI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(NewsI18nPeer::NEWS_ID)) $criteria->add(NewsI18nPeer::NEWS_ID, $this->news_id);
		if ($this->isColumnModified(NewsI18nPeer::CULTURE)) $criteria->add(NewsI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(NewsI18nPeer::NEWS_TITLE_I18N)) $criteria->add(NewsI18nPeer::NEWS_TITLE_I18N, $this->news_title_i18n);
		if ($this->isColumnModified(NewsI18nPeer::DESCRIPTION_I18N)) $criteria->add(NewsI18nPeer::DESCRIPTION_I18N, $this->description_i18n);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NewsI18nPeer::DATABASE_NAME);

		$criteria->add(NewsI18nPeer::NEWS_ID, $this->news_id);
		$criteria->add(NewsI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getNewsId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setNewsId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNewsTitleI18n($this->news_title_i18n);

		$copyObj->setDescriptionI18n($this->description_i18n);


		$copyObj->setNew(true);

		$copyObj->setNewsId(NULL); 
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
			self::$peer = new NewsI18nPeer();
		}
		return self::$peer;
	}

	
	public function setNews($v)
	{


		if ($v === null) {
			$this->setNewsId(NULL);
		} else {
			$this->setNewsId($v->getId());
		}


		$this->aNews = $v;
	}


	
	public function getNews($con = null)
	{
		if ($this->aNews === null && ($this->news_id !== null)) {
						include_once 'lib/model/om/BaseNewsPeer.php';

			$this->aNews = NewsPeer::retrieveByPK($this->news_id, $con);

			
		}
		return $this->aNews;
	}

} 