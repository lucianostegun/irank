<?php


abstract class BaseEventPersonal extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_site_id;


	
	protected $game_style_id;


	
	protected $event_name;


	
	protected $event_place;


	
	protected $event_position;


	
	protected $buyin;


	
	protected $rebuy;


	
	protected $addon;


	
	protected $prize;


	
	protected $paid_places;


	
	protected $event_date;


	
	protected $comments;


	
	protected $players;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUserSite;

	
	protected $aVirtualTable;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserSiteId()
	{

		return $this->user_site_id;
	}

	
	public function getGameStyleId()
	{

		return $this->game_style_id;
	}

	
	public function getEventName()
	{

		return $this->event_name;
	}

	
	public function getEventPlace()
	{

		return $this->event_place;
	}

	
	public function getEventPosition()
	{

		return $this->event_position;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getRebuy()
	{

		return $this->rebuy;
	}

	
	public function getAddon()
	{

		return $this->addon;
	}

	
	public function getPrize()
	{

		return $this->prize;
	}

	
	public function getPaidPlaces()
	{

		return $this->paid_places;
	}

	
	public function getEventDate($format = 'Y-m-d')
	{

		if ($this->event_date === null || $this->event_date === '') {
			return null;
		} elseif (!is_int($this->event_date)) {
						$ts = strtotime($this->event_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [event_date] as date/time value: " . var_export($this->event_date, true));
			}
		} else {
			$ts = $this->event_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getPlayers()
	{

		return $this->players;
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
			$this->modifiedColumns[] = EventPersonalPeer::ID;
		}

	} 
	
	public function setUserSiteId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = EventPersonalPeer::USER_SITE_ID;
		}

		if ($this->aUserSite !== null && $this->aUserSite->getId() !== $v) {
			$this->aUserSite = null;
		}

	} 
	
	public function setGameStyleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_style_id !== $v) {
			$this->game_style_id = $v;
			$this->modifiedColumns[] = EventPersonalPeer::GAME_STYLE_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setEventName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_name !== $v) {
			$this->event_name = $v;
			$this->modifiedColumns[] = EventPersonalPeer::EVENT_NAME;
		}

	} 
	
	public function setEventPlace($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_place !== $v) {
			$this->event_place = $v;
			$this->modifiedColumns[] = EventPersonalPeer::EVENT_PLACE;
		}

	} 
	
	public function setEventPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_position !== $v) {
			$this->event_position = $v;
			$this->modifiedColumns[] = EventPersonalPeer::EVENT_POSITION;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventPersonalPeer::BUYIN;
		}

	} 
	
	public function setRebuy($v)
	{

		if ($this->rebuy !== $v) {
			$this->rebuy = $v;
			$this->modifiedColumns[] = EventPersonalPeer::REBUY;
		}

	} 
	
	public function setAddon($v)
	{

		if ($this->addon !== $v) {
			$this->addon = $v;
			$this->modifiedColumns[] = EventPersonalPeer::ADDON;
		}

	} 
	
	public function setPrize($v)
	{

		if ($this->prize !== $v) {
			$this->prize = $v;
			$this->modifiedColumns[] = EventPersonalPeer::PRIZE;
		}

	} 
	
	public function setPaidPlaces($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->paid_places !== $v) {
			$this->paid_places = $v;
			$this->modifiedColumns[] = EventPersonalPeer::PAID_PLACES;
		}

	} 
	
	public function setEventDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [event_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_date !== $ts) {
			$this->event_date = $ts;
			$this->modifiedColumns[] = EventPersonalPeer::EVENT_DATE;
		}

	} 
	
	public function setComments($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = EventPersonalPeer::COMMENTS;
		}

	} 
	
	public function setPlayers($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->players !== $v) {
			$this->players = $v;
			$this->modifiedColumns[] = EventPersonalPeer::PLAYERS;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EventPersonalPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = EventPersonalPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventPersonalPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = EventPersonalPeer::LOCKED;
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
			$this->modifiedColumns[] = EventPersonalPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventPersonalPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_site_id = $rs->getInt($startcol + 1);

			$this->game_style_id = $rs->getInt($startcol + 2);

			$this->event_name = $rs->getString($startcol + 3);

			$this->event_place = $rs->getString($startcol + 4);

			$this->event_position = $rs->getInt($startcol + 5);

			$this->buyin = $rs->getFloat($startcol + 6);

			$this->rebuy = $rs->getFloat($startcol + 7);

			$this->addon = $rs->getFloat($startcol + 8);

			$this->prize = $rs->getFloat($startcol + 9);

			$this->paid_places = $rs->getInt($startcol + 10);

			$this->event_date = $rs->getDate($startcol + 11, null);

			$this->comments = $rs->getString($startcol + 12);

			$this->players = $rs->getInt($startcol + 13);

			$this->enabled = $rs->getBoolean($startcol + 14);

			$this->visible = $rs->getBoolean($startcol + 15);

			$this->deleted = $rs->getBoolean($startcol + 16);

			$this->locked = $rs->getBoolean($startcol + 17);

			$this->created_at = $rs->getTimestamp($startcol + 18, null);

			$this->updated_at = $rs->getTimestamp($startcol + 19, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 20; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventPersonal object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPersonalPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPersonalPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventPersonalPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventPersonalPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPersonalPeer::DATABASE_NAME);
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


												
			if ($this->aUserSite !== null) {
				if ($this->aUserSite->isModified()) {
					$affectedRows += $this->aUserSite->save($con);
				}
				$this->setUserSite($this->aUserSite);
			}

			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified() || $this->aVirtualTable->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventPersonalPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventPersonalPeer::doUpdate($this, $con);
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

			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}


			if (($retval = EventPersonalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPersonalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserSiteId();
				break;
			case 2:
				return $this->getGameStyleId();
				break;
			case 3:
				return $this->getEventName();
				break;
			case 4:
				return $this->getEventPlace();
				break;
			case 5:
				return $this->getEventPosition();
				break;
			case 6:
				return $this->getBuyin();
				break;
			case 7:
				return $this->getRebuy();
				break;
			case 8:
				return $this->getAddon();
				break;
			case 9:
				return $this->getPrize();
				break;
			case 10:
				return $this->getPaidPlaces();
				break;
			case 11:
				return $this->getEventDate();
				break;
			case 12:
				return $this->getComments();
				break;
			case 13:
				return $this->getPlayers();
				break;
			case 14:
				return $this->getEnabled();
				break;
			case 15:
				return $this->getVisible();
				break;
			case 16:
				return $this->getDeleted();
				break;
			case 17:
				return $this->getLocked();
				break;
			case 18:
				return $this->getCreatedAt();
				break;
			case 19:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPersonalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getUserSiteId(),
			$keys[2]=>$this->getGameStyleId(),
			$keys[3]=>$this->getEventName(),
			$keys[4]=>$this->getEventPlace(),
			$keys[5]=>$this->getEventPosition(),
			$keys[6]=>$this->getBuyin(),
			$keys[7]=>$this->getRebuy(),
			$keys[8]=>$this->getAddon(),
			$keys[9]=>$this->getPrize(),
			$keys[10]=>$this->getPaidPlaces(),
			$keys[11]=>$this->getEventDate(),
			$keys[12]=>$this->getComments(),
			$keys[13]=>$this->getPlayers(),
			$keys[14]=>$this->getEnabled(),
			$keys[15]=>$this->getVisible(),
			$keys[16]=>$this->getDeleted(),
			$keys[17]=>$this->getLocked(),
			$keys[18]=>$this->getCreatedAt(),
			$keys[19]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPersonalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserSiteId($value);
				break;
			case 2:
				$this->setGameStyleId($value);
				break;
			case 3:
				$this->setEventName($value);
				break;
			case 4:
				$this->setEventPlace($value);
				break;
			case 5:
				$this->setEventPosition($value);
				break;
			case 6:
				$this->setBuyin($value);
				break;
			case 7:
				$this->setRebuy($value);
				break;
			case 8:
				$this->setAddon($value);
				break;
			case 9:
				$this->setPrize($value);
				break;
			case 10:
				$this->setPaidPlaces($value);
				break;
			case 11:
				$this->setEventDate($value);
				break;
			case 12:
				$this->setComments($value);
				break;
			case 13:
				$this->setPlayers($value);
				break;
			case 14:
				$this->setEnabled($value);
				break;
			case 15:
				$this->setVisible($value);
				break;
			case 16:
				$this->setDeleted($value);
				break;
			case 17:
				$this->setLocked($value);
				break;
			case 18:
				$this->setCreatedAt($value);
				break;
			case 19:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPersonalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserSiteId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGameStyleId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEventPlace($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEventPosition($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBuyin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRebuy($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAddon($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPrize($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPaidPlaces($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEventDate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setComments($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPlayers($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setEnabled($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setVisible($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setDeleted($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setLocked($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCreatedAt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUpdatedAt($arr[$keys[19]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPersonalPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPersonalPeer::ID)) $criteria->add(EventPersonalPeer::ID, $this->id);
		if ($this->isColumnModified(EventPersonalPeer::USER_SITE_ID)) $criteria->add(EventPersonalPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(EventPersonalPeer::GAME_STYLE_ID)) $criteria->add(EventPersonalPeer::GAME_STYLE_ID, $this->game_style_id);
		if ($this->isColumnModified(EventPersonalPeer::EVENT_NAME)) $criteria->add(EventPersonalPeer::EVENT_NAME, $this->event_name);
		if ($this->isColumnModified(EventPersonalPeer::EVENT_PLACE)) $criteria->add(EventPersonalPeer::EVENT_PLACE, $this->event_place);
		if ($this->isColumnModified(EventPersonalPeer::EVENT_POSITION)) $criteria->add(EventPersonalPeer::EVENT_POSITION, $this->event_position);
		if ($this->isColumnModified(EventPersonalPeer::BUYIN)) $criteria->add(EventPersonalPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventPersonalPeer::REBUY)) $criteria->add(EventPersonalPeer::REBUY, $this->rebuy);
		if ($this->isColumnModified(EventPersonalPeer::ADDON)) $criteria->add(EventPersonalPeer::ADDON, $this->addon);
		if ($this->isColumnModified(EventPersonalPeer::PRIZE)) $criteria->add(EventPersonalPeer::PRIZE, $this->prize);
		if ($this->isColumnModified(EventPersonalPeer::PAID_PLACES)) $criteria->add(EventPersonalPeer::PAID_PLACES, $this->paid_places);
		if ($this->isColumnModified(EventPersonalPeer::EVENT_DATE)) $criteria->add(EventPersonalPeer::EVENT_DATE, $this->event_date);
		if ($this->isColumnModified(EventPersonalPeer::COMMENTS)) $criteria->add(EventPersonalPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(EventPersonalPeer::PLAYERS)) $criteria->add(EventPersonalPeer::PLAYERS, $this->players);
		if ($this->isColumnModified(EventPersonalPeer::ENABLED)) $criteria->add(EventPersonalPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EventPersonalPeer::VISIBLE)) $criteria->add(EventPersonalPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(EventPersonalPeer::DELETED)) $criteria->add(EventPersonalPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventPersonalPeer::LOCKED)) $criteria->add(EventPersonalPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(EventPersonalPeer::CREATED_AT)) $criteria->add(EventPersonalPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventPersonalPeer::UPDATED_AT)) $criteria->add(EventPersonalPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPersonalPeer::DATABASE_NAME);

		$criteria->add(EventPersonalPeer::ID, $this->id);

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

		$copyObj->setUserSiteId($this->user_site_id);

		$copyObj->setGameStyleId($this->game_style_id);

		$copyObj->setEventName($this->event_name);

		$copyObj->setEventPlace($this->event_place);

		$copyObj->setEventPosition($this->event_position);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setRebuy($this->rebuy);

		$copyObj->setAddon($this->addon);

		$copyObj->setPrize($this->prize);

		$copyObj->setPaidPlaces($this->paid_places);

		$copyObj->setEventDate($this->event_date);

		$copyObj->setComments($this->comments);

		$copyObj->setPlayers($this->players);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new EventPersonalPeer();
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

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setGameStyleId(NULL);
		} else {
			$this->setGameStyleId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->game_style_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->game_style_id, $con);

			
		}
		return $this->aVirtualTable;
	}

} 