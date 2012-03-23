function updatePaginatorRecords(paginatorId, recordsLess){
	
	var records = $(paginatorId+'PaginatorRecords').innerHTML*1;
	records -= recordsLess;
	
	if( records==0 )
		$(paginatorId+'NoRecordsRow').removeClassName('hidden');

	$(paginatorId+'PaginatorRecords').innerHTML = records;
}