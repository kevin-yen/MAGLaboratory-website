<?php if(!isset($form)) { ?>
<?php $form = array(); ?>
<?php } ?>
<?php if(!isset($formErrors)) { ?>
<?php $formErrors = array(); ?>
<?php } ?>
<form <?php echo MtHaml\Runtime::renderAttributes(array(array('action', ($form['id'] ? "/jobs/{$form['id']}/edit/{$form['edit_code']}" : "/jobs")), array('method', 'POST')), 'html5', 'UTF-8'); ?>>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['type'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="type">Is this a job posting (company/business) or a personal project?</label>
<select class="form-control" name="type">
<?php if($form['type'] == 'Business') { ?>
<option value="Business" selected="selected">Job Posting (Business)</option>
<?php } else { ?>
<option value="Business">Job Posting (Business)</option>
<?php } ?>
<?php if($form['type'] == 'Project') { ?>
<option value="Project" selected="selected">Project (Personal)</option>
<?php } else { ?>
<option value="Project">Project (Personal)</option>
<?php } ?>
</select>
</div>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['title'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="title">Title (required)</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'text'), array('name', 'title'), array('value', ($form['title']))), 'html5', 'UTF-8'); ?>>
<?php if($formErrors['title']) { ?>
<span class="text-danger"><?php echo htmlspecialchars($formErrors['title'],ENT_QUOTES,'UTF-8'); ?></span>
<?php } ?>
</div>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['company'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="company">Company / Group / Person (required)</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'text'), array('name', 'company'), array('value', ($form['company']))), 'html5', 'UTF-8'); ?>>
<?php if($formErrors['company']) { ?>
<span class="text-danger"><?php echo htmlspecialchars($formErrors['company'],ENT_QUOTES,'UTF-8'); ?></span>
<?php } ?>
</div>
<div class="form-group">
<label for="location">Location</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'text'), array('name', 'location'), array('value', ($form['location']))), 'html5', 'UTF-8'); ?>>
</div>
<div class="form-group">
<label for="pay">Pay/Compensation (if any)</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'text'), array('name', 'pay'), array('value', ($form['pay']))), 'html5', 'UTF-8'); ?>>
</div>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['end_date'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="end_date">End Date (MM/DD/YYYY)</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'date'), array('name', 'end_date'), array('value', ($form['end_date']))), 'html5', 'UTF-8'); ?>>
<?php if($formErrors['end_date']) { ?>
<span class="text-danger"><?php echo htmlspecialchars($formErrors['end_date'],ENT_QUOTES,'UTF-8'); ?></span>
<?php } ?>
</div>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['description'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="description">Description (required). Don't forget instructions on how to apply!</label>
<small class="form-text">You can use markdown (like on reddit) to style.</small>
<textarea <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('name', 'description'), array('rows', 10)), 'html5', 'UTF-8'); ?>>
<?php echo htmlspecialchars($form['description'],ENT_QUOTES,'UTF-8'); ?>
</textarea>
<?php if($formErrors['description']) { ?>
<span class="text-danger"><?php echo htmlspecialchars($formErrors['description'],ENT_QUOTES,'UTF-8'); ?></span>
<?php } ?>
</div>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['more_info_link'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="more_info_link">More Info / Apply page (URL, must be http or https)</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'url'), array('name', 'more_info_link'), array('value', ($form['more_info_link']))), 'html5', 'UTF-8'); ?>>
<?php if($formErrors['more_info_link']) { ?>
<span class="text-danger"><?php echo htmlspecialchars($formErrors['more_info_link'],ENT_QUOTES,'UTF-8'); ?></span>
<?php } ?>
</div>
<div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-group'), array('class', ($formErrors['owner'] ? 'has-danger bg-danger' : ''))), 'html5', 'UTF-8'); ?>>
<label for="owner">Owner (your email, required if you want to edit this posting later)</label>
<input <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'form-control'), array('type', 'email'), array('name', 'owner'), array('value', ($form['owner']))), 'html5', 'UTF-8'); ?>>
<?php if($formErrors['owner']) { ?>
<span class="text-danger"><?php echo htmlspecialchars($formErrors['owner'],ENT_QUOTES,'UTF-8'); ?></span>
<?php } ?>
</div>
<div class="form-group">
<?php if($form['id']) { ?>
<input type="hidden" name="_METHOD" value="PUT">
<button class="btn btn-primary" name="Update">Update</button>
<?php } else { ?>
<button class="btn btn-primary" name="Create">Create</button>
<?php } ?>
</div>
</form>
<?php if($form['id']) { ?>
<div class="row">
Click the button below to delete this posting. This can not be undone!
</div>
<form <?php echo MtHaml\Runtime::renderAttributes(array(array('action', ('/jobs/' . ($form['id']) . '/edit/' . ($form['edit_code']))), array('method', 'POST')), 'html5', 'UTF-8'); ?>>
<div class="form-group">
<input type="hidden" name="_METHOD" value="DELETE">
<button class="btn btn-danger" id="delete-posting" name="Delete">Delete this Posting</button>
</div>
</form>
<script type="text/javascript">
//<![CDATA[
$(function(){
  $('#delete-posting').click(function(e){
    if(confirm("Are you sure you want to delete this?")){
      return true;
    } else {
      e.preventDefault();
      return false;
    }
  });
});

//]]>
</script>
<?php } ?>
