

    <div class="section-padding-150-0">
        <!-- Youtube Playlist-->
        <div class="container-iframe m-b-100">
			<div class="m-b-30">
				<img src="<?=base_url("assets/img/logo-sora.png")?>" style="max-width:30%;width:180px;" />
			</div>
			<?php
				$this->db->where("kategori",1);
				$this->db->order_by("id DESC");
				$db = $this->db->get("postingan");
				$no = 1;
				$total = $db->num_rows();
				
				foreach($db->result() as $r){
					if($no == 1){
						$thumb = explode("v=",$r->linkyt);
						$thumb = explode("&",$thumb[1]);
			?>
				<!-- Container -->
				<div class="vid-container">
					<iframe id="vid_frame" width="560" height="315" src="https://www.youtube.com/embed/<?=$thumb[0]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>

				<!-- Playlist -->
				<div class="vid-list-container owl-carousel">
			<?php
					}
			?>
					<div class="item vid-list">
						<div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/<?=$thumb[0]?>?autoplay=1&rel=0&showinfo=0&autohide=1'">
							<div class="thumb">
								<img src="<?=$r->thumbnail?>">
							</div>
							<div class="desc">
								<?=$r->judul?>
							</div>
						</div>
					</div>
			<?php
					if($no == $total){
			?>
				</div> 
			<?php
					}
					$no++;
				}
			?>
            
            <!-- Description -/->
            <div class="m-t-40" style="border-top: 2px solid #ddd;"></div>
            <div class="m-t-40">
                <p class="m-text1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p class="m-text1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
			-->
        </div>
    </div>