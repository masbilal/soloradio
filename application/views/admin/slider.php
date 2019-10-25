<a href="<?=site_url("ngadimin/sliderform")?>" class="btn btn-warning float-right"><i class="la la-plus-circle"></i> Slider Baru</a>
<h4 class="page-title">Daftar Slider Foto</h4>
<div class="card">
	<div class="card-body">
		<i class="la la-spin la-spinner"></i> Loading data...
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$(".card-body").load("<?=site_url("ngadimin/slider?load=true")?>");
	});
	
	function refreshTabel(page){
		$(".card-body").load("<?=site_url("ngadimin/slider?load=true&page=")?>"+page);
	}
	
	function hapus(id){
		swal.fire({
			title: "Yakin menghapus?",
			text: "data yang sudah dihapus tidak akan bisa dikembalikan",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Batal",
			confirmButtonText: "Oke"
		}).then((val)=>{
			if(val.value == true){
				$.post("<?=site_url("ngadimin/hapusslider")?>",{"theid":id},function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal.fire("Berhasil","data telah dihapus","success").then((val)=>{
							window.location.href="<?=site_url("ngadimin/slider")?>";
						});
					}else{
						swal.fire("Gagal!","gagal menghapus data, cobalah beberapa saat lagi","error");
					}
				});
			}
		});
	}
</script>