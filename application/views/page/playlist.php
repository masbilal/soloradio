    <div class="section-padding-150-0">
        <div class="container m-b-100">
            <!-- <div class="row">
                <div class="col-md-12">
                    <h3 class="l-text2">Playlist</h3>
                </div>
            </div> -->
            <div class="row">
                <!-- <div class="col-md-1"></div> -->
                <div class="col-md-2">
                    <div class="bg-playlist">
                        <img src="<?=base_url("assets/themev2/img/disc.png")?>">
                    </div>
                </div>
                <div class="col-md-10 m-t-10">
					<div class="row m-lr-0">
					<?php
						$this->db->where("status",1);
						$db = $this->db->get("topsong");
						$no = 1;
						$topsong = 0;
						foreach($db->result() as $r){
							if($no == 1){ $topsong = $r->id; $ts = "active"; }else{ $ts = ""; }
							echo "
								<h5 class='topsong col-md-4 col-6 ".$ts."' data-pushup='".$r->id."'>".$r->nama."</h5>
							";
							$no++;
						}
					?>
					</div>
                    <div class="table-responsive m-t-20">          
                        <table class="table">
                            <thead class="bg-yellow text-center">
                                <tr>
                                    <th></th>
                                    <th>Song</th>
                                    <th>Artist</th>
                                    <th>Label</th>
                                </tr>
                            </thead>
                            <tbody class="table-body text-center" id="load">
                                <tr>
                                    <td colspan=4>
										<i class="la la-spin la-spinner"></i> &nbsp;Memuat Playlist...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<script type="text/javascript">
		$(function(){
			$("#load").load("<?=site_url("pages/loadplaylist/".$topsong)?>");
			
			$(".topsong").click(function(){
				$(".topsong.active").removeClass("active");
				$("#load").html('<tr><td colspan=4><i class="la la-spin la-spinner"></i> &nbsp;Memuat Playlist...</td></tr>');
				$("#load").load("<?=site_url("pages/loadplaylist")?>/"+$(this).data("pushup"));
				$(this).addClass("active");
			});
		});
	</script>