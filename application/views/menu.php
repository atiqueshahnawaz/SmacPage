<header id="header" class="fixed-top header-inner-pages">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10 d-flex align-items-center">
                <h1 class="logo mr-auto">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/final-logo.png"></a>
                </h1>
                
                <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="drop-down"><a href="javascript: void(0)">About</a>
                        <ul>
                            <li> <a href="<?php echo base_url('why-us'); ?>">WHY Us</a></li>
                            <li> <a href="<?php echo base_url('our-team'); ?>">OUR TEAM</a></li>
                        </ul>
                    </li>
                    <li class="drop-down"><a href="javascript: void(0)">Services</a>
                        <?php
                        $noof_service = $this->Common_model->noof_records("service_id","tbl_service","status=1");
                        $get_service = $this->Common_model->get_records("*","tbl_service","status=1","service_id desc");
                        if($noof_service > 0)
                        {
                        ?>
                            <ul>
                                <?php foreach ($get_service as $rowb) { ?>
                                <li> <a href="<?php echo base_url('services/'.$rowb['page_url']); ?>"><?php echo $rowb['service_name']; ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php
                        }
                        ?>
                            <!-- <li> <a href="#">DIGITAL MARKETING</a></li>
                            <li> <a href="#">PPC MANAGEMENT</a></li>
                            <li> <a href="#">SEARCH ENGINE OPTIMIZATION</a></li>
                            <li> <a href="#">MAULTILINGUAL SEO</a></li>
                            <li> <a href="#">LOCAL SEO</a></li>
                            <li> <a href="#">SOCIAL MEDIA OPTIMIZATION</a></li>
                            <li> <a href="#">CONTENT WRITING</a></li>
                            <li> <a href="#">WEB DESIGNING</a></li>
                            <li> <a href="#">WEB DEVELOPMENT</a></li>
                            <li> <a href="#">SOFTWARE DEVELOPMENT</a></li>
                            <li> <a href="#">APPS DEVELOPMENT</a></li> -->
                        
                    </li>
                    <li><a href="<?php echo base_url('portfolio'); ?>">Protfolio</a></li>
                    <li><a href="<?php echo base_url('smac-blog'); ?>">Blog</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</header>