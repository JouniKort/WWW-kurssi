function SendToDb(){
	text = $('input[type="text"]').val();
	$.ajax({
		method: "POST",
		url: "Insert.php",
		data: {NoteToBeAdded: text}
	}).done(function(){
		location.reload();
	});
	return false;
}

function RemoveFromDb(id){
	$.ajax({
		method: "GET",
		url: "DeleteRecord.php".
		data: {Note: id}
	});
}