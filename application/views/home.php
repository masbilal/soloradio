
    <section class="hero-area">
        <div class="hero-slides owl-carousel" style="position: relative;">
			<?php
				$this->db->order_by("id","DESC");
				$db = $this->db->get("slider");
				foreach($db->result() as $r){
			?>
				<div class="single-hero-slide d-flex align-items-center justify-content-center">
					<div class="slide-img bg-img" style="background-image: url(<?php echo base_url("assets/uploads/slider/".$r->foto); ?>);"></div>
				</div>
			<?php } ?>
        </div>

        <div class="box-social">
            <div class="icon-footer">
                <a href="https://www.youtube.com/channel/UCB2GHa_jRssHLAo0Sl7ohHg/" class="icon-social p-r-40"><i class="fa fa-youtube"></i></a>
                <a href="https://wa.me/+62816675010" class="icon-social p-r-40"><i class="fa fa-whatsapp"></i></a>
                <a href="https://twitter.com/solo_radio" class="icon-social p-r-40"><i class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com/soloradio929FM/" class="icon-social p-r-40"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/solo_radio" class="icon-social p-r-40"><i class="fa fa-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCB2GHa_jRssHLAo0Sl7ohHg/" class="icon-social"><i class="fa fa-play"></i></a>
            </div>
        </div>

        <!-- <div class="box-mascot">
            <div class="image-mascot">
                <img id="myimage" src="img/515372-PIDQIJ-217.jpg" style="display: none;">
            </div>
        </div> -->
    </section>