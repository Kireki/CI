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
    </head>

    <body>
        <div>
            <div class="navbar navbar-inverse navbar-static-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="<?php echo base_url();?>">MyPicStash</a>
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                                <div class="dropdown-menu">
                                    <form action="<?php echo base_url();?>index.php/login/signin" method="post" accept-charset="utf-8">
                                        <fieldset>
                                            <input type="text" name="username" placeholder="Username...">
                                            <input type="password" name="password" placeholder="Password...">
                                            <button type="submit" name="submit" class="btn btn-info">Login</button>
                                        </fieldset>
                                    </form>  
                                </div>
                            </li>
                            <li><a href="<?php echo base_url();?>index.php/login/signup">Register</a></li>
                            <li><a href="about.html"><i class="icon-info-sign icon-white"></i>  About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container well frame">
            <div>
                <img src="<?php echo "$picture->filepath"; ?>">
            </div>            
        </div>

        <div class="container credit">
            <p>
                <?php if ($picture->uploader === "Anonymous"): ?>
                    Uploaded by anonymous
                <?php else: ?>
                    Uploaded by <a href="<?php echo base_url();?>user/<?php echo "$picture->uploader"; ?>"><?php echo "$picture->uploader"; ?></a>
                <?php endif; ?>
            </p>
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