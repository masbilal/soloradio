<h4 class="page-title">Ganti Password</h4>

<?php
	$data = $this->func->getUser($_SESSION["usrid"],"semua");
?>

<form id="postingan" action="<?=site_url("ngadimin/gantipass")?>" method="POST" class="row m-lr-0">
	<input type="hidden" name="id" value="<?=$id?>" />
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Informasi Penting
				</div>
			</div>
			<div class="card-body text-danger">
				<p>
					<i>Pastikan username tidak mengandung spasi, hanya masukkan huruf dan angka saja.</i>
				</p>
				<p>
					<i>
						Buatlah password yang unik dan susah ditiru, jangan lupa untuk selalu mengingatnya atau simpan di 
						tempat yang aman agar tidak terjadi hal-hal yang tidak di inginkan.
					</i>
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Ganti Username & Password
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $data->username; ?>" required />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control pass" name="pass" value="" required />
				</div>
				<div class="form-group">
					<label>Ulangi Password</label>
					<input type="password" class="form-control pass_repeat" name="pass_repeat" value="" required />
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body text-right">
				<button type="submit" class="btn btn-primary"><i class="la la-check-circle"></i> Simpan</button>
				<button type="reset" class="btn btn-warning"><i class="la la-refresh"></i> Reset</button>
				<button type="button" onclick="javascript:history.back()" class="btn btn-danger"><i class="la la-times"></i> Batal</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function(){
		$("#postingan").on("submit",function(e){
			e.preventDefault();
			
			var tombol = $(".btn-primary").html();
			$(".btn-primary").html("<i class='la la-spin la-spinner'></i> Menyimpan...");
			$(".btn-primary").prop("disabled",true);
			
			if($(".pass").val() == $(".pass_repeat").val()){
				$.post($(this).attr("action"),$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal.fire("Berhasil","berhasil mengubah username / password","success").then((val)=>{
							location.reload();
						});
					}else{
						swal.fire("Gagal!","gagal mengubah username / password, coba ulangi beberapa saat lagi","error");
					}
					$(".btn-primary").html(tombol);
					$(".btn-primary").prop("disabled",false);
				});
			}else{
				swal.fire("Gagal!","password yang anda masukkan tidak sesuai, cek kembali isian password anda","error");
			}
		});
	});
</script>