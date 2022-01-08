<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_import_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingImportLog extends BaseRankingImportLog
{
	
	public static function check($rankingId, $rankingIdFrom, $importTable, $objectId){
		
		$sql = "SELECT
					COUNT(1)
				FROM
					ranking_import_log
				WHERE
					((ranking_id = $rankingId AND ranking_id_from = $rankingIdFrom)
					OR (ranking_id = $rankingIdFrom AND ranking_id_from = $rankingId))
					AND import_table = '$importTable'
					AND object_id = $objectId";
					
		return (Util::executeOne($sql, 'int', null, 'log')==0);
	}

	public static function doLog($rankingId, $rankingIdFrom, $importTable, $objectId){

		$rankingImportLogObj = new RankingImportLog();
		$rankingImportLogObj->setRankingId($rankingId);
		$rankingImportLogObj->setRankingIdFrom($rankingIdFrom);
		$rankingImportLogObj->setImportTable($importTable);
		$rankingImportLogObj->setObjectId($objectId);
		$rankingImportLogObj->save();
	}
}
