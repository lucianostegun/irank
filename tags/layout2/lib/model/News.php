<?php

/**
 * Subclasse de representação de objetos da tabela 'news'.
 *
 * 
 *
 * @package lib.model
 */ 
class News extends BaseNews
{
	
	public static function getLastNews($limit=null){
		
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn( NewsPeer::NEWS_DATE );
		$criteria->setLimit($limit);
		return NewsPeer::doSelect($criteria);
	}
	
	public function getNewsTitle($culture=null){
		
		$this->setCulture(($culture?$culture:MyTools::getCulture()));
		return $this->getNewsTitleI18n();
	}
	
	public function getDescription($culture=null){
		
		$this->setCulture(($culture?$culture:MyTools::getCulture()));
		return $this->getDescriptionI18n();
	}
}
