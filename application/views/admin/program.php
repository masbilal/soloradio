<a href="<?=site_url("ngadimin/programform")?>" class="btn btn-warning float-right"><i class="la la-plus-circle"></i> Program Baru</a>
<h4 class="page-title">Daftar Program</h4>
<div class="card">
	<div class="card-body">
		<i class="la la-spin la-spinner"></i> Loading data...
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$(".card-body").load("<?=site_url("ngadimin/program?load=true")?>");
	});
	
	function refreshTabel(page){
		$(".card-body").load("<?=site_url("ngadimin/program?load=true&page=")?>"+page);
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
				$.post("<?=site_url("ngadimin/hapusprogram")?>",{"theid":id},function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal.fire("Berhasil","data telah dihapus","success").then((val)=>{
							window.location.href="<?=site_url("ngadimin/program")?>";
						});
					}else{
						swal.fire("Gagal!","gagal menghapus data, cobalah beberapa saat lagi","error");
					}
				});
			}
		});
	}
</script>