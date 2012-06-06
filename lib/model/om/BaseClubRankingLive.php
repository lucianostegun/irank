<?php


abstract class BaseClubRankingLive extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $club_id;


	
	protected $ranking_live_id;


	
	protected $enabled;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aClub;

	
	protected $aRankingLive;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getRankingLiveId()
	{

		return $this->ranking_live_id;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
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
			$this->modifiedColumns[] = ClubRankingLivePeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setRankingLiveId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_live_id !== $v) {
			$this->ranking_live_id = $v;
			$this->modifiedColumns[] = ClubRankingLivePeer::RANKING_LIVE_ID;
		}

		if ($this->aRankingLive !== null && $this->aRankingLive->getId() !== $v) {
			$this->aRankingLive = null;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ClubRankingLivePeer::ENABLED;
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
			$this->modifiedColumns[] = ClubRankingLivePeer::CREATED_AT;
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
			$this->modifiedColumns[] = ClubRankingLivePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->club_id = $rs->getInt($startcol + 0);

			$this->ranking_live_id = $rs->getInt($startcol + 1);

			$this->enabled = $rs->getBoolean($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ClubRankingLive object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubRankingLivePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClubRankingLivePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ClubRankingLivePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ClubRankingLivePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubRankingLivePeer::DATABASE_NAME);
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

			if ($this->aRankingLive !== null) {
				if ($this->aRankingLive->isModified()) {
					$affectedRows += $this->aRankingLive->save($con);
				}
				$this->setRankingLive($this->aRankingLive);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClubRankingLivePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ClubRankingLivePeer::doUpdate($this, $con);
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

			if ($this->aRankingLive !== null) {
				if (!$this->aRankingLive->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRankingLive->getValidationFailures());
				}
			}


			if (($retval = ClubRankingLivePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubRankingLivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getClubId();
				break;
			case 1:
				return $this->getRankingLiveId();
				break;
			case 2:
				return $this->getEnabled();
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
		$keys = ClubRankingLivePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getClubId(),
			$keys[1]=>$this->getRankingLiveId(),
			$keys[2]=>$this->getEnabled(),
			$keys[3]=>$this->getCreatedAt(),
			$keys[4]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubRankingLivePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setClubId($value);
				break;
			case 1:
				$this->setRankingLiveId($value);
				break;
			case 2:
				$this->setEnabled($value);
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
		$keys = ClubRankingLivePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setClubId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingLiveId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEnabled($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClubRankingLivePeer::DATABASE_NAME);

		if ($this->isColumnModified(ClubRankingLivePeer::CLUB_ID)) $criteria->add(ClubRankingLivePeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(ClubRankingLivePeer::RANKING_LIVE_ID)) $criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->ranking_live_id);
		if ($this->isColumnModified(ClubRankingLivePeer::ENABLED)) $criteria->add(ClubRankingLivePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ClubRankingLivePeer::CREATED_AT)) $criteria->add(ClubRankingLivePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ClubRankingLivePeer::UPDATED_AT)) $criteria->add(ClubRankingLivePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClubRankingLivePeer::DATABASE_NAME);

		$criteria->add(ClubRankingLivePeer::CLUB_ID, $this->club_id);
		$criteria->add(ClubRankingLivePeer::RANKING_LIVE_ID, $this->ranking_live_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getClubId();

		$pks[1] = $this->getRankingLiveId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setClubId($keys[0]);

		$this->setRankingLiveId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setEnabled($this->enabled);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setClubId(NULL); 
		$copyObj->setRankingLiveId(NULL); 
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
			self::$peer = new ClubRankingLivePeer();
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

	
	public function setRankingLive($v)
	{


		if ($v === null) {
			$this->setRankingLiveId(NULL);
		} else {
			$this->setRankingLiveId($v->getId());
		}


		$this->aRankingLive = $v;
	}


	
	public function getRankingLive($con = null)
	{
		if ($this->aRankingLive === null && ($this->ranking_live_id !== null)) {
						include_once 'lib/model/om/BaseRankingLivePeer.php';

			$this->aRankingLive = RankingLivePeer::retrieveByPK($this->ranking_live_id, $con);

			
		}
		return $this->aRankingLive;
	}

} 