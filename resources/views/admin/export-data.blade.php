<?php
use App\Common;
?>
@extends('admin.master', ['title'=>"Data Export"])

@section('content')

<div class='col-sm-12'>
	<br/>
	@include('common.show-error')
	<br/>
	<div class='card col-sm-12 text-right' style='margin:4px;'>
		<div id='guildance' title='To guild you what field is required' style='margin:2px'>
			<div class='card-body row'>
				{!! Form::label('preset', 'Guidance', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class="col-sm-9">
					{!! Form::select('category', Common::$DataExportGuidance, null, [
						'id'	=> 'input_guild',
						'class' => 'form-control form-control-lg',
						'onchange' => 'setRequiredField()',
						'placeholder' => '- None -',
					]) !!}
				</div>
			</div>
		</div>
		<div id='programmeName' hidden title='Showing volunteers that interested in this programme' style='margin:2px'>
			<div class='card-body row'>
				{!! Form::label('programme-name', 'Programme', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class="col-sm-9">
					{!! Form::select('programme-title', Common::GetProgrammes(), null, [
						'id'	=> 'programme_code',
						'class' => 'form-control dynamic form-control-lg',
						'placeholder' => '- ',
					]) !!}
				</div>
			</div>
		</div>
		<div id='eventName'  hidden title='Showing volunteer that enrolled for this event'  style='margin:2px'>
			<div class='card-body row'>
				{!! Form::label('event-name', 'Event', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class="col-sm-9">
					<select id='event_title' class='form-control form-control-lg' name='event_tite'>
						<option selected="selected" value=""> - </option>
					</select>
				</div>
			</div>
		</div>
		<div id="date" hidden style='margin:2px;'>
			<div class="card-body row">
				{!! Form::label('date-from', 'From', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class='col-sm-9'>
					<input type="date" id='date_from' value='<?php echo date('Y')."-01-01"?>' class='form-control dynamic' name='date' style='width:100%' />
				</div>
			</div>
			<div class="card-body row">
				{!! Form::label('date-to', 'To', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class='col-sm-9'>
					<input type="date" id='date_to' value='<?php echo date('Y')."-12-31"?>' onchange='console.log(this.value)' class='form-control dynamic' name='date' style='width:100%' />
				</div>
			</div>
		</div>
		<div style='margin:2px'>
			<div hidden id="volunteerName">
				<div title='If not specify, all volunteers are selected' class='card-body row'>
					{!! Form::label('volunteer-name', 'Volunteer Name', [
						'class' => 'control-label col-sm-3 p-2',
					]) !!}
					<div class='col-sm-9'>
						<input id="volunteer_name" type="text" name='volunteerName' class='form-control' style='width:100%;' placeholder="Enter at least 3 characters"/>
					</div>
				</div>
			</div>
			@include('common.volunteer-name-list')
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button onclick='ExportData()' class='btn btn-lg btn-block btn-primary'>Export</button>
			<button onclick='Preview()' class='btn btn-lg btn-block btn-primary'>Preview</button>
		</div>
	</div>
	<div>
		<table id='previewTable' class='table table-border table-hovered table-stripped'>
		</table>
	</div>
</div>

<script>
	var input_vname = document.getElementById("volunteer_name");
	input_vname.oninput = function(){
		SendRequest(
			"<?php echo route('query.searchVolByName') ?>",
			{'name':input_vname.value.trim()}, //data
			input_vname.value.trim().length>=3, //condition to send request
			DisplayVolunteerNameList, //callback function
			input_vname //arguments for callback function
		)
	};
	
	$('.dynamic').change( function(){
		var code = document.getElementById('programme_code').value;
		var date_from = document.getElementById('date_from').value;
		var date_to = document.getElementById('date_to').value;
		if(code)
		{
			SendRequest(
				'<?php echo route('query.get-events') ?>',
				{
					'code':code, 
					'date_from':date_from,
					'date_to':date_to
				},
				!(date_from.charAt(0)==0 || date_to.charAt(0)==0),
				updateEventOption
			);
		}
		else
		{
			var select = document.getElementById('event_title');
			select.innerHTML = '<option selected="selected" value=""> - </option>';
		}
	});
	
	function updateEventOption(events){
		var select = document.getElementById('event_title');
		if(events.length>0)
		{
			select.innerHTML = '<option selected="selected" value=""> - </option>';
			events.forEach(e=>{
				select.innerHTML += '<option value='+e['eid']+'>'+e['name']+'</option>'
			});
		}
		else
		{
			select.innerHTML = '<option selected="selected" value=""> No matching result </option>';
		}
	}


function setRequiredField()
{
	SendRequest(
		"<?php echo route('query.export-data-guidance'); ?>",
		{'index':document.getElementById('input_guild').selectedIndex},
		true,
		(result)=>{
			Object.keys(result).forEach(function(key) {
				var dom = $('div#'+key).get(0);
				var jdom = $('div#'+key);
				
				if(result[key])
				{
					dom.hidden = false;
					if(key=="date")
					{
						var today = new Date();
						document.getElementById('date_from').value = today.getFullYear()+"-01-01";
						document.getElementById('date_to').value = today.getFullYear()+"-12-31";
					}
				}
				else
				{
					dom.hidden = true;
				}
			})
		}
	);
}

function ExportData()
{
	SendRequest(
		'<?php echo route("query.export-data"); ?>',
		{
			'case': (!document.getElementById('input_guild').hidden?document.getElementById('input_guild').value:0),
			'programme_code':	(!document.getElementById('programmeName').hidden?document.getElementById('programme_code').value:""),
			'event_id':		(!document.getElementById('eventName').hidden?document.getElementById('event_title').value:""),
			'date_from':		(!document.getElementById('date').hidden?document.getElementById('date_from').value:""),
			'date_to':(!document.getElementById('date').hidden?document.getElementById('date_to').value:""), 
			'volunteer_name':	(!document.getElementById('volunteerName').hidden?document.getElementById('volunteer_name').value:"")
		},
		true,
		Download
	);
}

function Download(result)
{
	let csvContent = "data:text/csv;charset=utf-8,";
	
	let header = result['header'];
	let body = result['body'];
	
	let text = header.join("\n");
	text += '\n';
	text += body.join("\n");

	console.log(text);
	
	csvContent += text;

	var encodedUri = encodeURI(csvContent);
	var link = document.createElement("a");
	link.setAttribute("href", encodedUri);
	link.setAttribute("download", "download.csv");
	document.body.appendChild(link);
	link.click();

}

function Preview()
{
	SendRequest(
		"<?php echo route('query.export-data'); ?>",
		{
			'case': (!document.getElementById('input_guild').hidden?document.getElementById('input_guild').value:0),
			'programme_code':	(!document.getElementById('programmeName').hidden?document.getElementById('programme_code').value:""),
			'event_id':		(!document.getElementById('eventName').hidden?document.getElementById('event_title').value:""),
			'date_from':		(!document.getElementById('date').hidden?document.getElementById('date_from').value:""),
			'date_to':(!document.getElementById('date').hidden?document.getElementById('date_to').value:""), 
			'volunteer_name':	(!document.getElementById('volunteerName').hidden?document.getElementById('volunteer_name').value:"")
		},
		true,
		DisplayDataExportResult,
		document.getElementById("previewTable")
	);
	
}

function send(){}
</script>

@endsection