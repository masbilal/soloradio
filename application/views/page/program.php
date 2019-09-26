
    <div class="section-padding-150-0">
        <div class="container m-b-100">
            <div class="program-slides owl-carousel">
				<?php
					$this->db->where("utama",0);
					$db = $this->db->get("program");
					foreach($db->result() as $r){
				?>
                <div class="item single-music-player">
                    <img src="<?=base_url("assets/uploads/".$r->foto); ?>" alt="" />
                    <div class="inner">
						<?php if($r->audio != ""){ ?>
							<audio id="track">
								<source src="<?=base_url("assets/uploads/".$r->audio); ?>"/>
							</audio>
							<div id="player-container">
								<div id="play-pause" class="play"></div>
							</div>
						<?php } ?>
                    </div>
                </div>
				<?php
					}
				?>
            </div>

            <div class="m-t-40" style="border-top: 2px solid #ddd;"></div>
            <div class="schedule m-t-20 text-center">
				<img src="<?=base_url("assets/img/head-program.png")?>" class="m-b-20" style="max-height:40px;width:auto;max-width:80%;">
                <img src="<?=$this->func->getProgramUtama()?>">
            </div>
            <div class="m-t-40" style="border-top: 2px solid #ddd;"></div>
            <div class="dj m-t-40">
                <h3 class="l-text3 text-center">DJ & Crews</h3>
                <div class="m-t-40">
                    <div class="dj-block">
                        <div class="row">
							<?php
								$dbs = $this->db->get("penyiar");
								foreach($dbs->result() as $r){
							?>
                            <div class="col-md-3 col-6 m-b-10">
                                <div class="content">
                                    <h4 class="content-title"><?=$r->nama?></h4>
                                    <div class="content-overlay"></div>
                                    <img class="content-image" src="<?=base_url("assets/uploads/".$r->foto)?>">
                                    <div class="content-details fadeIn-bottom">
										<?=$r->detail?>
                                    </div>
                                </div>
                            </div>
							<?php
								}
							?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>