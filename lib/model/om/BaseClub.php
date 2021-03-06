<?php


abstract class BaseClub extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $club_name;


	
	protected $tag_name;


	
	protected $file_name_logo;


	
	protected $address_name;


	
	protected $address_number;


	
	protected $address_quarter;


	
	protected $city_id;


	
	protected $maps_link;


	
	protected $latitude;


	
	protected $longitude;


	
	protected $club_site;


	
	protected $description;


	
	protected $phone_number_1;


	
	protected $phone_number_2;


	
	protected $phone_number_3;


	
	protected $visit_count = 0;


	
	protected $sms_credit = 0;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCity;

	
	protected $collEventLiveList;

	
	protected $lastEventLiveCriteria = null;

	
	protected $collUserAdminList;

	
	protected $lastUserAdminCriteria = null;

	
	protected $collClubRankingLiveList;

	
	protected $lastClubRankingLiveCriteria = null;

	
	protected $collClubPhotoList;

	
	protected $lastClubPhotoCriteria = null;

	
	protected $collClubSettingsList;

	
	protected $lastClubSettingsCriteria = null;

	
	protected $collSmsList;

	
	protected $lastSmsCriteria = null;

	
	protected $collCashTableList;

	
	protected $lastCashTableCriteria = null;

	
	protected $collEmailTemplateList;

	
	protected $lastEmailTemplateCriteria = null;

	
	protected $collEmailMarketingList;

	
	protected $lastEmailMarketingCriteria = null;

	
	protected $collClubPlayerList;

	
	protected $lastClubPlayerCriteria = null;

	
	protected $collClubCheckList;

	
	protected $lastClubCheckCriteria = null;

	
	protected $collEventLiveViewList;

	
	protected $lastEventLiveViewCriteria = null;

	
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

	
	public function getTagName()
	{

		return $this->tag_name;
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

	
	public function getLatitude()
	{

		return $this->latitude;
	}

	
	public function getLongitude()
	{

		return $this->longitude;
	}

	
	public function getClubSite()
	{

		return $this->club_site;
	}

	
	public function getDescription()
	{

		return $this->description;
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

	
	public function getVisitCount()
	{

		return $this->visit_count;
	}

	
	public function getSmsCredit()
	{

		return $this->sms_credit;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getVisible()
	{

		return $this->visible;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
	}

	
	public function getLocked()
	{

		return $this->locked;
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
	
	public function setTagName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = ClubPeer::TAG_NAME;
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
	
	public function setLatitude($v)
	{

		if ($this->latitude !== $v) {
			$this->latitude = $v;
			$this->modifiedColumns[] = ClubPeer::LATITUDE;
		}

	} 
	
	public function setLongitude($v)
	{

		if ($this->longitude !== $v) {
			$this->longitude = $v;
			$this->modifiedColumns[] = ClubPeer::LONGITUDE;
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
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ClubPeer::DESCRIPTION;
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
	
	public function setVisitCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->visit_count !== $v || $v === 0) {
			$this->visit_count = $v;
			$this->modifiedColumns[] = ClubPeer::VISIT_COUNT;
		}

	} 
	
	public function setSmsCredit($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sms_credit !== $v || $v === 0) {
			$this->sms_credit = $v;
			$this->modifiedColumns[] = ClubPeer::SMS_CREDIT;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ClubPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = ClubPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = ClubPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = ClubPeer::LOCKED;
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

			$this->tag_name = $rs->getString($startcol + 2);

			$this->file_name_logo = $rs->getString($startcol + 3);

			$this->address_name = $rs->getString($startcol + 4);

			$this->address_number = $rs->getString($startcol + 5);

			$this->address_quarter = $rs->getString($startcol + 6);

			$this->city_id = $rs->getInt($startcol + 7);

			$this->maps_link = $rs->getString($startcol + 8);

			$this->latitude = $rs->getFloat($startcol + 9);

			$this->longitude = $rs->getFloat($startcol + 10);

			$this->club_site = $rs->getString($startcol + 11);

			$this->description = $rs->getString($startcol + 12);

			$this->phone_number_1 = $rs->getString($startcol + 13);

			$this->phone_number_2 = $rs->getString($startcol + 14);

			$this->phone_number_3 = $rs->getString($startcol + 15);

			$this->visit_count = $rs->getInt($startcol + 16);

			$this->sms_credit = $rs->getInt($startcol + 17);

			$this->enabled = $rs->getBoolean($startcol + 18);

			$this->visible = $rs->getBoolean($startcol + 19);

			$this->deleted = $rs->getBoolean($startcol + 20);

			$this->locked = $rs->getBoolean($startcol + 21);

			$this->created_at = $rs->getTimestamp($startcol + 22, null);

			$this->updated_at = $rs->getTimestamp($startcol + 23, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 24; 
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

			if ($this->collUserAdminList !== null) {
				foreach($this->collUserAdminList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubRankingLiveList !== null) {
				foreach($this->collClubRankingLiveList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubPhotoList !== null) {
				foreach($this->collClubPhotoList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubSettingsList !== null) {
				foreach($this->collClubSettingsList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSmsList !== null) {
				foreach($this->collSmsList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCashTableList !== null) {
				foreach($this->collCashTableList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEmailTemplateList !== null) {
				foreach($this->collEmailTemplateList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEmailMarketingList !== null) {
				foreach($this->collEmailMarketingList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubPlayerList !== null) {
				foreach($this->collClubPlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClubCheckList !== null) {
				foreach($this->collClubCheckList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventLiveViewList !== null) {
				foreach($this->collEventLiveViewList as $referrerFK) {
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

				if ($this->collUserAdminList !== null) {
					foreach($this->collUserAdminList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubRankingLiveList !== null) {
					foreach($this->collClubRankingLiveList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubPhotoList !== null) {
					foreach($this->collClubPhotoList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubSettingsList !== null) {
					foreach($this->collClubSettingsList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSmsList !== null) {
					foreach($this->collSmsList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCashTableList !== null) {
					foreach($this->collCashTableList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEmailTemplateList !== null) {
					foreach($this->collEmailTemplateList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEmailMarketingList !== null) {
					foreach($this->collEmailMarketingList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubPlayerList !== null) {
					foreach($this->collClubPlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClubCheckList !== null) {
					foreach($this->collClubCheckList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventLiveViewList !== null) {
					foreach($this->collEventLiveViewList as $referrerFK) {
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
				return $this->getTagName();
				break;
			case 3:
				return $this->getFileNameLogo();
				break;
			case 4:
				return $this->getAddressName();
				break;
			case 5:
				return $this->getAddressNumber();
				break;
			case 6:
				return $this->getAddressQuarter();
				break;
			case 7:
				return $this->getCityId();
				break;
			case 8:
				return $this->getMapsLink();
				break;
			case 9:
				return $this->getLatitude();
				break;
			case 10:
				return $this->getLongitude();
				break;
			case 11:
				return $this->getClubSite();
				break;
			case 12:
				return $this->getDescription();
				break;
			case 13:
				return $this->getPhoneNumber1();
				break;
			case 14:
				return $this->getPhoneNumber2();
				break;
			case 15:
				return $this->getPhoneNumber3();
				break;
			case 16:
				return $this->getVisitCount();
				break;
			case 17:
				return $this->getSmsCredit();
				break;
			case 18:
				return $this->getEnabled();
				break;
			case 19:
				return $this->getVisible();
				break;
			case 20:
				return $this->getDeleted();
				break;
			case 21:
				return $this->getLocked();
				break;
			case 22:
				return $this->getCreatedAt();
				break;
			case 23:
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
			$keys[2]=>$this->getTagName(),
			$keys[3]=>$this->getFileNameLogo(),
			$keys[4]=>$this->getAddressName(),
			$keys[5]=>$this->getAddressNumber(),
			$keys[6]=>$this->getAddressQuarter(),
			$keys[7]=>$this->getCityId(),
			$keys[8]=>$this->getMapsLink(),
			$keys[9]=>$this->getLatitude(),
			$keys[10]=>$this->getLongitude(),
			$keys[11]=>$this->getClubSite(),
			$keys[12]=>$this->getDescription(),
			$keys[13]=>$this->getPhoneNumber1(),
			$keys[14]=>$this->getPhoneNumber2(),
			$keys[15]=>$this->getPhoneNumber3(),
			$keys[16]=>$this->getVisitCount(),
			$keys[17]=>$this->getSmsCredit(),
			$keys[18]=>$this->getEnabled(),
			$keys[19]=>$this->getVisible(),
			$keys[20]=>$this->getDeleted(),
			$keys[21]=>$this->getLocked(),
			$keys[22]=>$this->getCreatedAt(),
			$keys[23]=>$this->getUpdatedAt(),
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
				$this->setTagName($value);
				break;
			case 3:
				$this->setFileNameLogo($value);
				break;
			case 4:
				$this->setAddressName($value);
				break;
			case 5:
				$this->setAddressNumber($value);
				break;
			case 6:
				$this->setAddressQuarter($value);
				break;
			case 7:
				$this->setCityId($value);
				break;
			case 8:
				$this->setMapsLink($value);
				break;
			case 9:
				$this->setLatitude($value);
				break;
			case 10:
				$this->setLongitude($value);
				break;
			case 11:
				$this->setClubSite($value);
				break;
			case 12:
				$this->setDescription($value);
				break;
			case 13:
				$this->setPhoneNumber1($value);
				break;
			case 14:
				$this->setPhoneNumber2($value);
				break;
			case 15:
				$this->setPhoneNumber3($value);
				break;
			case 16:
				$this->setVisitCount($value);
				break;
			case 17:
				$this->setSmsCredit($value);
				break;
			case 18:
				$this->setEnabled($value);
				break;
			case 19:
				$this->setVisible($value);
				break;
			case 20:
				$this->setDeleted($value);
				break;
			case 21:
				$this->setLocked($value);
				break;
			case 22:
				$this->setCreatedAt($value);
				break;
			case 23:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClubName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTagName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFileNameLogo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAddressName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAddressNumber($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAddressQuarter($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCityId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMapsLink($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLatitude($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLongitude($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setClubSite($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDescription($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPhoneNumber1($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPhoneNumber2($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPhoneNumber3($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setVisitCount($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setSmsCredit($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setEnabled($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setVisible($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setDeleted($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setLocked($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCreatedAt($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setUpdatedAt($arr[$keys[23]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClubPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClubPeer::ID)) $criteria->add(ClubPeer::ID, $this->id);
		if ($this->isColumnModified(ClubPeer::CLUB_NAME)) $criteria->add(ClubPeer::CLUB_NAME, $this->club_name);
		if ($this->isColumnModified(ClubPeer::TAG_NAME)) $criteria->add(ClubPeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(ClubPeer::FILE_NAME_LOGO)) $criteria->add(ClubPeer::FILE_NAME_LOGO, $this->file_name_logo);
		if ($this->isColumnModified(ClubPeer::ADDRESS_NAME)) $criteria->add(ClubPeer::ADDRESS_NAME, $this->address_name);
		if ($this->isColumnModified(ClubPeer::ADDRESS_NUMBER)) $criteria->add(ClubPeer::ADDRESS_NUMBER, $this->address_number);
		if ($this->isColumnModified(ClubPeer::ADDRESS_QUARTER)) $criteria->add(ClubPeer::ADDRESS_QUARTER, $this->address_quarter);
		if ($this->isColumnModified(ClubPeer::CITY_ID)) $criteria->add(ClubPeer::CITY_ID, $this->city_id);
		if ($this->isColumnModified(ClubPeer::MAPS_LINK)) $criteria->add(ClubPeer::MAPS_LINK, $this->maps_link);
		if ($this->isColumnModified(ClubPeer::LATITUDE)) $criteria->add(ClubPeer::LATITUDE, $this->latitude);
		if ($this->isColumnModified(ClubPeer::LONGITUDE)) $criteria->add(ClubPeer::LONGITUDE, $this->longitude);
		if ($this->isColumnModified(ClubPeer::CLUB_SITE)) $criteria->add(ClubPeer::CLUB_SITE, $this->club_site);
		if ($this->isColumnModified(ClubPeer::DESCRIPTION)) $criteria->add(ClubPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ClubPeer::PHONE_NUMBER_1)) $criteria->add(ClubPeer::PHONE_NUMBER_1, $this->phone_number_1);
		if ($this->isColumnModified(ClubPeer::PHONE_NUMBER_2)) $criteria->add(ClubPeer::PHONE_NUMBER_2, $this->phone_number_2);
		if ($this->isColumnModified(ClubPeer::PHONE_NUMBER_3)) $criteria->add(ClubPeer::PHONE_NUMBER_3, $this->phone_number_3);
		if ($this->isColumnModified(ClubPeer::VISIT_COUNT)) $criteria->add(ClubPeer::VISIT_COUNT, $this->visit_count);
		if ($this->isColumnModified(ClubPeer::SMS_CREDIT)) $criteria->add(ClubPeer::SMS_CREDIT, $this->sms_credit);
		if ($this->isColumnModified(ClubPeer::ENABLED)) $criteria->add(ClubPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ClubPeer::VISIBLE)) $criteria->add(ClubPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(ClubPeer::DELETED)) $criteria->add(ClubPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(ClubPeer::LOCKED)) $criteria->add(ClubPeer::LOCKED, $this->locked);
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

		$copyObj->setTagName($this->tag_name);

		$copyObj->setFileNameLogo($this->file_name_logo);

		$copyObj->setAddressName($this->address_name);

		$copyObj->setAddressNumber($this->address_number);

		$copyObj->setAddressQuarter($this->address_quarter);

		$copyObj->setCityId($this->city_id);

		$copyObj->setMapsLink($this->maps_link);

		$copyObj->setLatitude($this->latitude);

		$copyObj->setLongitude($this->longitude);

		$copyObj->setClubSite($this->club_site);

		$copyObj->setDescription($this->description);

		$copyObj->setPhoneNumber1($this->phone_number_1);

		$copyObj->setPhoneNumber2($this->phone_number_2);

		$copyObj->setPhoneNumber3($this->phone_number_3);

		$copyObj->setVisitCount($this->visit_count);

		$copyObj->setSmsCredit($this->sms_credit);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventLiveList() as $relObj) {
				$copyObj->addEventLive($relObj->copy($deepCopy));
			}

			foreach($this->getUserAdminList() as $relObj) {
				$copyObj->addUserAdmin($relObj->copy($deepCopy));
			}

			foreach($this->getClubRankingLiveList() as $relObj) {
				$copyObj->addClubRankingLive($relObj->copy($deepCopy));
			}

			foreach($this->getClubPhotoList() as $relObj) {
				$copyObj->addClubPhoto($relObj->copy($deepCopy));
			}

			foreach($this->getClubSettingsList() as $relObj) {
				$copyObj->addClubSettings($relObj->copy($deepCopy));
			}

			foreach($this->getSmsList() as $relObj) {
				$copyObj->addSms($relObj->copy($deepCopy));
			}

			foreach($this->getCashTableList() as $relObj) {
				$copyObj->addCashTable($relObj->copy($deepCopy));
			}

			foreach($this->getEmailTemplateList() as $relObj) {
				$copyObj->addEmailTemplate($relObj->copy($deepCopy));
			}

			foreach($this->getEmailMarketingList() as $relObj) {
				$copyObj->addEmailMarketing($relObj->copy($deepCopy));
			}

			foreach($this->getClubPlayerList() as $relObj) {
				$copyObj->addClubPlayer($relObj->copy($deepCopy));
			}

			foreach($this->getClubCheckList() as $relObj) {
				$copyObj->addClubCheck($relObj->copy($deepCopy));
			}

			foreach($this->getEventLiveViewList() as $relObj) {
				$copyObj->addEventLiveView($relObj->copy($deepCopy));
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


	
	public function getEventLiveListJoinEmailTemplate($criteria = null, $con = null)
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

				$this->collEventLiveList = EventLivePeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLivePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEventLiveCriteria) || !$this->lastEventLiveCriteria->equals($criteria)) {
				$this->collEventLiveList = EventLivePeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		}
		$this->lastEventLiveCriteria = $criteria;

		return $this->collEventLiveList;
	}

	
	public function initUserAdminList()
	{
		if ($this->collUserAdminList === null) {
			$this->collUserAdminList = array();
		}
	}

	
	public function getUserAdminList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAdminList === null) {
			if ($this->isNew()) {
			   $this->collUserAdminList = array();
			} else {

				$criteria->add(UserAdminPeer::CLUB_ID, $this->getId());

				UserAdminPeer::addSelectColumns($criteria);
				$this->collUserAdminList = UserAdminPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserAdminPeer::CLUB_ID, $this->getId());

				UserAdminPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserAdminCriteria) || !$this->lastUserAdminCriteria->equals($criteria)) {
					$this->collUserAdminList = UserAdminPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserAdminCriteria = $criteria;
		return $this->collUserAdminList;
	}

	
	public function countUserAdminList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserAdminPeer::CLUB_ID, $this->getId());

		return UserAdminPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserAdmin(UserAdmin $l)
	{
		$this->collUserAdminList[] = $l;
		$l->setClub($this);
	}


	
	public function getUserAdminListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAdminList === null) {
			if ($this->isNew()) {
				$this->collUserAdminList = array();
			} else {

				$criteria->add(UserAdminPeer::CLUB_ID, $this->getId());

				$this->collUserAdminList = UserAdminPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(UserAdminPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastUserAdminCriteria) || !$this->lastUserAdminCriteria->equals($criteria)) {
				$this->collUserAdminList = UserAdminPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastUserAdminCriteria = $criteria;

		return $this->collUserAdminList;
	}

	
	public function initClubRankingLiveList()
	{
		if ($this->collClubRankingLiveList === null) {
			$this->collClubRankingLiveList = array();
		}
	}

	
	public function getClubRankingLiveList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubRankingLiveList === null) {
			if ($this->isNew()) {
			   $this->collClubRankingLiveList = array();
			} else {

				$criteria->add(ClubRankingLivePeer::CLUB_ID, $this->getId());

				ClubRankingLivePeer::addSelectColumns($criteria);
				$this->collClubRankingLiveList = ClubRankingLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubRankingLivePeer::CLUB_ID, $this->getId());

				ClubRankingLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastClubRankingLiveCriteria) || !$this->lastClubRankingLiveCriteria->equals($criteria)) {
					$this->collClubRankingLiveList = ClubRankingLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubRankingLiveCriteria = $criteria;
		return $this->collClubRankingLiveList;
	}

	
	public function countClubRankingLiveList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClubRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubRankingLivePeer::CLUB_ID, $this->getId());

		return ClubRankingLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubRankingLive(ClubRankingLive $l)
	{
		$this->collClubRankingLiveList[] = $l;
		$l->setClub($this);
	}


	
	public function getClubRankingLiveListJoinRankingLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubRankingLiveList === null) {
			if ($this->isNew()) {
				$this->collClubRankingLiveList = array();
			} else {

				$criteria->add(ClubRankingLivePeer::CLUB_ID, $this->getId());

				$this->collClubRankingLiveList = ClubRankingLivePeer::doSelectJoinRankingLive($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubRankingLivePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubRankingLiveCriteria) || !$this->lastClubRankingLiveCriteria->equals($criteria)) {
				$this->collClubRankingLiveList = ClubRankingLivePeer::doSelectJoinRankingLive($criteria, $con);
			}
		}
		$this->lastClubRankingLiveCriteria = $criteria;

		return $this->collClubRankingLiveList;
	}

	
	public function initClubPhotoList()
	{
		if ($this->collClubPhotoList === null) {
			$this->collClubPhotoList = array();
		}
	}

	
	public function getClubPhotoList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubPhotoList === null) {
			if ($this->isNew()) {
			   $this->collClubPhotoList = array();
			} else {

				$criteria->add(ClubPhotoPeer::CLUB_ID, $this->getId());

				ClubPhotoPeer::addSelectColumns($criteria);
				$this->collClubPhotoList = ClubPhotoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubPhotoPeer::CLUB_ID, $this->getId());

				ClubPhotoPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubPhotoCriteria) || !$this->lastClubPhotoCriteria->equals($criteria)) {
					$this->collClubPhotoList = ClubPhotoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubPhotoCriteria = $criteria;
		return $this->collClubPhotoList;
	}

	
	public function countClubPhotoList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClubPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubPhotoPeer::CLUB_ID, $this->getId());

		return ClubPhotoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubPhoto(ClubPhoto $l)
	{
		$this->collClubPhotoList[] = $l;
		$l->setClub($this);
	}


	
	public function getClubPhotoListJoinFile($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubPhotoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubPhotoList === null) {
			if ($this->isNew()) {
				$this->collClubPhotoList = array();
			} else {

				$criteria->add(ClubPhotoPeer::CLUB_ID, $this->getId());

				$this->collClubPhotoList = ClubPhotoPeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubPhotoPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubPhotoCriteria) || !$this->lastClubPhotoCriteria->equals($criteria)) {
				$this->collClubPhotoList = ClubPhotoPeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastClubPhotoCriteria = $criteria;

		return $this->collClubPhotoList;
	}

	
	public function initClubSettingsList()
	{
		if ($this->collClubSettingsList === null) {
			$this->collClubSettingsList = array();
		}
	}

	
	public function getClubSettingsList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubSettingsList === null) {
			if ($this->isNew()) {
			   $this->collClubSettingsList = array();
			} else {

				$criteria->add(ClubSettingsPeer::CLUB_ID, $this->getId());

				ClubSettingsPeer::addSelectColumns($criteria);
				$this->collClubSettingsList = ClubSettingsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubSettingsPeer::CLUB_ID, $this->getId());

				ClubSettingsPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubSettingsCriteria) || !$this->lastClubSettingsCriteria->equals($criteria)) {
					$this->collClubSettingsList = ClubSettingsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubSettingsCriteria = $criteria;
		return $this->collClubSettingsList;
	}

	
	public function countClubSettingsList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClubSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubSettingsPeer::CLUB_ID, $this->getId());

		return ClubSettingsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubSettings(ClubSettings $l)
	{
		$this->collClubSettingsList[] = $l;
		$l->setClub($this);
	}


	
	public function getClubSettingsListJoinSettings($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubSettingsList === null) {
			if ($this->isNew()) {
				$this->collClubSettingsList = array();
			} else {

				$criteria->add(ClubSettingsPeer::CLUB_ID, $this->getId());

				$this->collClubSettingsList = ClubSettingsPeer::doSelectJoinSettings($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubSettingsPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubSettingsCriteria) || !$this->lastClubSettingsCriteria->equals($criteria)) {
				$this->collClubSettingsList = ClubSettingsPeer::doSelectJoinSettings($criteria, $con);
			}
		}
		$this->lastClubSettingsCriteria = $criteria;

		return $this->collClubSettingsList;
	}

	
	public function initSmsList()
	{
		if ($this->collSmsList === null) {
			$this->collSmsList = array();
		}
	}

	
	public function getSmsList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsList === null) {
			if ($this->isNew()) {
			   $this->collSmsList = array();
			} else {

				$criteria->add(SmsPeer::CLUB_ID, $this->getId());

				SmsPeer::addSelectColumns($criteria);
				$this->collSmsList = SmsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SmsPeer::CLUB_ID, $this->getId());

				SmsPeer::addSelectColumns($criteria);
				if (!isset($this->lastSmsCriteria) || !$this->lastSmsCriteria->equals($criteria)) {
					$this->collSmsList = SmsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSmsCriteria = $criteria;
		return $this->collSmsList;
	}

	
	public function countSmsList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SmsPeer::CLUB_ID, $this->getId());

		return SmsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSms(Sms $l)
	{
		$this->collSmsList[] = $l;
		$l->setClub($this);
	}


	
	public function getSmsListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsList === null) {
			if ($this->isNew()) {
				$this->collSmsList = array();
			} else {

				$criteria->add(SmsPeer::CLUB_ID, $this->getId());

				$this->collSmsList = SmsPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(SmsPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastSmsCriteria) || !$this->lastSmsCriteria->equals($criteria)) {
				$this->collSmsList = SmsPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastSmsCriteria = $criteria;

		return $this->collSmsList;
	}

	
	public function initCashTableList()
	{
		if ($this->collCashTableList === null) {
			$this->collCashTableList = array();
		}
	}

	
	public function getCashTableList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
			   $this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

				CashTablePeer::addSelectColumns($criteria);
				$this->collCashTableList = CashTablePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

				CashTablePeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
					$this->collCashTableList = CashTablePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTableCriteria = $criteria;
		return $this->collCashTableList;
	}

	
	public function countCashTableList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

		return CashTablePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTable(CashTable $l)
	{
		$this->collCashTableList[] = $l;
		$l->setClub($this);
	}


	
	public function getCashTableListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
	}


	
	public function getCashTableListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
	}


	
	public function getCashTableListJoinVirtualTableRelatedByGameTypeId($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinVirtualTableRelatedByGameTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinVirtualTableRelatedByGameTypeId($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
	}


	
	public function getCashTableListJoinVirtualTableRelatedByGameLimitId($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTableList === null) {
			if ($this->isNew()) {
				$this->collCashTableList = array();
			} else {

				$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

				$this->collCashTableList = CashTablePeer::doSelectJoinVirtualTableRelatedByGameLimitId($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastCashTableCriteria) || !$this->lastCashTableCriteria->equals($criteria)) {
				$this->collCashTableList = CashTablePeer::doSelectJoinVirtualTableRelatedByGameLimitId($criteria, $con);
			}
		}
		$this->lastCashTableCriteria = $criteria;

		return $this->collCashTableList;
	}

	
	public function initEmailTemplateList()
	{
		if ($this->collEmailTemplateList === null) {
			$this->collEmailTemplateList = array();
		}
	}

	
	public function getEmailTemplateList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateList === null) {
			if ($this->isNew()) {
			   $this->collEmailTemplateList = array();
			} else {

				$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

				EmailTemplatePeer::addSelectColumns($criteria);
				$this->collEmailTemplateList = EmailTemplatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

				EmailTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailTemplateCriteria) || !$this->lastEmailTemplateCriteria->equals($criteria)) {
					$this->collEmailTemplateList = EmailTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailTemplateCriteria = $criteria;
		return $this->collEmailTemplateList;
	}

	
	public function countEmailTemplateList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

		return EmailTemplatePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailTemplate(EmailTemplate $l)
	{
		$this->collEmailTemplateList[] = $l;
		$l->setClub($this);
	}


	
	public function getEmailTemplateListJoinFile($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateList === null) {
			if ($this->isNew()) {
				$this->collEmailTemplateList = array();
			} else {

				$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEmailTemplateCriteria) || !$this->lastEmailTemplateCriteria->equals($criteria)) {
				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastEmailTemplateCriteria = $criteria;

		return $this->collEmailTemplateList;
	}


	
	public function getEmailTemplateListJoinEmailTemplateRelatedByEmailTemplateId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEmailTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateList === null) {
			if ($this->isNew()) {
				$this->collEmailTemplateList = array();
			} else {

				$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinEmailTemplateRelatedByEmailTemplateId($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailTemplatePeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEmailTemplateCriteria) || !$this->lastEmailTemplateCriteria->equals($criteria)) {
				$this->collEmailTemplateList = EmailTemplatePeer::doSelectJoinEmailTemplateRelatedByEmailTemplateId($criteria, $con);
			}
		}
		$this->lastEmailTemplateCriteria = $criteria;

		return $this->collEmailTemplateList;
	}

	
	public function initEmailMarketingList()
	{
		if ($this->collEmailMarketingList === null) {
			$this->collEmailMarketingList = array();
		}
	}

	
	public function getEmailMarketingList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingList === null) {
			if ($this->isNew()) {
			   $this->collEmailMarketingList = array();
			} else {

				$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

				EmailMarketingPeer::addSelectColumns($criteria);
				$this->collEmailMarketingList = EmailMarketingPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

				EmailMarketingPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailMarketingCriteria) || !$this->lastEmailMarketingCriteria->equals($criteria)) {
					$this->collEmailMarketingList = EmailMarketingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailMarketingCriteria = $criteria;
		return $this->collEmailMarketingList;
	}

	
	public function countEmailMarketingList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

		return EmailMarketingPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEmailMarketing(EmailMarketing $l)
	{
		$this->collEmailMarketingList[] = $l;
		$l->setClub($this);
	}


	
	public function getEmailMarketingListJoinFile($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingList === null) {
			if ($this->isNew()) {
				$this->collEmailMarketingList = array();
			} else {

				$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEmailMarketingCriteria) || !$this->lastEmailMarketingCriteria->equals($criteria)) {
				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastEmailMarketingCriteria = $criteria;

		return $this->collEmailMarketingList;
	}


	
	public function getEmailMarketingListJoinEmailTemplate($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseEmailMarketingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailMarketingList === null) {
			if ($this->isNew()) {
				$this->collEmailMarketingList = array();
			} else {

				$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		} else {
									
			$criteria->add(EmailMarketingPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEmailMarketingCriteria) || !$this->lastEmailMarketingCriteria->equals($criteria)) {
				$this->collEmailMarketingList = EmailMarketingPeer::doSelectJoinEmailTemplate($criteria, $con);
			}
		}
		$this->lastEmailMarketingCriteria = $criteria;

		return $this->collEmailMarketingList;
	}

	
	public function initClubPlayerList()
	{
		if ($this->collClubPlayerList === null) {
			$this->collClubPlayerList = array();
		}
	}

	
	public function getClubPlayerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubPlayerList === null) {
			if ($this->isNew()) {
			   $this->collClubPlayerList = array();
			} else {

				$criteria->add(ClubPlayerPeer::CLUB_ID, $this->getId());

				ClubPlayerPeer::addSelectColumns($criteria);
				$this->collClubPlayerList = ClubPlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubPlayerPeer::CLUB_ID, $this->getId());

				ClubPlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubPlayerCriteria) || !$this->lastClubPlayerCriteria->equals($criteria)) {
					$this->collClubPlayerList = ClubPlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubPlayerCriteria = $criteria;
		return $this->collClubPlayerList;
	}

	
	public function countClubPlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClubPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubPlayerPeer::CLUB_ID, $this->getId());

		return ClubPlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubPlayer(ClubPlayer $l)
	{
		$this->collClubPlayerList[] = $l;
		$l->setClub($this);
	}


	
	public function getClubPlayerListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClubPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubPlayerList === null) {
			if ($this->isNew()) {
				$this->collClubPlayerList = array();
			} else {

				$criteria->add(ClubPlayerPeer::CLUB_ID, $this->getId());

				$this->collClubPlayerList = ClubPlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubPlayerPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubPlayerCriteria) || !$this->lastClubPlayerCriteria->equals($criteria)) {
				$this->collClubPlayerList = ClubPlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastClubPlayerCriteria = $criteria;

		return $this->collClubPlayerList;
	}

	
	public function initClubCheckList()
	{
		if ($this->collClubCheckList === null) {
			$this->collClubCheckList = array();
		}
	}

	
	public function getClubCheckList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
			   $this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

				ClubCheckPeer::addSelectColumns($criteria);
				$this->collClubCheckList = ClubCheckPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

				ClubCheckPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
					$this->collClubCheckList = ClubCheckPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubCheckCriteria = $criteria;
		return $this->collClubCheckList;
	}

	
	public function countClubCheckList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

		return ClubCheckPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubCheck(ClubCheck $l)
	{
		$this->collClubCheckList[] = $l;
		$l->setClub($this);
	}


	
	public function getClubCheckListJoinCashTable($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
				$this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

				$this->collClubCheckList = ClubCheckPeer::doSelectJoinCashTable($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
				$this->collClubCheckList = ClubCheckPeer::doSelectJoinCashTable($criteria, $con);
			}
		}
		$this->lastClubCheckCriteria = $criteria;

		return $this->collClubCheckList;
	}


	
	public function getClubCheckListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
				$this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

				$this->collClubCheckList = ClubCheckPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
				$this->collClubCheckList = ClubCheckPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastClubCheckCriteria = $criteria;

		return $this->collClubCheckList;
	}


	
	public function getClubCheckListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubCheckList === null) {
			if ($this->isNew()) {
				$this->collClubCheckList = array();
			} else {

				$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

				$this->collClubCheckList = ClubCheckPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubCheckPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastClubCheckCriteria) || !$this->lastClubCheckCriteria->equals($criteria)) {
				$this->collClubCheckList = ClubCheckPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastClubCheckCriteria = $criteria;

		return $this->collClubCheckList;
	}

	
	public function initEventLiveViewList()
	{
		if ($this->collEventLiveViewList === null) {
			$this->collEventLiveViewList = array();
		}
	}

	
	public function getEventLiveViewList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLiveViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveViewList === null) {
			if ($this->isNew()) {
			   $this->collEventLiveViewList = array();
			} else {

				$criteria->add(EventLiveViewPeer::CLUB_ID, $this->getId());

				EventLiveViewPeer::addSelectColumns($criteria);
				$this->collEventLiveViewList = EventLiveViewPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventLiveViewPeer::CLUB_ID, $this->getId());

				EventLiveViewPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventLiveViewCriteria) || !$this->lastEventLiveViewCriteria->equals($criteria)) {
					$this->collEventLiveViewList = EventLiveViewPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventLiveViewCriteria = $criteria;
		return $this->collEventLiveViewList;
	}

	
	public function countEventLiveViewList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventLiveViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventLiveViewPeer::CLUB_ID, $this->getId());

		return EventLiveViewPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventLiveView(EventLiveView $l)
	{
		$this->collEventLiveViewList[] = $l;
		$l->setClub($this);
	}


	
	public function getEventLiveViewListJoinRankingLive($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventLiveViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventLiveViewList === null) {
			if ($this->isNew()) {
				$this->collEventLiveViewList = array();
			} else {

				$criteria->add(EventLiveViewPeer::CLUB_ID, $this->getId());

				$this->collEventLiveViewList = EventLiveViewPeer::doSelectJoinRankingLive($criteria, $con);
			}
		} else {
									
			$criteria->add(EventLiveViewPeer::CLUB_ID, $this->getId());

			if (!isset($this->lastEventLiveViewCriteria) || !$this->lastEventLiveViewCriteria->equals($criteria)) {
				$this->collEventLiveViewList = EventLiveViewPeer::doSelectJoinRankingLive($criteria, $con);
			}
		}
		$this->lastEventLiveViewCriteria = $criteria;

		return $this->collEventLiveViewList;
	}

} 