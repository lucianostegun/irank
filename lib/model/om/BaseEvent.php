<?php


abstract class BaseEvent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_id;


	
	protected $event_name;


	
	protected $event_place;


	
	protected $buyin;


	
	protected $paid_places;


	
	protected $event_date;


	
	protected $start_time;


	
	protected $comments;


	
	protected $sent_email;


	
	protected $invites;


	
	protected $players;


	
	protected $saved_result;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRanking;

	
	protected $collEventPlayerList;

	
	protected $lastEventPlayerCriteria = null;

	
	protected $collEventCommentList;

	
	protected $lastEventCommentCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRankingId()
	{

		return $this->ranking_id;
	}

	
	public function getEventName()
	{

		return $this->event_name;
	}

	
	public function getEventPlace()
	{

		return $this->event_place;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
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

	
	public function getStartTime($format = 'H:i:s')
	{

		if ($this->start_time === null || $this->start_time === '') {
			return null;
		} elseif (!is_int($this->start_time)) {
						$ts = strtotime($this->start_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_time] as date/time value: " . var_export($this->start_time, true));
			}
		} else {
			$ts = $this->start_time;
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

	
	public function getSentEmail()
	{

		return $this->sent_email;
	}

	
	public function getInvites()
	{

		return $this->invites;
	}

	
	public function getPlayers()
	{

		return $this->players;
	}

	
	public function getSavedResult()
	{

		return $this->saved_result;
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
			$this->modifiedColumns[] = EventPeer::ID;
		}

	} 
	
	public function setRankingId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id !== $v) {
			$this->ranking_id = $v;
			$this->modifiedColumns[] = EventPeer::RANKING_ID;
		}

		if ($this->aRanking !== null && $this->aRanking->getId() !== $v) {
			$this->aRanking = null;
		}

	} 
	
	public function setEventName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_name !== $v) {
			$this->event_name = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_NAME;
		}

	} 
	
	public function setEventPlace($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_place !== $v) {
			$this->event_place = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_PLACE;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventPeer::BUYIN;
		}

	} 
	
	public function setPaidPlaces($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->paid_places !== $v) {
			$this->paid_places = $v;
			$this->modifiedColumns[] = EventPeer::PAID_PLACES;
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
			$this->modifiedColumns[] = EventPeer::EVENT_DATE;
		}

	} 
	
	public function setStartTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_time !== $ts) {
			$this->start_time = $ts;
			$this->modifiedColumns[] = EventPeer::START_TIME;
		}

	} 
	
	public function setComments($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = EventPeer::COMMENTS;
		}

	} 
	
	public function setSentEmail($v)
	{

		if ($this->sent_email !== $v) {
			$this->sent_email = $v;
			$this->modifiedColumns[] = EventPeer::SENT_EMAIL;
		}

	} 
	
	public function setInvites($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->invites !== $v) {
			$this->invites = $v;
			$this->modifiedColumns[] = EventPeer::INVITES;
		}

	} 
	
	public function setPlayers($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->players !== $v) {
			$this->players = $v;
			$this->modifiedColumns[] = EventPeer::PLAYERS;
		}

	} 
	
	public function setSavedResult($v)
	{

		if ($this->saved_result !== $v) {
			$this->saved_result = $v;
			$this->modifiedColumns[] = EventPeer::SAVED_RESULT;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EventPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = EventPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = EventPeer::LOCKED;
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
			$this->modifiedColumns[] = EventPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ranking_id = $rs->getInt($startcol + 1);

			$this->event_name = $rs->getString($startcol + 2);

			$this->event_place = $rs->getString($startcol + 3);

			$this->buyin = $rs->getFloat($startcol + 4);

			$this->paid_places = $rs->getInt($startcol + 5);

			$this->event_date = $rs->getDate($startcol + 6, null);

			$this->start_time = $rs->getTime($startcol + 7, null);

			$this->comments = $rs->getString($startcol + 8);

			$this->sent_email = $rs->getBoolean($startcol + 9);

			$this->invites = $rs->getInt($startcol + 10);

			$this->players = $rs->getInt($startcol + 11);

			$this->saved_result = $rs->getBoolean($startcol + 12);

			$this->enabled = $rs->getBoolean($startcol + 13);

			$this->visible = $rs->getBoolean($startcol + 14);

			$this->deleted = $rs->getBoolean($startcol + 15);

			$this->locked = $rs->getBoolean($startcol + 16);

			$this->created_at = $rs->getTimestamp($startcol + 17, null);

			$this->updated_at = $rs->getTimestamp($startcol + 18, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Event object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPeer::DATABASE_NAME);
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


												
			if ($this->aRanking !== null) {
				if ($this->aRanking->isModified()) {
					$affectedRows += $this->aRanking->save($con);
				}
				$this->setRanking($this->aRanking);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEventPlayerList !== null) {
				foreach($this->collEventPlayerList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventCommentList !== null) {
				foreach($this->collEventCommentList as $referrerFK) {
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


												
			if ($this->aRanking !== null) {
				if (!$this->aRanking->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRanking->getValidationFailures());
				}
			}


			if (($retval = EventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventPlayerList !== null) {
					foreach($this->collEventPlayerList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventCommentList !== null) {
					foreach($this->collEventCommentList as $referrerFK) {
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
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRankingId();
				break;
			case 2:
				return $this->getEventName();
				break;
			case 3:
				return $this->getEventPlace();
				break;
			case 4:
				return $this->getBuyin();
				break;
			case 5:
				return $this->getPaidPlaces();
				break;
			case 6:
				return $this->getEventDate();
				break;
			case 7:
				return $this->getStartTime();
				break;
			case 8:
				return $this->getComments();
				break;
			case 9:
				return $this->getSentEmail();
				break;
			case 10:
				return $this->getInvites();
				break;
			case 11:
				return $this->getPlayers();
				break;
			case 12:
				return $this->getSavedResult();
				break;
			case 13:
				return $this->getEnabled();
				break;
			case 14:
				return $this->getVisible();
				break;
			case 15:
				return $this->getDeleted();
				break;
			case 16:
				return $this->getLocked();
				break;
			case 17:
				return $this->getCreatedAt();
				break;
			case 18:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getRankingId(),
			$keys[2]=>$this->getEventName(),
			$keys[3]=>$this->getEventPlace(),
			$keys[4]=>$this->getBuyin(),
			$keys[5]=>$this->getPaidPlaces(),
			$keys[6]=>$this->getEventDate(),
			$keys[7]=>$this->getStartTime(),
			$keys[8]=>$this->getComments(),
			$keys[9]=>$this->getSentEmail(),
			$keys[10]=>$this->getInvites(),
			$keys[11]=>$this->getPlayers(),
			$keys[12]=>$this->getSavedResult(),
			$keys[13]=>$this->getEnabled(),
			$keys[14]=>$this->getVisible(),
			$keys[15]=>$this->getDeleted(),
			$keys[16]=>$this->getLocked(),
			$keys[17]=>$this->getCreatedAt(),
			$keys[18]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRankingId($value);
				break;
			case 2:
				$this->setEventName($value);
				break;
			case 3:
				$this->setEventPlace($value);
				break;
			case 4:
				$this->setBuyin($value);
				break;
			case 5:
				$this->setPaidPlaces($value);
				break;
			case 6:
				$this->setEventDate($value);
				break;
			case 7:
				$this->setStartTime($value);
				break;
			case 8:
				$this->setComments($value);
				break;
			case 9:
				$this->setSentEmail($value);
				break;
			case 10:
				$this->setInvites($value);
				break;
			case 11:
				$this->setPlayers($value);
				break;
			case 12:
				$this->setSavedResult($value);
				break;
			case 13:
				$this->setEnabled($value);
				break;
			case 14:
				$this->setVisible($value);
				break;
			case 15:
				$this->setDeleted($value);
				break;
			case 16:
				$this->setLocked($value);
				break;
			case 17:
				$this->setCreatedAt($value);
				break;
			case 18:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEventName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventPlace($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBuyin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPaidPlaces($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEventDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStartTime($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setComments($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSentEmail($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInvites($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPlayers($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setSavedResult($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEnabled($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setVisible($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDeleted($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLocked($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCreatedAt($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setUpdatedAt($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPeer::ID)) $criteria->add(EventPeer::ID, $this->id);
		if ($this->isColumnModified(EventPeer::RANKING_ID)) $criteria->add(EventPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(EventPeer::EVENT_NAME)) $criteria->add(EventPeer::EVENT_NAME, $this->event_name);
		if ($this->isColumnModified(EventPeer::EVENT_PLACE)) $criteria->add(EventPeer::EVENT_PLACE, $this->event_place);
		if ($this->isColumnModified(EventPeer::BUYIN)) $criteria->add(EventPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventPeer::PAID_PLACES)) $criteria->add(EventPeer::PAID_PLACES, $this->paid_places);
		if ($this->isColumnModified(EventPeer::EVENT_DATE)) $criteria->add(EventPeer::EVENT_DATE, $this->event_date);
		if ($this->isColumnModified(EventPeer::START_TIME)) $criteria->add(EventPeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(EventPeer::COMMENTS)) $criteria->add(EventPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(EventPeer::SENT_EMAIL)) $criteria->add(EventPeer::SENT_EMAIL, $this->sent_email);
		if ($this->isColumnModified(EventPeer::INVITES)) $criteria->add(EventPeer::INVITES, $this->invites);
		if ($this->isColumnModified(EventPeer::PLAYERS)) $criteria->add(EventPeer::PLAYERS, $this->players);
		if ($this->isColumnModified(EventPeer::SAVED_RESULT)) $criteria->add(EventPeer::SAVED_RESULT, $this->saved_result);
		if ($this->isColumnModified(EventPeer::ENABLED)) $criteria->add(EventPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EventPeer::VISIBLE)) $criteria->add(EventPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(EventPeer::DELETED)) $criteria->add(EventPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventPeer::LOCKED)) $criteria->add(EventPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(EventPeer::CREATED_AT)) $criteria->add(EventPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventPeer::UPDATED_AT)) $criteria->add(EventPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		$criteria->add(EventPeer::ID, $this->id);

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

		$copyObj->setRankingId($this->ranking_id);

		$copyObj->setEventName($this->event_name);

		$copyObj->setEventPlace($this->event_place);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setPaidPlaces($this->paid_places);

		$copyObj->setEventDate($this->event_date);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setComments($this->comments);

		$copyObj->setSentEmail($this->sent_email);

		$copyObj->setInvites($this->invites);

		$copyObj->setPlayers($this->players);

		$copyObj->setSavedResult($this->saved_result);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEventPlayerList() as $relObj) {
				$copyObj->addEventPlayer($relObj->copy($deepCopy));
			}

			foreach($this->getEventCommentList() as $relObj) {
				$copyObj->addEventComment($relObj->copy($deepCopy));
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
			self::$peer = new EventPeer();
		}
		return self::$peer;
	}

	
	public function setRanking($v)
	{


		if ($v === null) {
			$this->setRankingId(NULL);
		} else {
			$this->setRankingId($v->getId());
		}


		$this->aRanking = $v;
	}


	
	public function getRanking($con = null)
	{
		if ($this->aRanking === null && ($this->ranking_id !== null)) {
						include_once 'lib/model/om/BaseRankingPeer.php';

			$this->aRanking = RankingPeer::retrieveByPK($this->ranking_id, $con);

			
		}
		return $this->aRanking;
	}

	
	public function initEventPlayerList()
	{
		if ($this->collEventPlayerList === null) {
			$this->collEventPlayerList = array();
		}
	}

	
	public function getEventPlayerList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPlayerList === null) {
			if ($this->isNew()) {
			   $this->collEventPlayerList = array();
			} else {

				$criteria->add(EventPlayerPeer::EVENT_ID, $this->getId());

				EventPlayerPeer::addSelectColumns($criteria);
				$this->collEventPlayerList = EventPlayerPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPlayerPeer::EVENT_ID, $this->getId());

				EventPlayerPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPlayerCriteria) || !$this->lastEventPlayerCriteria->equals($criteria)) {
					$this->collEventPlayerList = EventPlayerPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPlayerCriteria = $criteria;
		return $this->collEventPlayerList;
	}

	
	public function countEventPlayerList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPlayerPeer::EVENT_ID, $this->getId());

		return EventPlayerPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPlayer(EventPlayer $l)
	{
		$this->collEventPlayerList[] = $l;
		$l->setEvent($this);
	}


	
	public function getEventPlayerListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPlayerPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPlayerList === null) {
			if ($this->isNew()) {
				$this->collEventPlayerList = array();
			} else {

				$criteria->add(EventPlayerPeer::EVENT_ID, $this->getId());

				$this->collEventPlayerList = EventPlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPlayerPeer::EVENT_ID, $this->getId());

			if (!isset($this->lastEventPlayerCriteria) || !$this->lastEventPlayerCriteria->equals($criteria)) {
				$this->collEventPlayerList = EventPlayerPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventPlayerCriteria = $criteria;

		return $this->collEventPlayerList;
	}

	
	public function initEventCommentList()
	{
		if ($this->collEventCommentList === null) {
			$this->collEventCommentList = array();
		}
	}

	
	public function getEventCommentList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventCommentList === null) {
			if ($this->isNew()) {
			   $this->collEventCommentList = array();
			} else {

				$criteria->add(EventCommentPeer::EVENT_ID, $this->getId());

				EventCommentPeer::addSelectColumns($criteria);
				$this->collEventCommentList = EventCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventCommentPeer::EVENT_ID, $this->getId());

				EventCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventCommentCriteria) || !$this->lastEventCommentCriteria->equals($criteria)) {
					$this->collEventCommentList = EventCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventCommentCriteria = $criteria;
		return $this->collEventCommentList;
	}

	
	public function countEventCommentList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventCommentPeer::EVENT_ID, $this->getId());

		return EventCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventComment(EventComment $l)
	{
		$this->collEventCommentList[] = $l;
		$l->setEvent($this);
	}


	
	public function getEventCommentListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventCommentList === null) {
			if ($this->isNew()) {
				$this->collEventCommentList = array();
			} else {

				$criteria->add(EventCommentPeer::EVENT_ID, $this->getId());

				$this->collEventCommentList = EventCommentPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(EventCommentPeer::EVENT_ID, $this->getId());

			if (!isset($this->lastEventCommentCriteria) || !$this->lastEventCommentCriteria->equals($criteria)) {
				$this->collEventCommentList = EventCommentPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastEventCommentCriteria = $criteria;

		return $this->collEventCommentList;
	}

} 