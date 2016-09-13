<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Age</th>
			<th>Gender</th>
		</tr>
	</thead>
	<tbody>
	<?php if( $patients->exists() ) : ?>
	<?php foreach( $patients as $row ) : ?>
		<tr onclick="location = '<?php echo site_url('patients/details/' . $row->code); ?>'">
			<td>
				<?php echo $row->name; ?>
			</td>
			<td><?php echo $row->age; ?></td>
			<td><?php echo strtoupper( $row->gender ); ?></td>
		</tr>
	<?php endforeach; ?>
	<?php else : ?>
	<tr>
		<td colspan="3" class="text-center">
			No results matched.  <a href="<?php echo site_url('patients/add_new');?>" class="btn btn-success btn-xs">
				Add new patient.
			</a>
		</td>
	<?php endif; ?>
	</tbody>
</table>
<?php echo $pagination; ?>