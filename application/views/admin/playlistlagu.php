<ol class="lagu">
	<?php
		$id = isset($_GET["theid"]) ? intval($_GET["theid"]) : 0;
		$this->db->where("topid",$id);
		$db = $this->db->get("song");
		
		if($db->num_rows() > 0){
			foreach($db->result() as $r){
				echo "
					<li class='song_".$r->id."'>
						<input type='hidden' name='song[]' value='".$r->id."' />
						<a href='javascript:hapusLagu(".$r->id.")' class='delete float-right text-danger'><i class='la la-trash'></i> hapus</a>
						<i class='la la-navicon'></i>&nbsp; 
						".strtoupper($r->judul." - ".$r->artis)."
					</li>
				";
			}
		}
	?>
</ol>
<?php
	if($db->num_rows() == 0){
		echo '<b class="text-danger">belum ada lagu, tambahkan lagu terlebih dahulu.</b>';
	}
?>

<script type="text/javascript">
	$(function(){
		$(".lagu").sortable({
			nested: false
		});
	});
	
	function hapusLagu(theid){
		swal.fire({
			title: "Yakin menghapus?",
			text: "data yang sudah dihapus tidak akan bisa dikembalikan",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Batal",
			confirmButtonText: "Oke"
		}).then((val)=>{
			if(val.value == true){
				var tombol = $(".delete").html();
				$(".delete").html("<i class='la la-spin la-spinner'></i>&nbsp;menyimpan...");
				$(".delete").prop("disabled",true);
					
				$.post("<?=site_url("ngadimin/hapuslagu")?>",{"theid":theid},function(e){
					var data = eval("("+e+")");
					
					$(".delete").html(tombol);
					$(".delete").prop("disabled",false);
					if(data.success == true){
						$(".song_"+theid).remove();
					}else{
						swal.fire("Gagal","terjadi kesalahan saat menghapus lagu, cobalah beberapa saat lagi","error");
					}
				});
			}
		});
	}
</script>