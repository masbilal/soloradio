<a href="javascript:history.back()" class="btn btn-danger float-right"><i class="la la-times"></i> Batal</a>
<?php if($id == 0){ ?>
<h4 class="page-title">Tambah Slider Baru</h4>
<?php }else{ ?>
<h4 class="page-title">Edit Slider</h4>
<?php } ?>

<?php
	if($id != 0){
		$data = $this->func->getSlider($id,"semua");
	}
?>

<form id="postingan" action="<?=site_url("ngadimin/sliderform")?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="id" value="<?=$id?>" />
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				Detail Slider
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Nama Slider</label>
				<input type="text" class="form-control" name="nama" value="<?php echo ($id != 0) ? $data->nama : ""; ?>" required />
			</div>
			<div class="form-group">
				<label>Foto Sider</label>
				<input type="file" class="form-control" name="foto" />
				<small class="text-danger" <?php if($id == 0){echo "style='display:none'";} ?>><i>Kosongkan apabila tidak ingin mengupdate foto slider</i></small>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body text-right">
			<button type="submit" class="btn btn-primary"><i class="la la-check-circle"></i> Simpan</button>
			<button type="reset" class="btn btn-warning"><i class="la la-refresh"></i> Reset</button>
			<button type="button" onclick="javascript:history.back()" class="btn btn-danger"><i class="la la-times"></i> Batal</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function(){
		$("#postingan").on("submit",function(){
			var suk = $(".btn-primary").html();
			$(".btn-primary").html("menyimpan...");
			$(".btn-primary").prop("disabled",true);
		});
	});
</script>