<?php


abstract class BaseClubSettings extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $club_id;


	
	protected $settings_id;


	
	protected $settings_value;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aClub;

	
	protected $aSettings;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getSettingsId()
	{

		return $this->settings_id;
	}

	
	public function getSettingsValue()
	{

		return $this->settings_value;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setClubId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = ClubSettingsPeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setSettingsId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->settings_id !== $v) {
			$this->settings_id = $v;
			$this->modifiedColumns[] = ClubSettingsPeer::SETTINGS_ID;
		}

		if ($this->aSettings !== null && $this->aSettings->getId() !== $v) {
			$this->aSettings = null;
		}

	} 
	
	public function setSettingsValue($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->settings_value !== $v) {
			$this->settings_value = $v;
			$this->modifiedColumns[] = ClubSettingsPeer::SETTINGS_VALUE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = ClubSettingsPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ClubSettingsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->club_id = $rs->getInt($startcol + 0);

			$this->settings_id = $rs->getInt($startcol + 1);

			$this->settings_value = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ClubSettings object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubSettingsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClubSettingsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ClubSettingsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ClubSettingsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubSettingsPeer::DATABASE_NAME);
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


												
			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}

			if ($this->aSettings !== null) {
				if ($this->aSettings->isModified()) {
					$affectedRows += $this->aSettings->save($con);
				}
				$this->setSettings($this->aSettings);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClubSettingsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ClubSettingsPeer::doUpdate($this, $con);
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


												
			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}

			if ($this->aSettings !== null) {
				if (!$this->aSettings->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSettings->getValidationFailures());
				}
			}


			if (($retval = ClubSettingsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubSettingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getClubId();
				break;
			case 1:
				return $this->getSettingsId();
				break;
			case 2:
				return $this->getSettingsValue();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubSettingsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getClubId(),
			$keys[1]=>$this->getSettingsId(),
			$keys[2]=>$this->getSettingsValue(),
			$keys[3]=>$this->getCreatedAt(),
			$keys[4]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubSettingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setClubId($value);
				break;
			case 1:
				$this->setSettingsId($value);
				break;
			case 2:
				$this->setSettingsValue($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubSettingsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setClubId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSettingsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSettingsValue($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClubSettingsPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClubSettingsPeer::CLUB_ID)) $criteria->add(ClubSettingsPeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(ClubSettingsPeer::SETTINGS_ID)) $criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->settings_id);
		if ($this->isColumnModified(ClubSettingsPeer::SETTINGS_VALUE)) $criteria->add(ClubSettingsPeer::SETTINGS_VALUE, $this->settings_value);
		if ($this->isColumnModified(ClubSettingsPeer::CREATED_AT)) $criteria->add(ClubSettingsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ClubSettingsPeer::UPDATED_AT)) $criteria->add(ClubSettingsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClubSettingsPeer::DATABASE_NAME);

		$criteria->add(ClubSettingsPeer::CLUB_ID, $this->club_id);
		$criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->settings_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getClubId();

		$pks[1] = $this->getSettingsId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setClubId($keys[0]);

		$this->setSettingsId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSettingsValue($this->settings_value);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setClubId(NULL); 
		$copyObj->setSettingsId(NULL); 
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
			self::$peer = new ClubSettingsPeer();
		}
		return self::$peer;
	}

	
	public function setClub($v)
	{


		if ($v === null) {
			$this->setClubId(NULL);
		} else {
			$this->setClubId($v->getId());
		}


		$this->aClub = $v;
	}


	
	public function getClub($con = null)
	{
		if ($this->aClub === null && ($this->club_id !== null)) {
						include_once 'lib/model/om/BaseClubPeer.php';

			$this->aClub = ClubPeer::retrieveByPK($this->club_id, $con);

			
		}
		return $this->aClub;
	}

	
	public function setSettings($v)
	{


		if ($v === null) {
			$this->setSettingsId(NULL);
		} else {
			$this->setSettingsId($v->getId());
		}


		$this->aSettings = $v;
	}


	
	public function getSettings($con = null)
	{
		if ($this->aSettings === null && ($this->settings_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseSettingsPeer.php';

			$this->aSettings = SettingsPeer::retrieveByPK($this->settings_id, $con);

			
		}
		return $this->aSettings;
	}

} 