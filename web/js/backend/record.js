function removeTableRows(prefix, objectIdList){
	
	for(var i=0; i < objectIdList.length; i++){
		
		try{
			
			$(prefix+'Tbody').removeChild($(prefix+'IdRow-'+objectIdList[i]));
		}catch(error){
			
			hideDiv(prefix+'IdRow-'+objectIdList[i]);
		}
	}
	
	updatePaginatorRecords(prefix, objectIdList.length);
}

function updateMainRecordName(recordName, updateLastPath){
	
	$('mainRecordName').innerHTML = recordName;
	
	if( updateLastPath )
		updateLastPathName(recordName);
}

function updateLastPathName(recordName){
	
	$('lastPathName').innerHTML = recordName;
}