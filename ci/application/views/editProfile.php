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
            <div class="container maincont">
                <div class="container-fluid">
                    <div class="row-fluid">

                    <!-- Sidebar -->
                        <div class="span3">
                            <div class="well sidebar-box">
                                <div id="upload-box-heading" class="well">
                                    <h3><?php echo $this->session->userdata('username'); ?></h3>
                                </div>
                                <ul class="nav nav-pills nav-stacked menu-entries">
                                    <li>
                                        <a href="<?php echo base_url();?>cabinet">Overview</a>
                                    </li>
                                    <li  class="active">
                                        <a href="#">Edit profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>cabinet/delete">Delete images</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>cabinet/search">Find user</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>index.php/login/logout">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <!-- Sidebar -->

                    <!-- Main -->
                        <div class="well span9 sidebar-box" style="margin-right:-80px; margin-left:80px;">
                        
                            <div id="upload-box-heading" class="well">
                                <h3>Edit profile</h3>
                            </div>

                            <form action="<?php echo base_url();?>cabinet/changePass" method="post" accept-charset="utf-8">
                                <fieldset>

                                    <legend>Change password</legend>
                                    <label>Old password</label>
                                    <input type="password" name="oldPass">
                                    <div class="error">
                                        <?php echo form_error('oldPass'); ?>
                                    </div>
                                    <label>New password</label>
                                    <input type="password" name="newPass">
                                    <div class="error">
                                        <?php echo form_error('newPass'); ?>
                                    </div>
                                    <label>Re-type new password</label>
                                    <input type="password" name="newPass2">
                                    <div class="error">
                                        <?php echo form_error('newPass2'); ?>
                                    </div>
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-info">Change</button>

                                </fieldset>
                            </form>

                        </div>
                    <!-- Main -->

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