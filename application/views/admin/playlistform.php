<a href="javascript:history.back()" class="btn btn-danger float-right"><i class="la la-times"></i> Batal</a>
<?php if($id == 0){ ?>
<h4 class="page-title">Tambah Playlist Baru</h4>
<?php }else{ ?>
<h4 class="page-title">Edit Playlist</h4>
<?php } ?>

<?php
	if($id != 0){
		$data = $this->func->getPlaylist($id,"semua");
	}
?>

<form id="postingan" action="<?=site_url("ngadimin/playlistform")?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="id" value="<?=$id?>" />
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				Detail Playlist
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Nama Playlist</label>
				<input type="text" class="form-control" name="nama" value="<?php echo ($id != 0) ? $data->nama : ""; ?>" required />
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control col-md-4" name="status" required>
					<option value="0" <?php echo ($id != 0 AND $data->status == 0) ? "selected" : ""; ?>>Draft</option>
					<option value="1" <?php echo ($id != 0 AND $data->status == 1) ? "selected" : ""; ?>>Published</option>
				</select>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				<button type="button" onclick="tambahLagu()" class="btn btn-primary float-right"><i class="la la-plus"></i> Tambah Lagu</button>
				Daftar Urutan Lagu<br/>
				<small>Klik tahan dan lepaskan untuk mengubah posisi</small>
			</div>
		</div>
		<div class="card-body">
			<div class="laguwrap">
				<i class="la la-spin la-spinner"></i> Loading...
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
	tinymce.init({
		selector: '#editor',
		height: '500px',
		menubar: false,
		statusbar: false
	});
	
	function tambahLagu(){
		$("#laguform .form-control").val("");
		$("#modal").modal();
	}
	
	$(function(){
		$("#postingan").on("submit",function(){
			var suk = $(".btn-primary").html();
			$(".btn-primary").html("menyimpan...");
			$(".btn-primary").prop("disabled",true);
		});
		
		$(".laguwrap").load("<?=site_url("ngadimin/loadlagu?theid=".$id)?>");
		
		$("#laguform").on("submit",function(e){
			e.preventDefault();
			
			var tombol = $("#laguform .btn-success").html();
			$("#laguform .btn-success").html("<i class='la la-spin la-spinner'></i>&nbsp;menyimpan...");
			$("#laguform .btn-success").prop("disabled",true);
			
			$.post("<?=site_url("ngadimin/tambahlagu")?>",$(this).serialize(),function(e){
				var data = eval("("+e+")");
				$("#modal").modal("hide");
				if(data.success == true){
					$(".laguwrap").load("<?=site_url("ngadimin/loadlagu?theid=".$id)?>");
				}else{
					swal.fire("Gagal","terjadi kesalahan saat menyimpan lagu, cobalah beberapa saat lagi","error");
					$("#laguform .btn-success").html(tombol);
					$("#laguform .btn-success").prop("disabled",false);
				}
			});
		});
	});
</script>

	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLagu" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title"><i class="la la-music"></i> Tambah Lagu</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="laguform">
					<input type="hidden" name="topid" value="<?=$id?>" />
					<div class="modal-body">
						<div class="form-group">
							<label>Judul Lagu</label>
							<input type="text" class="form-control" name="judul" required />
						</div>
						<div class="form-group">
							<label>Artis</label>
							<input type="text" class="form-control" name="artis" required />
						</div>
						<div class="form-group">
							<label>Label</label>
							<input type="text" class="form-control" name="label" required />
						</div>
						<div class="form-group">
							<label>Link Youtube</label>
							<input type="text" class="form-control" name="linkyt" required />
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>