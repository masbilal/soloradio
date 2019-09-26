<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Soloradio Dashboard Management</title>
	<link rel="shortcut icon" type="image/png" href="<?=base_url("assets/img/logo.png")?>"/>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/sweetalert2.min.css"); ?>" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/ready.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/minmin.css">
	
	<!-- IMPORTANT JS -->
	<script src="<?=base_url()?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/pa3llg12ezvnxollin25u4ddg7d95nj77s2o7hvjhh1tkgir/tinymce/5/tinymce.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="<?=site_url()?>" class="logo">
					Soloradio Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<img src="<?=base_url()?>/assets/img/profil/<?=$this->func->getUser($_SESSION['usrid'],'profil')?>" alt="user-img" width="36" class="img-circle">
								<span><?=$this->func->getUser($_SESSION["usrid"],"nama")?></span></span>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<a class="dropdown-item" href="<?=site_url("ngadimin/gantipass")?>"><i class="la la-unlock"></i> Ganti Password</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?=site_url("ngadimin/logout")?>"><i class="la la-power-off"></i> Logout</a>
							</ul>
							<!-- /.dropdown-user -->
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<ul class="nav">
					<li class="nav-item <?php echo (isset($menu) AND $menu == 1) ? "active" : "" ?>">
						<a href="<?=site_url("ngadimin")?>">
							<i class="la la-dashboard"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item <?php echo (isset($menu) AND $menu == 2) ? "active" : "" ?>">
						<a href="<?=site_url("ngadimin/postupdate")?>">
							<i class="la la-comment"></i>
							<p>Post Update</p>
						</a>
					</li>
					<li class="nav-item <?php echo (isset($menu) AND $menu == 3) ? "active" : "" ?>">
						<a href="<?=site_url("ngadimin/postmakeit")?>">
							<i class="la la-laptop"></i>
							<p>Make It Digital</p>
						</a>
					</li>
					<li class="nav-item <?php echo (isset($menu) AND $menu == 4) ? "active" : "" ?>">
						<a href="<?=site_url("ngadimin/playlist")?>">
							<i class="la la-play-circle"></i>
							<p>Playlist</p>
						</a>
					</li>
					<li class="nav-item <?php echo (isset($menu) AND $menu == 5) ? "active" : "" ?>">
						<a href="<?=site_url("ngadimin/program")?>">
							<i class="la la-calendar"></i>
							<p>Programs</p>
						</a>
					</li>
					<li class="nav-item <?php echo (isset($menu) AND $menu == 6) ? "active" : "" ?>">
						<a href="<?=site_url("ngadimin/penyiar")?>">
							<i class="la la-microphone"></i>
							<p>DJ & Crew</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">