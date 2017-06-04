
<form method="POST" role="form" action="/vacancy/add/">
	<div class="form-group">
		<label for="title">Title</label>
		<input name="form[title]" type="text" class="form-control" id="title" placeholder="Type the name of the vacancy">
	</div>
	<div class="form-group">
		<label for="Description">Description</label>
		<textarea name="form[description]" class="form-control" rows="5" id="description"></textarea>
	</div>
	<div class="form-group">
		<label for="responsibilities">Responsibilities</label>
		<textarea name="form[responsibilities]" class="form-control" rows="5" id="responsibilities"></textarea>
	</div>
	<div class="form-group">
		<label for="demands">Demands</label>
		<textarea name="form[demands]" class="form-control" rows="5" id="demands"></textarea>
	</div>
	<div class="form-inline">
		<div class="form-group col-lg-6">
			<label for="salary">Salary</label>
			<input name="form[salary]" type="number" min="0" class="form-control" id="salary" placeholder="Initial salary"> 
		</div>
		<div class="form-group col-lg-6">
			<label for="salary">Active vacancy</label>
			<div class="radio">
				<label><input type="radio" name="form[active]" value="1">On</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="form[active]" value="0">Off</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-7 col-sm-5">
			<button type="submit" class="btn btn-primary btn-block">Save</button>
		</div>
	</div>
</form>