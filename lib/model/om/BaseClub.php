<?php


abstract class BaseClub extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $club_name;


	
	protected $file_name_logo;


	
	protected $address_name;


	
	protected $address_number;


	
	protected $address_quarter;


	
	protected $city_id;


	
	protected $maps_link;


	
	protected $club_site;


	
	protected $phone_number_1;


	
	protected $phone_number_2;


	
	protected $phone_number_3;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCity;

	
	protected $collEventLiveList;

	
	protected $lastEventLiveCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getClubName()
	{

		return $this->club_name;
	}

	
	public function getFileNameLogo()
	{

		return $this->file_name_logo;
	}

	
	public function getAddressName()
	{

		return $this->address_name;
	}

	
	public function getAddressNumber()
	{

		return $this->address_number;
	}

	
	public function getAddressQuarter()
	{

		return $this->address_quarter;
	}

	
	public function getCityId()
	{

		return $this->city_id;
	}

	
	public function getMapsLink()
	{

		return $this->maps_link;
	}

	
	public function getClubSite()
	{

		return $this->club_site;
	}

	
	public function getPhoneNumber1()
	{

		return $this->phone_number_1;
	}

	
	public function getPhoneNumber2()
	{

		return $this->phone_number_2;
	}

	
	public function getPhoneNumber3()
	{

		return $this->phone_number_3;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ClubPeer::ID;
		}

	} 
	
	public function setClubName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->club_name !== $v) {
			$this->club_name = $v;
			$this->modifiedColumns[] = ClubPeer::CLUB_NAME;
		}

	} 
	
	public function setFileNameLogo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_name_logo !== $v) {
			$this->file_name_logo = $v;
			$this->modifiedColumns[] = ClubPeer::FILE_NAME_LOGO;
		}

	} 
	
	public function setAddressName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_name !== $v) {
			$this->address_name = $v;
			$this->modifiedColumns[] = ClubPeer::ADDRESS_NAME;
		}

	} 
	
	public function setAddressNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_number !== $v) {
			$this->address_number = $v;
			$this->modifiedColumns[] = ClubPeer::ADDRESS_NUMBER;
		}

	} 
	
	public function setAddressQuarter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_quarter !== $v) {
			$this->address_quarter = $v;
			$this->modifiedColumns[] = ClubPeer::ADDRESS_QUARTER;
		}

	} 
	
	public function setCityId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->city_id !== $v) {
			$this->city_id = $v;
			$this->modifiedColumns[] = ClubPeer::CITY_ID;
		}

		if ($this->aCity !== null && $this->aCity->getId() !== $v) {
			$this->aCity = null;
		}

	} 
	
	public function setMapsLink($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->maps_link !== $v) {
			$this->maps_link = $v;
			$this->modifiedColumns[] = ClubPeer::MAPS_LINK;
		}

	} 
	
	public function setClubSite($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->club_site !== $v) {
			$this->club_site = $v;
			$this->modifiedColumns[] = ClubPeer::CLUB_SITE;
		}

	} 
	
	public function setPhoneNumber1($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone_number_1 !== $v) {
			$this->phone_number_1 = $v;
			$this->modifiedColumns[] = ClubPeer::PHONE_NUMBER_1;
		}

	} 
	
	public function setPhoneNumber2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone_number_2 !== $v) {
			$this->phone_number_2 = $v;
			$this->modifiedColumns[] = ClubPeer::PHONE_NUMBER_2;
		}

	} 
	
	public function setPhoneNumber3($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone_number_3 !== $v) {
			$this->phone_number_3 = $v;
			$this->modifiedColumns[] = ClubPeer::PHONE_NUMBER_3;
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
			$this->modifiedColumns[] = ClubPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ClubPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->club_name = $rs->getString($startcol + 1);

			$this->file_name_logo = $rs->getString($startcol + 2);

			$this->address_name = $rs->getString($startcol + 3);

			$this->address_number = $rs->getString($startcol + 4);

			$this->address_quarter = $rs->getString($startcol + 5);

			$this->city_id = $rs->getInt($startcol + 6);

			$this->maps_link = $rs->getString($startcol + 7);

			$this->club_site = $rs->getString($startcol + 8);

			$this->phone_number_1 = $rs->getString($startcol + 9);

			$this->phone_number_2 = $rs->getString($startcol + 10);

			$this->phone_number_3 = $rs->getString($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Club object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClubPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ClubPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ClubPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubPeer::DATABASE_NAME);
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


												
			if ($this->aCity !== null) {
				if ($this->aCity->isModified()) {
					$affectedRows += $this->aCity->save($con);
				}
				$this->setCity($this->aCity);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClubPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ClubPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventLiveList !== null) {
				foreach($this->collEventLiveList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aCity !== null) {
				if (!$this->aCity->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCity->getValidationFailures());
				}
			}


			if (($retval = ClubPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventLiveList !== null) {
					foreach($this->collEventLiveList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getClubName();
				break;
			case 2:
				return $this->getFileNameLogo();
				break;
			case 3:
				return $this->getAddressName();
				break;
			case 4:
				return $this->getAddressNumber();
				break;
			case 5:
				return $this->getAddressQuarter();
				break;
			case 6:
				return $this->getCityId();
				break;
			case 7:
				return $this->getMapsLink();
				break;
			case 8:
				return $this->getClubSite();
				break;
			case 9:
				return $this->getPhoneNumber1();
				break;
			case 10:
				return $this->getPhoneNumber2();
				break;
			case 11:
				return $this->getPhoneNumber3();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getClubName(),
			$keys[2]=>$this->getFileNameLogo(),
			$keys[3]=>$this->getAddressName(),
			$keys[4]=>$this->getAddressNumber(),
			$keys[5]=>$this->getAddressQuarter(),
			$keys[6]=>$this->getCityId(),
			$keys[7]=>$this->getMapsLink(),
			$keys[8]=>$this->getClubSite(),
			$keys[9]=>$this->getPhoneNumber1(),
			$keys[10]=>$this->getPhoneNumber2(),
			$keys[11]=>$this->getPhoneNumber3(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setClubName($value);
				break;
			case 2:
				$this->setFileNameLogo($value);
				break;
			case 3:
				$this->setAddressName($value);
				break;
			case 4:
				$this->setAddressNumber($value);
				break;
			case 5:
				$this->setAddressQuarter($value);
				break;
			case 6:
				$this->setCityId($value);
				break;
			case 7:
				$this->setMapsLink($value);
				break;
			case 8:
				$this->setClubSite($value);
				break;
			case 9:
				$this->setPhoneNumber1($value);
				break;
			case 10:
				$this->setPhoneNumber2($value);
				break;
			case 11:
				$this->setPhoneNumber3($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClubName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFileNameLogo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAddressName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAddressNumber($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAddressQuarter($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCityId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMapsLink($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setClubSite($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPhoneNumber1($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPhoneNumber2($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPhoneNumber3($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClubPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClubPeer::ID)) $criteria->add(ClubPeer::ID, $this->id);
		if ($this->isColumnModified(ClubPeer::CLUB_NAME)) $criteria->add(ClubPeer::CLUB_NAME, $this->club_name);
		if ($this->isColumnModified(ClubPeer::FILE_NAME_LOGO)) $criteria->add(ClubPeer::FILE_NAME_LOGO, $this->file_name_logo);
		if ($this->isColumnModified(ClubPeer::ADDRESS_NAME)) $criteria->add(ClubPeer::ADDRESS_NAME, $this->address_name);
		if ($this->isColumnModified(ClubPeer::ADDRESS_NUMBER)) $criteria->add(ClubPeer::ADDRESS_NUMBER, $this->address_number);
		if ($this->isColumnModified(ClubPeer::ADDRESS_QUARTER)) $criteria->add(ClubPeer::ADDRESS_QUARTER, $this->address_quarter);
		if ($this->isColumnModified(ClubPeer::CITY_ID)) $criteria->add(ClubPeer::CITY_ID, $this->city_id);
		if ($this->isColumnModified(ClubPeer::MAPS_LINK)) $criteria->add(ClubPeer::MAPS_LINK, $this->maps_link);
		if ($this->isColumnModified(ClubPeer::CLUB_SITE)) $criteria->add(ClubPeer::CLUB_SITE, $this->club_site);
		if ($this->isColumnModified(ClubPeer::PHONE_NUMBER_1)) $criteria->add(ClubPeer::PHONE_NUMBER_1, $this->phone_number_1);
		if ($this->isColumnModified(ClubPeer::PHONE_NUMBER_2)) $criteria->add(ClubPeer::PHONE_NUMBER_2, $this->phone_number_2);
		if ($this->isColumnModified(ClubPeer::PHONE_NUMBER_3)) $criteria->add(ClubPeer::PHONE_NUMBER_3, $this->phone_number_3);
		if ($this->isColumnModified(ClubPeer::CREATED_AT)) $criteria->add(ClubPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ClubPeer::UPDATED_AT)) $criteria->add(ClubPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClubPeer::DATABASE_NAME);

		$criteria->add(ClubPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setClubName($this->club_name);

		$copyObj->setFileNameLogo($this->file_name_logo);

		$copyObj->setAddressName($this->address_name);

		$copyObj->setAddressNumber($this->address_number);

		$copyObj->setAddressQuarter($this->address_quarter);

		$copyObj->setCityId($this->city_id);

		$copyObj->setMapsLink($this->maps_link);

		$copyObj->setClubSite($this->club_site);

		$copyObj->setPhoneNumber1($this->phone_number_1);

		$copyObj->setPhoneNumber2($this->phone_number_2);

		$copyObj->setPhoneNumber3($this->phone_number_3);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventLiveList() as $relObj) {
				$copyObj->addEventLive($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
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
			self::$peer = new ClubPeer();
		}
		return self::$peer;
	}

	
	public function setCity($v)
	{


		if ($v === null) {
			$this->setCityId(NULL);
		} else {
			$this->setCityId($v->getId());
		}


		$this->aCity = $v;
	}


	
	public function getCity($con = null)
	{
		if ($this->aCity === null && ($this->city_id !== null)) {
						include_once 'lib/model/om/BaseCityPeer.php';

			$this->aCity = CityPeer::retrieveByPK($this->city_id, $con);

			
		}
		return $this->aCity;
	}

	
	public function initEventLiveList()
	{
		if ($this->collEventLiveList === null) {
			$this->collEventLiveList = array();
		}
	}

	
	public function getEventLiveList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveList === null) {
			if ($this->isNew()) {
			   $this->collEventLiveList = array();
			} else {

				$criteria->add(EventLivePeer::CLUB_ID, $this->getId());

				EventLivePeer::addSelectColumns($criteria);
				$this->collEventLiveList = EventLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLivePeer::CLUB_ID, $this->getId());

				EventLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLiveCriteria) || !$this->lastEventLiveCriteria->equals($criteria)) {
					$this->collEventLiveList = EventLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLiveCriteria = $criteria;
		return $this->collEventLiveList;
	}

	
	public function countEventLiveList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLivePeer::CLUB_ID, $this->getId());

		return EventLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLive(EventLive $l)
	{
		$this->collEventLiveList[] = $l;
		$l->setClub($this);
	}


	
	public function getEventLiveListJoinRankingLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveList === null) {
			if ($this->isNew()) {
				$this->collEventLiveList = array();
			} else {

				$criteria->add(EventLivePeer::CLUB_ID, $this->getId());

				$this->collEventLiveList = EventLivePeer::doSelectJoinRankingLive($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEventLiveCriteria) || !$this->lastEventLiveCriteria->equals($criteria)) {
				$this->collEventLiveList = EventLivePeer::doSelectJoinRankingLive($criteria, $con);
			}
		}
		$this->lastEventLiveCriteria = $criteria;

		return $this->collEventLiveList;
	}

} 