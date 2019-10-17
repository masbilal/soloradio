
    <script type="text/javascript">
        setTimeout(function(){
            document.getElementById('myimage').style.display = 'block';
        },6000);
    </script>

    <!-- Footer -->
    <!-- <footer class="footer-area section-padding-150-0 p-t-20 p-b-20">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-widget-area">
                        <p class="copywrite-text">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved. Developed by Solo Radio
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

     <footer class="footer-area section-padding-50-0">
        <div class="container-fluid">
            <div class="row">

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="footer-widget-area mb-50">
                        <a href="#"><img src="<?=base_url("assets/img/logo.png")?>" style="width:200px;" /></a>
                        <p class="copywrite-text m-t-15"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> by Solo Radio</a
</p>
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="footer-widget-area mb-50">
                        <div class="widget-title">
                            <h4>Menu</h4>
                        </div>
                        <nav>
                            <ul class="footer-nav">
                                <li>
                                    <a href="<?php echo site_url(); ?>">Home</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("playlist"); ?>">Playlist</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("program"); ?>">Program</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("makeitdigital"); ?>">Make It Digital</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("event"); ?>">Event</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url("aboutus"); ?>">About Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="footer-widget-area mb-50">
                        <div class="widget-title">
                            <h4>Contact Us</h4>
                        </div>
                        <nav>
                            <ul class="footer-nav">
                                <li>Jl. Menteri Supeno, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139</li>
                                <li>Phone: +62 816 675 010</li>                            
                            </ul>
                            <div class="icon-social">
                                <h5 class="m-b-20">Follow Us: </h5>
                                <a href="https://twitter.com/solo_radio" class="icon-social p-r-10" title="Twitter"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.facebook.com/soloradio929FM/" class="icon-social p-r-10" title="Facebook"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/solo_radio" class="icon-social p-r-10" title="Instagram"><i class="fa fa-instagram"></i></a>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="ccol-12 col-md-6 col-xl-3">
                    <div class="footer-widget-area mb-50">
                        <div class="widget-title">
                            <h4>Subscribe Our Channel</h4>
                        </div>
                        <div>
                            <iframe width="100%" height="200" src="https://www.youtube.com/embed/Mfo95nVlWv8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </footer>
    
    <!-- Popper js -->
    <script src="<?php echo base_url("assets/themev2/js/bootstrap/popper.min.js"); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url("assets/themev2/js/bootstrap/bootstrap.min.js"); ?>"></script>
    <!-- All Plugins js -->
    <script src="<?php echo base_url("assets/themev2/js/plugins/plugins.js"); ?>"></script>
    <!-- Active js -->
    <script src="<?php echo base_url("assets/themev2/js/active.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery-sortable.js"); ?>"></script>
</body>

</html>