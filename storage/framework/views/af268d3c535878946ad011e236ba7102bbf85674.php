<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div>
	<br/>
	<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br/>
	<div class='card col-sm-12 text-right' style='margin:4px;'>
		<div id='guildance' title='To guild you what field is required' style='margin:2px'>
			<div class='card-body row'>
				<?php echo Form::label('preset', 'Guildance', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<div class="col-sm-9">
					<?php echo Form::select('category', Common::$DataExportGuildance, null, [
						'id'	=> 'input_guild',
						'class' => 'form-control',
						'name'	=> 'programmeTitle',
						'onchange' => 'setRequiredField()',
						'placeholder' => '- None -',
					]); ?>

				</div>
			</div>
		</div>
		<div id='programmeTitle' title='Showing volunteers that interested in this programme' style='margin:2px'>
			<div class='card-body row'>
				<?php echo Form::label('programme-tite', 'Programme Title', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<div class="col-sm-9">
					<?php echo Form::select('programme-title', Common::$ProgrammeTitle, null, [
						'id'	=> 'programme_title',
						'class' => 'form-control',
						'name'	=> 'programmeTitle',
						'placeholder' => '- All -',
					]); ?>

				</div>
			</div>
		</div>
		<div id='eventTitle' title='Showing volunteer that enrolled for this event'  style='margin:2px'>
			<div class='card-body row'>
				<?php echo Form::label('event-tite', 'Event Title', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<div class="col-sm-9">
					<?php echo Form::select('event-title', Common::$TestEventList , null, [
						'id'	=> 'event_title',
						'class' => 'form-control',
						'name'	=> 'eventTitle',
						'placeholder' => '- All -',
					]); ?>

				</div>
			</div>
		</div>
		<div id="date" style='margin:2px;'>
			<div class="card-body row">
				<?php echo Form::label('date-from', 'From', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<div class='col-sm-9'>
					<input type="date" id='date_from' class='form-control' name='dateFrom' style='width:100%' />
				</div>
			</div>
			<div class="card-body row">
				<?php echo Form::label('date-to', 'To', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<div class='col-sm-9'>
					<input type="date" id='date_to' value='<?php echo date('Y-m-d')?>' class='form-control' name='dateTo' style='width:100%' />
				</div>
			</div>
		</div>
		<div style='margin:2px'>
			<div id="volunteerName">
				<div title='If not specify, all volunteers are selected' class='card-body row'>
					<?php echo Form::label('volunteer-name', 'Volunteer Name', [
						'id'	=> 'volunteer_name',
						'class' => 'control-label col-sm-3',
					]); ?>

					<div class='col-sm-9'>
						<input id="volNameInput" type="text" name='volunteerName' class='form-control' style='width:100%;' placeholder=" (Optional) To calculate total serve hour of a volunteer"/>
					</div>
				</div>
			</div>
			<?php echo $__env->make('common.volunteer-name-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-12">
			<button onclick='ExportData()' class='btn btn-lg btn-block btn-primary'>Export</button>
			<button onclick='Preview()' class='btn btn-lg btn-block btn-primary'>Preview</button>
		</div>
	</div>
</div>

<script>
var nameInput = document.getElementById("volNameInput");
nameInput.oninput = function(){
	SendRequest(
		"<?php echo route('query.searchVolByName') ?>",
		{'name':nameInput.value.trim()}, //data
		nameInput.value.trim().length>=3, //condition to send request
		DisplayVolunteerNameList, //callback function
		nameInput //arguments for callback function
	)
};

function setRequiredField()
{
	SendRequest(
		"<?php echo route('query.export-data-guildance'); ?>",
		{'index':document.getElementById('input_guild').selectedIndex},
		true,
		interpret
	);
}

function interpret(result)
{
	result = JSON.parse(result);
	Object.keys(result).forEach(function(key) {
		var dom = $('div#'+key).get(0);
		dom.classList.remove('card-require');
		if(result[key]) dom.classList.add('card-require');
	})
//	$()
}

function ExportData()
{
	SendRequest(
		"<?php echo route('query.export-data'); ?>",
		{
			'programme_title':	document.getElementById('programme_title').value,
			'event_title':		document.getElementById('event_title').value,
			'date_from':		document.getElementById('date_from').value,
			'date_to':			document.getElementById('date_to').value, 
			'volunteer_name':	document.getElementById('volNameInput').value
		},
		true,
		Download
	);
}

function Download(result)
{
	console.log(result);
}

function Preview()
{
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('officework.master', ['title'=>"Data Export"], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>