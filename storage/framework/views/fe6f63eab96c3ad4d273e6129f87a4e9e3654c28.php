<?php

use App\Common;
?>


<?php $__env->startSection('container'); ?>



  <style>

fieldset
	{
		border: 1px solid #ddd !important;
		margin-top:3%;
		margin-left: auto;
		margin-right:auto;
		xmin-width: 0;
		padding: 10px;
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}

		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px;
			width: 35%;
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px 5px 5px 10px;
			background-color: #ffffff;
    }

    input[type="text"]:disabled {
  background: #fafafa;
    }


}

</style>

  <div class="register_container" >
  <ul class="nav nav-tabs">
    <li><a data-toggle="tab" id="all_event" href="" onclick="page1Toggle()">Personal Details</a></li>
    <li><a data-toggle="tab" id="past_event" href=""  onclick="page2Toggle()">Other Details</a></li>
    <li><a data-toggle="tab" id="ongoing_event" href="" onclick="page3Toggle()">Skill and Proficiency</a></li>
  </ul>


  <form id="update-form" name='update' method="post" action="<?php echo e(route('volunteer.update')); ?>" enctype="multipart/form-data">

      <?php echo e(csrf_field()); ?>

      <div class="tab-content" id="tab-content-display">
        <div class="login-wrap">
          <div class="login-html">
            <div class="login-form">
              <div class="sign-in-htm">
                <div class="group">
                  <div class="form-group">
                    <?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="form-group row">

                        <fieldset class="col-md-9 ">
                          <legend>Personal Information</legend>

                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group row">
                                <?php echo Form::label('name', 'Full Name', [
                                'class' => 'control-label col-sm-4',
                              ]); ?>

                                <div class="col-sm-6">
                                  <input type="text" name="name" class="form-control mb-4" value="<?php echo e($volunteer->name); ?>"/>
                                </div>
                              </div>

                              <div class="form-group row">
                                <?php echo Form::label('nric', 'IC No.', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-6">
                                  <input type="text" name="nric" class="form-control mb-4" value="<?php echo e($volunteer->nric); ?>"/>
                                </div>
                              </div>

                              <div class="form-group row">
                                <?php echo Form::label('gender', 'Gender', [
                                    'class' => 'control-label col-sm-4',
                                  ]); ?>

                                <div class="col-sm-3">
                                  <?php echo Form::select('gender', Common::$volunteerGender, $volunteer->gender, [
                                    'id'	=> 'gender',
                                    'class' => 'form-control form-control-lg',
                                    'onchange' => 'SetDescription(this)',
                                    'placeholder' => '- All -',
                                  ]); ?>

                                </div>
                              </div>

                              <div class="form-group row">
                                <?php echo Form::label('nationality', 'Nationality', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-4">
                                  <input type="text" name="nationality" class="form-control mb-4" value="<?php echo e($volunteer->nationality); ?>"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <?php echo Form::label('race', 'Race', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-3">
                                  <input type="text" name="race" class="form-control mb-4" value="<?php echo e($volunteer->race); ?>"/>
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>

                        <fieldset class="col-md-9 ">
                          <legend>Personal Contact</legend>

                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group row">
                                <?php echo Form::label('volunteer-email', 'Email', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>


                                <div class="col-sm-5">
                                  <input type="email" name="email" class="form-control mb-4" value="<?php echo e($volunteer->email); ?>"/>
                                </div>
                              </div>

                              <div class="form-group row">
                                <?php echo Form::label('volunteer-contact_no', 'Contact Number', [
                                    'class' => 'control-label col-sm-4',
                                  ]); ?>

                                  <div class="col-sm-5">
                                    <input type="tel" name="contact_no" class="form-control mb-4" value="<?php echo e($volunteer->contact_no); ?>"/>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <?php echo Form::label('address', 'Address', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-7">
                                  <input type="text" name="address1" class="form-control mb-4" value="<?php echo e($volunteer->address); ?>"/>
                                </div>
                              </div>

                            </div>
                          </div>
                        </fieldset>

                        <fieldset class="col-md-9 ">
                          <legend>Emergency Contact</legend>

                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group row">
                                <?php echo Form::label('em_person', 'Emergency Contact Name', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-7">
                                  <input type="text" name="em_person" class="form-control mb-4" value="<?php echo e($volunteer->em_person); ?>"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <?php echo Form::label('em_relation', 'Relationship', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-4">
                                  <input type="text" name="em_relation" class="form-control mb-4" value="<?php echo e($volunteer->em_relation); ?>"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <?php echo Form::label('em_contact_no', 'Emergency Contact Number', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-5">
                                  <input type="tel" name="em_contact_no" class="form-control mb-4" value="<?php echo e($volunteer->em_contact_no); ?>" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="tab-content2-display">
        <div class="login-wrap">
          <div class="login-html">
            <div class="login-form">
              <div class="sign-up-htm">
                <div class="group">
                  <div class="form-group">
                    <div class="form-group row">
                      <fieldset class="col-md-9 ">
                        <legend>Background</legend>

                        <div class="panel panel-default">
                          <div class="panel-body">
                            <div class="form-group row">
                              <?php echo Form::label('education_level', 'Education Level', [
                                  'class' => 'control-label col-sm-4',
                                ]); ?>

                                <div class="col-sm-5">
                                  <?php echo Form::select('education_level', Common::$educationLvl, $volunteer->education_level, [
                                    'id'	=> 'education_level',
                                    'class' => 'form-control form-control-lg',
                                    'onchange' => 'SetEducation(this)',
                                    'placeholder' => '- All -',
                                  ]); ?>

                                </div>
                            </div>
                            <div class="form-group row">
                              <?php echo Form::label('occupation', 'Occupation', [
                                'class' => 'control-label col-sm-4',
                              ]); ?>

                              <div class="col-sm-5">
                                <input type="text" name="occupation" class="form-control mb-4" value="<?php echo e($volunteer->occupation); ?>"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>

                      <fieldset class="col-md-9 ">
                        <legend>Others</legend>

                        <div class="panel panel-default">
                          <div class="panel-body">
                          <div class="form-group row">
                              <?php echo Form::label('remark', 'Remark', [
                                'class' => 'control-label col-sm-4',
                              ]); ?>

                              <div class="col-sm-5">
                                <input type="text" name="remark" class="form-control mb-4" value="<?php echo e($volunteer->remark); ?>" />
                              </div>
                            </div>

                            <div class="form-group row">
                              <?php echo Form::label('programme', 'Programmes That You Interested In (Can Choose More Than 1)', [
                                  'style= "margin-left :15px"',
                              ]); ?>

                              <div class="col-sm-9">

                                <?php $__currentLoopData = Common::getProgrammes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcode => $pname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i=false ?>
                                  <?php $__currentLoopData = $programmes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $programme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($programme->code == $pcode): ?>
                                    <?php $i=true ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($i==true): ?>
                                    <input type="checkbox" name="<?php echo e($pcode); ?>" value=<?php echo e($pcode); ?> checked><?php echo e($pcode); ?>-<?php echo e($pname); ?>

                                    </br>
                                    <?php else: ?>
                                    <input type="checkbox" name="<?php echo e($pcode); ?>" value=<?php echo e($pcode); ?>><?php echo e($pcode); ?>-<?php echo e($pname); ?>

                                    </br>
                                    <?php $i=false ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                            </div>



                            <div class="form-group row">
                              <?php echo Form::label('profile_image', 'Please upload an image as your profile picture', [
                                'style= "margin :15px"',
                              ]); ?>

                              <div class="col-sm-9">
                                <input type="file" style=" width:60%;font-size:16px;" name="profile_image" id="fileToUpload">
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
	    </div>


      <div class="tab-content" id="tab-content3-display">
        <div class="login-wrap">
          <div class="login-html">
            <div class="login-form">
              <div class="sign-up-htm">
                  <div class="form-group">
                    <div class="form-group row">
                      <fieldset class="col-sm-11 ">
                        <legend>Areas You Can Contribute</legend>
                          <div class="col-sm-9">

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php $__currentLoopData = Common::$ContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($shortform == $area_code): ?>
                                      <?php if($shortform == "funding"): ?>
                                        <?php if($skillsetslist->$shortform == '1'): ?>
                                        <div class='row'>
                                          <input type="checkbox" name="funding" value="1" checked>
                                            <label> Funding </label>
                                        </div>
                                        <?php else: ?>
                                        <div class='row'>
                                          <input type="checkbox" name="funding" value="1">
                                            <label> Funding </label>
                                        </div>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php $__currentLoopData = Common::$ContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($shortform == $area_code): ?>
                                      <?php if($shortform == "branding"): ?>
                                        <?php if($skillsetslist->$shortform == '1'): ?>
                                        <div class='row'>
                                          <input type="checkbox" name="branding" value="1" checked>
                                            <label> Branding </label>
                                        </div>
                                        <?php else: ?>
                                        <div class='row'>
                                          <input type="checkbox" name="branding" value="1">
                                            <label> Branding </label>
                                        </div>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php $__currentLoopData = Common::$ContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($shortform == $area_code): ?>
                                      <?php if($shortform == "entrepreneurship"): ?>
                                        <?php if($skillsetslist->$shortform == '1'): ?>
                                        <div class='row'>
                                          <input type="checkbox" name="entrepreneurship" value="1" checked>
                                            <label> Entrepreneurship </label>
                                        </div>
                                        <?php else: ?>
                                        <div class='row'>
                                          <input type="checkbox" name="entrepreneurship" value="1">
                                            <label> Entrepreneurship </label>
                                        </div>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="row">
                              <input type="checkbox" name='dgt' id='digital'>
                              <label> Digital </label>
                            </div>

                            <div id="digitalcheck" style="display: none">
                            <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "dgtMultimedia"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="dgtMultimedia" style="margin-left:20px;" value=1 checked><label>Multimedia</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="dgtMultimedia" style="margin-left:20px;" value=1><label>Multimedia</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "dgtIT"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="dgtIT" style="margin-left:20px;" value=1 checked><label>IT</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="dgtIT" style="margin-left:20px;" value=1><label>IT</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "dgtSocialMedia"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="dgtSocialMedia" style="margin-left:20px;" value=1 checked><label>Social Media</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="dgtSocialMedia" style="margin-left:20px;" value=1><label>Social Media</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                            <script>
                            $(function () {
                              $("#digital").click(function () {
                                if ($(this).is(":checked")) {
                                  $("#digitalcheck").show();
                                } else {
                                  $("#digitalcheck").hide();
                                }
                              });
                            });
                            </script>

                    <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$ContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_code): ?>
                                          <?php if($shortform == "business"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <div class='row'>
                                              <input type="checkbox" name="business" value="1" checked>
                                                <label> Business </label>
                                            </div>
                                            <?php else: ?>
                                            <div class='row'>
                                              <input type="checkbox" name="business" value="1">
                                                <label> Business </label>
                                            </div>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- <div id="businesscheck" style="display: none">
                                <input type="checkbox"><label>Has Own Company</label>
                            </div>

                            <script type="text/javascript">
                              $(function () {
                              $("#business").click(function () {
                                  if ($(this).is(":checked")) {
                                      $("#businesscheck").show();
                                  } else {
                                      $("#businesscheck").hide();
                                  }
                                });
                              });
                            </script> -->

                            <div class="row">
                              <input type="checkbox" id='arts' name="ctv">
                              <label>Creative</label>
                            </div>

                            <div id="artscheck" style="display: none">
                            <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "ctvArt"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="ctvArt" style="margin-left:20px;" value=1 checked><label>Art</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="ctvArt" style="margin-left:20px;" value=1><label>Art</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "ctvDraw"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="ctvDraw" style="margin-left:20px;" value=1 checked><label>Draw</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="ctvDraw" style="margin-left:20px;" value=1><label>Draw</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "ctvDance"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="ctvDance" style="margin-left:20px;" value=1 checked><label>Dance</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="ctvDance" style="margin-left:20px;" value=1><label>Dance</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "ctvThretre"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="ctvThretre" style="margin-left:20px;" value=1 checked><label>Theatre</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="ctvThretre" style="margin-left:20px;" value=1><label>Theatre</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "ctvMusic"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="ctvMusic" style="margin-left:20px;" value=1 checked><label>Music</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="ctvMusic" style="margin-left:20px;" value=1><label>Music</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <script type="text/javascript">
                            $(function () {
                              $("#arts").click(function () {
                              if ($(this).is(":checked")) {
                                  $("#artscheck").show();
                              } else {
                                  $("#artscheck").hide();
                              }
                              });
                            });
                            </script>

                            <div class="row">
                              <input type="checkbox" id="communication" name="cmm">
                              <label>Communication</label>
                            </div>

                            <div id="communicationcheck" style="display: none">
                            <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "cmmMarket"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="cmmMarket" style="margin-left:20px;" value=1 checked><label>Marketing</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="cmmMarket" style="margin-left:20px;" value=1><label>Marketing</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "cmmMedia"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="cmmMedia" style="margin-left:20px;" value=1 checked><label>Media</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="cmmMedia" style="margin-left:20px;" value=1><label>Media</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $shortform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_code => $area_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $area_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_sub_code => $area_sub_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($shortform == $area_sub_code): ?>
                                          <?php if($shortform == "cmmPresentation"): ?>
                                            <?php if($skillsetslist->$shortform == '1'): ?>
                                            <input type="checkbox" name="cmmPresentation" style="margin-left:20px;" value=1 checked><label>Presentation Skills</label>
                                            <?php else: ?>
                                            <input type="checkbox" name="cmmPresentation" style="margin-left:20px;" value=1><label>Presentation Skills</label>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <script type="text/javascript">
                            $(function () {
                              $("#communication").click(function () {
                              if ($(this).is(":checked")) {
                                  $("#communicationcheck").show();
                              } else {
                                  $("#communicationcheck").hide();
                              }
                              });
                            });
                            </script>

                          </div>



                      </fieldset>
          <!-- Language -->
                      <div class="col-sm-12" style="margin-bottom:-6px;">
                        <table class='table table-striped table-bordered text-center'>
                          <col width="20%">
                          <col width="16%">
                          <col width="16%">
                          <col width="16%">
                          <col width="16%">
                          <col width="16%">
                          <thead class='thead-dark text-center'>
                            <tr>
                              <th>
                                <label>Language</label>
                              </th>
                              <?php $__currentLoopData = Common::$Strength; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <th>
                                <label><?php echo e($value); ?></label>
                              </th>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                          </thead>
                          <tbody class='thead-dark'>
                          <?php $__currentLoopData = Common::$Language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill_key => $skill_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <th scope='row'>
                              <label><?php echo e($skill_value); ?></label>
                            </th>
                            <?php $__currentLoopData = $skillset; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s_key => $s_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($skill_key == $s_key): ?>
                            <?php $__currentLoopData = Common::$Strength; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td onclick='set(this)'>
                              <?php if($key==$s_value): ?>
                              <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" checked />
                              <?php else: ?>
                              <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" />
                              <?php endif; ?>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>

                      <!-- Skills -->
                      <div class="col-sm-12" style="margin-top:-20px;">
                        <table class='table table-striped table-bordered text-center'>
                          <col width="20%">
                          <col width="20%">
                          <col width="20%">
                          <col width="20%">
                          <col width="20%">
                          <?php $__currentLoopData = Common::$Skillsets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill_category_key => $skill_category_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <thead class='thead-dark'>
                            <tr>
                              <th>
                                <label><?php echo e($skill_category_key); ?></label>
                              </th>
                              <?php $__currentLoopData = Common::$Proficient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <th>
                                <label><?php echo e($value); ?></label>
                              </th>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                          </thead>
                          <tbody class='thead-dark'>
                          <?php $__currentLoopData = $skill_category_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill_key => $skill_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $__currentLoopData = $skillset; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s_key => $s_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($skill_key == $s_key): ?>
                          <tr>
                            <th scope='row'>
                              <label class="text-left col-sm-9"><?php echo e($skill_value); ?></label>
                            </th>
                            <?php $__currentLoopData = Common::$Proficient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td onclick='set(this)'>
                              <?php if($key== $s_value): ?>
                              <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" checked />
                              <?php else: ?>
                              <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" />
                              <?php endif; ?>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tr>
                          <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                      </div>

                      <div class= "col-sm-11">
                        <input type="submit" value="Update" class="btn btn-primary" >
                        <button onClick=""class="btn btn-danger" >Cancel</button>
                      </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    </form>
</div>


<div style="text-align:center;margin:10px;">
	<button onclick="back_to_login()" class="btn btn-danger" >Cancel</button>
	</div>
<script>


function openTab(evt, TabName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(TabName).style.display = "block";
      evt.currentTarget.className += " active";

    }

    document.getElementById("clickme").click();

var tabs = $('.multiple-tabs');
   var selector = $('.multiple-tabs').find('a').length;
   //var selector = $(".tabs").find(".selector");
   var activeItem = tabs.find('.active');
   var activeWidth = activeItem.innerWidth();
   $(".tab-selector").css({
     "left": activeItem.position.left + "px",
     "width": activeWidth + "px"
   });

   $(".multiple-tabs").on("click","a",function(e){
     e.preventDefault();
     $('.multiple-tabs a').removeClass("active");
     $(this).addClass('active');
     var activeWidth = $(this).innerWidth();
     var itemPos = $(this).position();
     $(".tab-selector").css({
       "left":itemPos.left + "px",
       "width": activeWidth + "px"
     });
   });

   $(document).ready(function(){
        $("#personal-info :input[type='text']").prop("disabled", true);
        $("#skills :input[type='radio']").prop("disabled", true);
    });

    function page1Toggle() {
  var x = document.getElementById("tab-content-display");
  var y = document.getElementById("tab-content2-display");
  var z = document.getElementById("tab-content3-display");
    x.style.display = "block";
    y.style.display = "none";
	z.style.display = "none";

}

function page2Toggle() {
	var x = document.getElementById("tab-content-display");
  var y = document.getElementById("tab-content2-display");
  var z = document.getElementById("tab-content3-display");
    x.style.display = "none";
    y.style.display = "block";
	z.style.display = "none";
}

function page3Toggle() {
	var x = document.getElementById("tab-content-display");
  var y = document.getElementById("tab-content2-display");
  var z = document.getElementById("tab-content3-display");
    x.style.display = "none";
    y.style.display = "none";
	z.style.display = "block";
}
</script>

  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', ['title'=>'Edit Profile'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>