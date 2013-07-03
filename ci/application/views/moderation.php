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
                
                <?php if ($this->session->userdata('role') === "A"): ?>
                    <div id="gallery-heading" class="well">
                        <h2>
                        <?php echo $user->username; ?>
                        <?php if ($user->status === "active"): ?>
                        <a class="btn btn-info" href="<?php echo base_url() . "staff/ban/" . $user->username; ?>">Ban user</a>
                        <?php else :?>
                        <a class="btn btn-info" href="<?php echo base_url() . "staff/unban/" . $user->username; ?>">Unban user</a>
                        <?php endif; ?>
                        <a class="fancybox-inline btn btn-info" href="#inline_delete">Delete user</a>
                        <div id="inline_delete" class="popup">
                            <p align="center">Are you sure you want to delete this user's record and all of his images?</p>
                            <div align="center">
                                <a href="<?php echo base_url() . "staff/delete_user/" . $user->username; ?>" class="btn btn-info">Yes</a>
                                <a href="#" class="btn btn-info" onclick="$.fancybox.close()">No</a>
                            </div>                                        
                        </div>
                        </h2>                        
                    </div>
                <?php elseif ($this->session->userdata('role') === "M"): ?>
                    <div id="gallery-heading" class="well">
                        <h2>
                        <?php echo $user->username; ?>
                        <?php if ($user->status === "active"): ?>
                        <a class="btn btn-info" href="<?php echo base_url() . "staff/ban/" . $user->username; ?>">Ban user</a>
                        <?php else :?>
                        <a class="btn btn-info" href="<?php echo base_url() . "staff/unban/" . $user->username; ?>">Unban user</a>
                        <?php endif; ?>
                        </h2>                        
                    </div>
                <?php else :?>
                    <div id="gallery-heading" class="well">
                        <h2>There is no easter egg here.</h2>                        
                    </div>
                <?php endif; ?>

                <div class="pagination">
                    <?php echo $this->pagination->create_links(); ?>
                </div>


                <div class="row-fluid gallery">
                    <?php if (isset($userPics) && count($userPics)):
                        foreach($userPics as $image): ?>

                        <?php
                        $path_parts = pathinfo($image['url']);
                        $title = "title-" . $path_parts['filename'];
                        ?>
                        <div>
                        <a class="fancybox-inline thumbpic deleteables" href="#inline-<?php echo $image['name']; ?>"><img src="<?php echo $image['thumb_url']; ?>" /><div align="center">Delete</div></a>
                        </div>
                        <div id="inline-<?php echo $image['name']; ?>" class="popup">
                            <p align="center">Are you sure you want to delete this image?</p>
                            <div align="center">
                                <a href="<?php echo base_url() . "cabinet/delete_pic/" . $image['name'];?>" class="btn btn-info">Yes</a>
                                <a href="#" class="btn btn-info" onclick="$.fancybox.close()">No</a>
                            </div>                                        
                        </div>

                    <?php endforeach; else: ?>
                        <div id="blank_gallery"><h3>There's nothing here... yet.</h3></div>
                    <?php endif; ?>
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