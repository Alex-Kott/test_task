<?php
//var_dump($data);
?>

<div class="row">
	<div class="col-lg-3">
		<a href="/vacancy/add/">
			<button  class="btn btn-primary btn-block">Add vacancy</button>
		</a>
	</div>
	<div class="col-lg-5">
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<select class="selectpicker " id="filter" >
				<option value="default">Any</option>
				<option value="enable">Enable</option>
				<option value="disable">Disable</option>
			</select>
		</div>
	</div>
</div>


<table class="table results" id="results">
	<thead>
		<tr class="head-tr">
			<th data-type="string" title="Click to filter">Title</th>
			<th data-type="string" title="Click to filter">Description</th>
			<th data-type="number" title="Click to filter">Salary</th>
			<th data-type="string">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($data['vacancies'] as $vacId => $vacancy):
	?>
	<tr>
		<th row="scope">
			<a href="/vacancy/add/?id=<?= $vacId ?>">
			<?= $vacancy['title'] ?>
			</a>
		</th>
		<td><?= $vacancy['description'] ?>
		</td>
		<td><?= $vacancy['salary'] ?>
		</td>
		<td><?= $vacancy['active'] ? "Enable" : "Disable" ?>
		</td>
		<td>
			<a href="/vacancy/list/?remove_id=<?= $vacId ?>" title="Delete">
			<img class="delete-icon" src="/images/delete-icon.png">
			</a>
		</td>
	</tr>
	<?php
	endforeach;
	?>
	</tbody>
</table>

<script>
	

    var sort_type;
    var ord = 1; // текущий порядок сортировки (по возрастанию или по убыванию) 

    $(".head-tr th[data-type]").on("click", function(e) {
        var type = $(e.target).data('type');
        if(sort_type != type)
            ord = 1;
        else if((sort_type == type) && (ord == -1)){
            ord = 1;
        } else {
            ord = -1;
        }
        sort_type = type;
        var cell_index = e.target.cellIndex;
        sortGrid(cell_index, sort_type);
    });

    function sortGrid(colNum, type) {
        // Составить массив из TR
        var trs = $(".results tbody tr").siblings(); // table rows
        console.log(trs)

        // определить функцию сравнения, в зависимости от типа
        var compare;
        switch (type) {
            case 'number':
                compare = function(rowA, rowB) {
                    var numbA = rowA.cells[colNum].innerHTML + 0;
                    var numbB = rowB.cells[colNum].innerHTML + 0;
                    var comp = Number(numbA) > Number(numbB) ? 1 : -1;
                    return  comp*ord;
                };
                break;
            case 'string':
                compare = function(rowA, rowB) {
                    var strA = rowA.cells[colNum].innerHTML;
                    var strB = rowB.cells[colNum].innerHTML;
                    var comp = strA > strB ? 1 : -1;
                    return  comp*ord;
                };
                break;
            case 'date':
                compare = function(rowA, rowB) {
                    var timeA = moment(rowA.cells[colNum].innerHTML, 'YYYY-MM-DD');
                    var timeB = moment(rowB.cells[colNum].innerHTML, 'YYYY-MM-DD');
                    var comp = timeA.unix() > timeB.unix() ? 1 : -1;
                    return comp*ord;
                };
                break;
        }
        trs.sort(compare);

        var results = document.getElementById('results');
        var tbody = results.getElementsByTagName('tbody')[0];
        $(".results .head-tr").siblings().remove();
        for (var i = 0; i < trs.length; i++) {
            tbody.appendChild(trs[i]);
        }
        results.appendChild(tbody);
    }
    
</script>

<style>

.delete-icon{
	max-width:30px;
}

.box img{
	border: 0;
	margin: 0 auto;
}

th{
	cursor: pointer;
}
</style>