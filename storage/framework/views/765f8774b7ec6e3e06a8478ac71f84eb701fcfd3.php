<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div class="text-center">
	<br/>
	<br/>
	<h1 align="center h3 mb-4">Data Export</h1>
	<form name='dataExportForm' class="border border-light p-5" method="get" action="<?php echo e(url('admin/dataExport')); ?>">
		<?php echo e(csrf_field()); ?>

		<div title='If not specify, all programme are selected' class="form-group row">
			<?php echo Form::label('programme-tite', 'Programme Title', [
				'class' => 'control-label col-sm-3',
			]); ?>

			<div class="col-sm-9">
				<?php echo Form::select('category', Common::$ProgrammeTitle, null, [
					'class' => 'form-control',
					'name'	=> 'programmeTitle',
					'placeholder' => '- All -',
				]); ?>

			</div>
		</div>
		<div title='If not specify, all events(past, ongoing and upcoming) are selected' class="form-group row">
			<?php echo Form::label('event-tite', 'Event Title', [
				'class' => 'control-label col-sm-3',
			]); ?>

			<div class="col-sm-9">
				<?php echo Form::select('category', [] , null, [
					'class' => 'form-control',
					'name'	=> 'eventTitle',
					'placeholder' => '- All-',
				]); ?>

			</div>
		</div>
		<div title='If not specify, all volunteers are selected' class="form-group row">
			<?php echo Form::label('volunteer-name', 'Volunteer Name', [
				'class' => 'control-label col-sm-3',
			]); ?>

			<input type="text" name='volunteerName' class="col-sm-9" placeholder="(Optional) To calculate total serve hour of a volunteer"/>
		</div>
		<div class="form-group">
			<label>Date:</label>
			<div class="form-group row">
				<?php echo Form::label('date-from', 'From', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<input name='dateFrom' class='col-sm-6' placeholder='DD/MM/YYYY'/>
			</div>
			<div class="form-group row">
				<?php echo Form::label('date-to', 'To', [
					'class' => 'control-label col-sm-3',
				]); ?>

				<input name='dateTo' class='col-sm-6' placeholder='DD/MM/YYYY'/>
			</div>
		</div>
	</form>
	<div class="form-group row">
		<div class="col-sm-12">
			<button class='btn btn-lg btn-block btn-primary'>Export</button>
			<button class='btn btn-lg btn-block btn-primary'>Preview</button>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<script>
function Preview()
{
	
}

function SubmitForm()
{
	document.dataExportForm.submit();
}
</script>
<?php echo $__env->make('officework.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>