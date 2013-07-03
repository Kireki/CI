<!DOCTYPE html>
<html lang="en">
    <head>      
    <meta charset="UTF-8">
    <title>Initial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fancyBox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css">

    </head>

    <body>
        <div>
            <div class="navbar navbar-inverse navbar-static-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="<?php echo base_url();?>">MyPicStash</a>
                        <ul class="nav pull-right">
                            <li><a href="<?php echo base_url();?>cabinet"><?php echo $this->session->userdata('username'); ?></a></li>
                            <li><a href="<?php echo base_url();?>login/logout">Logout</a></li>
                            <li><a href="about.html"><i class="icon-info-sign icon-white"></i>  About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="well container main-gallery">
                <div id="gallery-heading" class="well">
                    <h2><?php echo $username; ?>'s images</h2>
                </div>
                <div class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>                            
                <div class="row-fluid gallery picRowsBig">
                    <?php if (isset($userPics) && count($userPics)):
                        foreach($userPics as $image): ?>

                        <?php
                        $path_parts = pathinfo($image['url']);
                        $title = "title-" . $path_parts['filename'];
                        ?>

                        <a class="fancybox thumbpic" data-title-id="<?php echo $title; ?>" href="<?php echo $image['medium_url']; ?>"><img src="<?php echo $image['thumb_url']; ?>" /></a>
                        <div id="<?php echo $title; ?>" class="hidden">
                            <a href="<?php echo $image['url']; ?>" target="_blank">View full size</a>
                        </div>

                    <?php endforeach; else: ?>
                        <div id="blank_gallery"><h3>There's nothing here... yet.</h3></div>
                    <?php endif; ?>
                </div>
                <div class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
        
        <script src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>fancyBox/source/jquery.fancybox.js?v=2.1.4"></script>
        <script type="text/javascript" src="<?php echo base_url();?>fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <script src="<?php echo base_url();?>js/bootstrap-fileupload.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>
    </body>
</html>