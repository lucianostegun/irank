var _homeHighlightAmount        = 1;
var _homeHighlightInterval      = 9;

function setupHomeHighlight(amount, activeItemIndex){

	for(var i=1; i <= amount; i++){
		
		if( i==activeItemIndex )
			continue;
		
		$('homeHighlight'+i).hide();
		$('contentItemText'+i).hide();
	}
	
	_currentContentItemIdActive = activeItemIndex;
	_homeHighlightAmount = amount;
	window.setTimeout('decraseHomeHighlightCountDown()', 1000);
}

function decraseHomeHighlightCountDown(){
	
	_homeHighlightInterval--;
	
	if( _homeHighlightInterval==0 )
		showNextHighlight();
	else
		window.setTimeout('decraseHomeHighlightCountDown()', 1000);
}

function showNextHighlight(){
	
	var contentItemId = _currentContentItemIdActive+1;
	
	if( contentItemId > _homeHighlightAmount )
		contentItemId = 1;
	
	toggleContentItem(contentItemId);
	
	_homeHighlightInterval = 9;
	window.setTimeout('decraseHomeHighlightCountDown()', 1000);
}

function changeContentItem(contentItemId){
	
	_homeHighlightInterval = 9;
	toggleContentItem(contentItemId);
}

function toggleContentItem(contentItemId){
	
	if( contentItemId==_currentContentItemIdActive )
		return;
	
	$('homeHighlight'+contentItemId).className               = 'contentItem active';
	$('homeHighlight'+_currentContentItemIdActive).className = 'contentItem';
		
	$('contentItemSelector'+_currentContentItemIdActive).className = '';
	$('contentItemSelector'+contentItemId).className       = 'active';
	
	$('homeHighlight'+_currentContentItemIdActive).hide();
	$('homeHighlight'+contentItemId).setStyle({opacity: 0.0});
	$('homeHighlight'+contentItemId).show();
	$('homeHighlight'+contentItemId).fade({ duration: 1.0, from: 0, to: 1 });

	$('contentItemText'+_currentContentItemIdActive).hide();
	$('contentItemText'+contentItemId).setStyle({opacity: 0.0});
	$('contentItemText'+contentItemId).show();
	$('contentItemText'+contentItemId).fade({ duration: 1.0, from: 0, to: 1 });
	
	_currentContentItemIdActive = contentItemId;
}