<?php
	$pl = $this->db->get("topsong");
	$ps = $this->db->get("postingan");
	
?>

<h4 class="page-title">Dashboard</h4>
<div class="row">
	<div class="col-md-3">
		<div class="card card-stats card-warning">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="la la-play"></i>
						</div>
					</div>
					<div class="col-7 d-flex align-items-center">
						<div class="numbers">
							<p class="card-category">Playlist</p>
							<h4 class="card-title"><?=$pl->num_rows()?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card card-stats card-success">
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
							<i class="la la-newspaper-o"></i>
						</div>
					</div>
					<div class="col-7 d-flex align-items-center">
						<div class="numbers">
							<p class="card-category">Postingan</p>
							<h4 class="card-title"><?=$ps->num_rows()?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>