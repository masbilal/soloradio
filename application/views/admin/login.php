<html lang="ID">
	<head>
		<title>Masuk | Soloradio</title>
		<link rel="shortcut icon" type="image/png" href="<?php echo base_url("assets/img/logo.png"); ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/ready.min.css"); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/sweetalert2.min.css"); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/minmin.css?v=".time()); ?>" />
		
	</head>
	<body style="background:#ecf0f1;">
		<div class="wrap">
			<div class="login-head">
				<b>MASUK</b>
			</div>
			<div class="login">
				<form id="login">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" required />
					</div>
					<div class="form-group">
						<label for="pass">Password</label>
						<input type="password" class="form-control" id="pass" name="pass" required />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success"><i class="la la-check"></i> Masuk</button>
					</div>
				</form>
			</div>
		</div>
		<div class="login-footer">
			Copyrights &copy; <?php echo date("Y"); ?> | Solo Radio
		</div>
	</body>
	<!-- SCRIPT LOAD -->
	<script type="text/javascript" src="<?php echo base_url("assets/js/core/jquery.3.2.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/core/bootstrap.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/core/popper.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/sweetalert2.min.js"); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$("#login").on("submit",function(e){
				e.preventDefault();
				var btn = $(".btn-success").html();
				$(".btn-success").html("<i class='la la-spin la-spinner'></i> Tunggu Sebentar...");
				$.post("<?php echo site_url("ngadimin/auth"); ?>",$(this).serialize(),function(msg){
					var dt = eval("("+msg+")");
					$(".btn-success").html(btn);
					if(dt.success == true){
						swal.fire("Berhasil!","selamat datang kembali "+dt.name,"success").then(function(){
							window.location.href = "<?=site_url("ngadimin");?>";
						});
					}else{
						swal.fire("Gagal!","gagal masuk, cek kembali username & password anda","error");
					}
				});
			});
		});
	</script>
</html>