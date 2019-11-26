<?php	
	if($db->num_rows() > 0){
		foreach($db->result() as $r){
?>
    <!-- Content -->
    <div class="section-padding-150-0">
        <div class="container m-b-100">
            <!-- Container -->
            <div class="row">
                <div class="col-md-8 main-content">
					<?php if(strpos($r->thumbnail,"soloradio") == true){ ?>
						<img src='<?=$r->thumbnail?>' width="100%" />
					<?php }else{ ?>
						<div class="video-iframe">
							<iframe width="500" height="315" src="https://www.youtube.com/embed/<?=$thumb[0]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					<?php } ?>
                    <!-- Description -->
                    <div class="m-t-40">
                        <h3 class="m-b-30"><?=$r->judul?></h3>
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
                                    <a href="#"><?=$this->func->kategori($r->kategori)?></a>
                                </li>
                            </ul>
                        </div>
                        <p class="m-text1">
							<?=$r->konten?>
						</p>
                    </div>

                    <!-- Share Post -->
                    <div class="m-t-20">
                        <div class="m-b-20" style="border-top:1px solid #f1f1f1"></div>
                        <h5 class="m-b-20">Share This Post</h5>
                        <div class="list-share-wrap">
                            <ul class="list-share">
                                <li class="twitter">
                                    <a href="#"><i class="fa fa-twitter p-r-20"></i><span>Twitter</span></a>
                                </li>
                                <li class="facebook">
                                    <a href="#"><i class="fa fa-facebook p-r-20"></i><span>Facebook</span></a>
                                </li>
                                <li class="whatsapp">
                                    <a href="#"><i class="fa fa-whatsapp p-r-20"></i><span>Whatsapp</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 content-sidebar border-left">
                    <div class="item-widget m-b-40">
                        <h4 class="widget-title-sidebar">New Event</h4>
                        <!-- list maksimal 3 berita terbaru -->
                        <ul class="widget-list">
                            <?=$this->func->getEventUpdate(2)?>
                        </ul>
                    </div>

                    <div class="item-widget m-b-40">
                        <h4 class="widget-title-sidebar">Famous Update</h4>
                        <!-- list maksimal 3 berita terbaru -->
                        <ul class="widget-list">
                            <?=$this->func->getFamousUpdate(2)?>
                        </ul>
                    </div>
                    
                    <div class="item-widget m-b-40">
                        <h4 class="widget-title-sidebar">Fit Update</h4>
                        <!-- list maksimal 3 berita terbaru -->
                        <ul class="widget-list">
                            <?=$this->func->getFitUpdate(2)?>
                        </ul>
                    </div>

                    <div class="item-widget m-b-20">
                         <h4 class="widget-title-sidebar">Fashionable Update</h4>
                        <!-- list maksimal 3 berita terbaru -->
                        <ul class="widget-list">
                            <?=$this->func->getFashionableUpdate(2)?>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php
		}
	}else{
		redirect("404_notfound");
	}
?>