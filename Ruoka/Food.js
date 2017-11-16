var indexIngredient = 1;
var indexStep = 1;
var sub = 1;

//Adding an element to the form causes the form to refresh -> the element is removed
//Using custom function on "onsubmission", switching the submission off while adding the element -> no refreshing -> element stays
//sub-- turns the submission off and sub++ turns it on
function validateSubmission(){
	if(!sub){
		return false;
	}
	//Filling the empty li:s
	var formElem = document.getElementById('EntryForm').elements;

	for(var i = 0, element; element = formElem[i++];){
		if(element.type === 'text' && element.value === ""){
			element.innerHTML = "&nbsp;";
		}
	}

	return true;
};

function newStep(){
	sub--;
	$('#newStepList').append('<li class="newEntryIngredient"><input type="text" name="Step[]"></li>');
	setTimeout(function(){
		sub++;
	},100);
};

function newIngredient(){
	sub--;
	$('#newAmount').append('<li class="newEntryIngredient"><input type="text" name="Amount[]"></li>');
	$('#newItem').append('<li class="newEntryIngredient"><input type="text" name="Item[]"></li>');
	setTimeout(function(){
		sub++;
	},100);
};

function deleteIngredient(){
	sub--;
	if(indexIngredient>0){
		$('#newAmount li:last').remove();
		$('#newItem li:last').remove();
		indexIngredient--;		
	}
	setTimeout(function(){
		sub++;
	},100);
};

function deleteStep(){
	sub--;
	if(indexStep>0){
		$('#newStepList li:last').remove();
		indexStep--;		
	}
	setTimeout(function(){
		sub++;
	},100);
};