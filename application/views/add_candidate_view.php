<?php
if(isset($data['person'])){
	$person = $data['person'];
}
var_dump($person);
?>

<form method="POST" role="form" action="/candidate/add/">
	<input type="hidden" name="form[id]" value="<?= isset($person) ? $person['id'] : ''?>">
	<div class="form-group">
		<div class="form-group col-lg-6">
			<label for="name">Name</label>
			<input name="form[name]" type="text" name="form[name]" class="form-control" id="name" value="<?= isset($person) ? $person['name'] : ''?>"> 
		</div>
		<div class="form-group col-lg-6">
			<label for="surname">Surname</label>
			<input name="form[surname]" type="text" name="form[surname]" class="form-control" id="surname"  value="<?= isset($person) ? $person['surname'] : ''?>"> 
		</div>
	</div>
	<div class="form-group">
		<div class="form-group col-lg-12">
			<label for="email">Email</label>
			<input type="email" name="form[email]" class="form-control" rows="5" id="email" value="<?= isset($person) ? $person['email'] : ''?>">
		</div>
	</div>
	<div class="form-group">
		<div class="form-group col-lg-6">
			<label for="lastdate">Last contact date</label>
			<input type="date" name="form[lastdate]" class="form-control" rows="5" id="lastdate"  value="<?= isset($person) ? $person['lastdate'] : ''?>">
		</div>
		<div class="form-group col-lg-6">
			<label for="status">Status</label>
			<div class="form-group ">
				<select class="selectpicker status col-lg-12" id="status" name="form[status]" >
					<option value="new">New</option>
					<option value="invited">Invited</option>
					<option value="accepted">Accepted</option>
					<option value="deferred">Deferred</option>
					<option value="rejected">Rejected</option>
					<option value="refused">Refused</option>
				</select>
			</div>

		</div>
	</div>
	<div class="form-group">
		<div class="form-group col-lg-12">
			<label for="vacancies">Vacancies</label>
			<div class="form-group ">
				<select class="selectpicker col-lg-12" id="vacancies" name="form[vacancies][]" multiple>
					<?php
					foreach($data['vacancies'] as $vacId => $vacancy):
					?>
						<option value="<?= $vacId ?>"><?= $vacancy['title'] ?></option>
					<?php
					endforeach;
					?>
					</select>
				</select>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-7 col-sm-5">
			<button type="submit" class="btn btn-primary btn-block">Save</button>
		</div>
	</div>
</form>

<script>
	$(document).ready(function(){
		$(".status").val(<?= isset($person) ? '"'.$person['status'].'"' : 'new'?>)
	});
	
</script>