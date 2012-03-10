var _currentContentItemIdActive = 1;
var _homeHighlightAmount        = 1;
var _homeHighlightInterval      = 7;

function setupHomeHighlight(amount){

	for(var i=2; i <= amount; i++){
		
		$('homeHighlight'+i).hide();
		$('contentItemText'+i).hide();
	}
	
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
	
	_homeHighlightInterval = 5;
	window.setTimeout('decraseHomeHighlightCountDown()', 1000);
}

function changeContentItem(contentItemId){
	
	_homeHighlightInterval = 5;
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