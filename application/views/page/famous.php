    <div class="section-padding-150-0">
        <div class="container m-b-100">
		<?php
			$this->db->where("kategori",2);
			$db = $this->db->get("postingan");
			foreach($db->result() as $r){
		?>
            <div class="row m-b-50">
                <div class="col-md-6">
                    <iframe width="100%" height="250" src="https://www.youtube.com/embed/<?=$r->thumbnail?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">
                    <h3 class="m-b-10"><?=$r->judul?></h3>
                    <p class="m-text1"><?=$this->func->potong(strip_tags($r->konten),300,"...")?></p>
                </div>
            </div>
		<?php
			}
			
			if($db->num_rows() == 0){
				echo "
					<div class='text-center'>
						Belum ada info terbaru.<br/>
						<a href='".site_url()."'>Kembali Ke Beranda</a>
					</div>
				";
			}
		?>
        </div>
    </div>