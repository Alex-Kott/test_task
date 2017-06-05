<?php
//var_dump($data);
?>

<div class="row">
	<div class="col-lg-8"></div>
	<div class="col-lg-4">
		<label for="filter">Status</label>
		<div class="form-group">
			<select class="selectpicker " id="filter" >
				<option value="default">Any</option>
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


<table class="table">
	<thead>
		<tr>
			<th>Name, Surname</th>
			<th>Email</th>
			<th>Last contact date</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($data['candidates'] as $candId => $candidate):
	?>
	<tr>
		<th row="scope">
			<a href="/candidate/add/?id=<?= $candId ?>">
			<?= $candidate['name'] ?> <?= $candidate['surname'] ?>
			</a>
		</th>
		<td><?= $candidate['email'] ?>
		</td>
		<td><?= $candidate['lastdate'] ?>
		</td>
		<td><?= $candidate['status'] ?>
		</td>
		<td>
			<a href="/candidate/list/?remove_id=<?= $candId ?>" title="Delete">
			<img class="delete-icon" src="/images/delete-icon.png">
			</a>
		</td>
	</tr>
	<?php
	endforeach;
	?>
	</tbody>
</table>



<style>

.delete-icon{
	max-width:30px;
}

.box img{
	border: 0;
	margin: 0 auto;
}
</style>