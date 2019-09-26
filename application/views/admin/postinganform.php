<a href="javascript:history.back()" class="btn btn-danger float-right"><i class="la la-times"></i> Batal</a>
<?php if($id == 0){ ?>
<h4 class="page-title">Tambah Post Baru</h4>
<?php }else{ ?>
<h4 class="page-title">Edit Post</h4>
<?php } ?>

<?php
	if($id != 0){
		$data = $this->func->getPostingan($id,"semua");
	}
?>

<form id="postingan" action="" method="POST">
	<input type="hidden" name="id" value="<?=$id?>" />
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				Judul & Kategori Postingan
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Judul Postingan</label>
				<input type="text" class="form-control" name="judul" value="<?php echo ($id != 0) ? $data->judul : ""; ?>" required />
			</div>
			<div class="form-group">
				<label>Kategori</label>
				<select class="form-control col-md-6" name="kategori" required>
					<option value="">- Pilih Kategori -</option>
					<?php
						$kat = $this->func->kategori();
						for($i=2; $i<=count($kat); $i++){
							$selec = ($id!=0 AND $data->kategori == $i) ? "selected" : "";
							echo "<option value='$i' $selec>$kat[$i]</option>";
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				Isi/Konten Postingan
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Video (Youtube)</label>
				<input type="text" class="form-control" name="linkyt" value="<?php echo ($id != 0) ? $data->linkyt : ""; ?>" placeholder="contoh: https://youtube.com/?v=Ar2Rfjks" required />
			</div>
			<div class="form-group">
				<label>Text Konten/Isi</label>
				<textarea class="form-control" id="editor" name="konten" rows=6><?php echo ($id != 0) ? $data->konten : ""; ?></textarea>
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
	
	$(function(){
		$("#postingan").on("submit",function(){
			var suk = $(".btn-primary").html();
			$(".btn-primary").html("menyimpan...");
			$(".btn-primary").prop("disabled",true);
		});
	});
</script>