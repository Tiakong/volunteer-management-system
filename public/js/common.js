
function SubmitForm()
{
	document.submitForm.submit();
}

SendRequest.isProcessing = false; //To prevent sending excessive request to the server when user inputs value. (Some trigger this once everytime the value in the input change)

//Usage: Send request to the server and retrieve whatever the server returns
async function SendRequest(url, data, condition, callback, ...args)
{
	console.log(data);
	if(!SendRequest.isProcessing && !!data && condition){
		SendRequest.isProcessing = true;
		//Send request to the server and retrieve the query result
		var output = await $.ajax({
			type: "POST",
			url: url,
			data: data,
			headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(r) {	
				return callback(r, args);
			}
		});
		SendRequest.isProcessing = false;
		return output;
	}
}


//Usage: Display the volunteer name lists after perform searching.
function DisplayVolunteerNameList(list, args)
{
	var table = $("#volunteerNameList").get(0);
	table.hidden = false;
	$("#volunteerNameList tr").remove(); 
	input = args[0]
	//no result
	if(list.length == 0)
	{
		var tr = document.createElement('tr');
		var td = document.createElement('td');
		var p = document.createElement('p');
		p.appendChild(document.createTextNode('Sorry, no matching result.'));
		td.appendChild(p);
		tr.appendChild(td);
		table.appendChild(tr);
		return;
	}
	var tr;
	var td;
	const col_per_row = 4;
	for(var row=0; row<list.length/col_per_row; row++)
	{
		tr = document.createElement("tr");
		for(var i=0; i<col_per_row && list[row * col_per_row + i]; i++)
		{
			//Do not change to var
			const n = row * col_per_row + i;
			td = document.createElement('td');
			td.appendChild(document.createTextNode(list[n]['name']));
			td.onclick = function(){
				input.value = this.innerHTML;
				$("#volunteerNameList tr").remove();
				table.hidden = true;
				if(args[1]) args[1](list[n]);
			};
			tr.appendChild(td);
		}
		table.appendChild(tr);
	}
}



//Usage: To display the queried result in data export.
function DisplayDataExportResult(result, args)
{
	console.log(result);
	if(result['status'] == 'success')
		args[0].innerHTML = result['html'];
	else
		alert('Please fill in the input ');
}


function SendNotification(url, type, title, description, target=null, for_volunteer=1, for_admin=1)
{
	data = {
		'type' 			: type,
		'title' 		: title,
		'description' 	: description,
		'target'		: target,
		'is_auto' 		: 1,
		'for_volunteer'	: for_volunteer,
		'for_admin'		: for_admin
	}
	SendRequest(
		url,
		data,
		true,
		(r)=>{console.log(r);}
	);
}

function ConfirmDelete( url, message = "Are you sure you want to delete?\nYou cannot undo this step!")
{
	if(confirm(message)) 
		window.location.replace(url);
}


function InsertLink(btn)
{
	var urlLink = $('input[name="url-link"]').get(0).value;
	var urlTitle = $('input[name="url-title"]').get(0).value;
	var description = $('textarea[name="description"]').get(0);
	var preview_link = $('#preview-link').get(0);
	description.value += '<a href="'+urlLink+'" target="_blank">' + urlTitle + '</a>';
	
	preview_link.href = urlLink;
	preview_link.innerHTML = urlTitle;
}
