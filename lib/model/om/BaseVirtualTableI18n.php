<?php


abstract class BaseVirtualTableI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $virtual_table_id;


	
	protected $culture;


	
	protected $description_i18n;

	
	protected $aVirtualTable;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getVirtualTableId()
	{

		return $this->virtual_table_id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function getDescriptionI18n()
	{

		return $this->description_i18n;
	}

	
	public function setVirtualTableId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->virtual_table_id !== $v) {
			$this->virtual_table_id = $v;
			$this->modifiedColumns[] = VirtualTableI18nPeer::VIRTUAL_TABLE_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = VirtualTableI18nPeer::CULTURE;
		}

	} 
	
	public function setDescriptionI18n($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description_i18n !== $v) {
			$this->description_i18n = $v;
			$this->modifiedColumns[] = VirtualTableI18nPeer::DESCRIPTION_I18N;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->virtual_table_id = $rs->getInt($startcol + 0);

			$this->culture = $rs->getString($startcol + 1);

			$this->description_i18n = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating VirtualTableI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VirtualTableI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VirtualTableI18nPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(VirtualTableI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified() || $this->aVirtualTable->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = VirtualTableI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += VirtualTableI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}


			if (($retval = VirtualTableI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VirtualTableI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getVirtualTableId();
				break;
			case 1:
				return $this->getCulture();
				break;
			case 2:
				return $this->getDescriptionI18n();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VirtualTableI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getVirtualTableId(),
			$keys[1]=>$this->getCulture(),
			$keys[2]=>$this->getDescriptionI18n(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VirtualTableI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setVirtualTableId($value);
				break;
			case 1:
				$this->setCulture($value);
				break;
			case 2:
				$this->setDescriptionI18n($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VirtualTableI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setVirtualTableId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescriptionI18n($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(VirtualTableI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(VirtualTableI18nPeer::VIRTUAL_TABLE_ID)) $criteria->add(VirtualTableI18nPeer::VIRTUAL_TABLE_ID, $this->virtual_table_id);
		if ($this->isColumnModified(VirtualTableI18nPeer::CULTURE)) $criteria->add(VirtualTableI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(VirtualTableI18nPeer::DESCRIPTION_I18N)) $criteria->add(VirtualTableI18nPeer::DESCRIPTION_I18N, $this->description_i18n);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VirtualTableI18nPeer::DATABASE_NAME);

		$criteria->add(VirtualTableI18nPeer::VIRTUAL_TABLE_ID, $this->virtual_table_id);
		$criteria->add(VirtualTableI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getVirtualTableId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setVirtualTableId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDescriptionI18n($this->description_i18n);


		$copyObj->setNew(true);

		$copyObj->setVirtualTableId(NULL); 
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
			self::$peer = new VirtualTableI18nPeer();
		}
		return self::$peer;
	}

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setVirtualTableId(NULL);
		} else {
			$this->setVirtualTableId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->virtual_table_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->virtual_table_id, $con);

			
		}
		return $this->aVirtualTable;
	}

} 