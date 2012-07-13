<div id="windowLocker"></div>
<?php

	include_partial('home/component/commonBar', array('pathList'=>array('Pesquisa'=>$moduleName, $keyWord=>null)));

	$originalKeyWord = $keyWord;

	$keyWord = str_replace('  ', '', $keyWord);
	$keyWord = preg_replace('/ *- */', '-', $keyWord);
	$keyWord = preg_replace('/: */', ':', $keyWord);
	$keyWord = preg_replace('/buyin ?entre ?([0-9,\.]*) ?e ?([0-9,\.]*)/i', 'buyin:$1-$2', $keyWord);
	$keyWord = String::removeAccents($keyWord);
	$keyWord = strtolower($keyWord);
	$keyWordList = explode(' ', $keyWord);
	
	/**
	 * WhiteList do que pode ser pesquisado
	 * Aceita apenas
	 * a-z
	 * A-Z
	 * 0-9
	 * : ,.\/)(
	 */
	foreach($keyWordList as &$keyWord)
		$keyWord = preg_replace('/[^a-zA-Z0-9:\.,\/\\ \-)\(]/i', '_', $keyWord);
?>
	<div class="moduleIntro">
		Exibindo resultado para "<b><?php echo $originalKeyWord ?></b>".<br/>
	</div>
<?php	
	include_partial('search/include/eventLive', array('keyWordList'=>$keyWordList, 'originalKeyWord'=>$originalKeyWord));
	include_partial('search/include/event', array('keyWordList'=>$keyWordList, 'originalKeyWord'=>$originalKeyWord));
?>