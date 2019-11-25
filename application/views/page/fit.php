    <div class="section-padding-150-0">
        <div class="container m-b-100">
		<?php
			$this->db->where("kategori",3);
			$db = $this->db->get("postingan");
			foreach($db->result() as $r){
				if($r->linkyt != ""){
					$thumb = explode("v=",$r->linkyt);
					$thumb = explode("&",$thumb[1]);
				}
		?>
            <div class="row m-b-50">
				<?php if(strpos($r->thumbnail,"soloradio") == true){ ?>
					<div class="col-md-6">
						<img src='<?=$r->thumbnail?>' class='thumbnail-post' />
					</div>
				<?php }else{ ?>
					<div class="col-md-6 video-iframe">
						<iframe width="500" height="315" src="https://www.youtube.com/embed/<?=$thumb[0]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				<?php } ?>
                <div class="col-md-6">
					<h3 class="m-t-20 m-b-20"><?=$r->judul?></h3>
					<div class="m-b-20">
						<ul class="meta clr">
							<li class="meta-author">
								<i class="lnr lnr-user p-r-5"></i>
								<a href="#"><?=$this->func->getUser($r->usrid,"nama")?></a>
							</li>
							<li class="meta-date">
								<i class="lnr lnr-clock p-r-5"></i>
								<a href="#"><?=$this->func->ubahTgl("D, d M Y",$r->tgl)?></a>
							</li>
							<li class="meta-tag">
								<i class="lnr lnr-tag p-r-5"></i>
								<a href="#">Fit Update</a>
							</li>
						</ul>
					</div>
					<p class="m-t-20 m-text1"><?=$this->func->potong(strip_tags($r->konten),300,"...")?> 
						<a href="<?=site_url("post/".$r->url)?>" class="m-t-20" style="font-size: 16px;">Selengkapnya</a>
					</p>
                </div>
                </div>
            </div>
		<?php
			}
			
			if($db->num_rows() == 0){
				echo "
					<div class='text-center'>
						<img class='p-t-100 m-b-20' src='".base_url('assets/img/headphone.png')."' style='width: 200px;'/>
						<p class='m-text1'>Ups, Belum ada info terbaru.</p>
						<a href='".site_url()."'>Kembali Ke Beranda</a>
					</div>
				";
			}
		?>
        </div>
    </div>