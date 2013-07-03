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
							<li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                                <div class="dropdown-menu">
                                    <form action="<?php echo base_url();?>login/signin" method="post" accept-charset="utf-8">
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
            <br>
			<div class="container maincont">
                <div class="container-fluid">
    				<div class="row-fluid">

                        <!-- Main -->
    					<div class="well span9">
                            <div id="gallery-heading" class="well">
                                <h2>Recently uploaded images</h2>
                            </div>
                            <div class="pagination">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>                           
                            <div class="row-fluid gallery">
                                <?php if (isset($images) && count($images)):
                                    foreach($images as $image): ?>

                                    <?php
                                    $path_parts = pathinfo($image['url']);
                                    $title = "title-" . $path_parts['filename'];
                                    ?>

                                    <a class="fancybox thumbpic" data-title-id="<?php echo $title; ?>" href="<?php echo $image['medium_url']; ?>"><img src="<?php echo $image['thumb_url']; ?>" /></a>
                                    <div id="<?php echo $title; ?>" class="hidden">
                                        <a href="<?php echo $image['url']; ?>" target="_blank">View full size</a>
                                        • Uploaded by <a href="<?php echo base_url();?>user/<?php echo $image['uploader']; ?>" target="_blank"><?php echo $image['uploader']; ?></a>
                                    </div>

                                <?php endforeach; else: ?>
                                    <div id="blank_gallery"><h3>There's nothing here... yet.</h3></div>
                                <?php endif; ?>
                            </div>
                            <div class="pagination">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
    					</div>
                        <!-- Main -->

                        <!-- Sidebar -->
    					<div class="span3">
                            <div class="well sidebar-box">
        						<div id="upload-box-heading" class="well">
                                    <h3>Upload images</h3>
                                </div>
                                <div id="upload">
                                    <a class="fancybox-inline btn btn-info btn-large uploadBtn" href="#inline1" title="Upload form">
                                        <i class="icon-upload icon-white"></i> Upload images
                                    </a>
                                    <div id="inline1" class="popup">
                                        <div class="message">
                                            <form action="http://localhost:8080/ci/login/anonymousUpload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="input-append">
                                                        <div class="uneditable-input span3">
                                                            <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
                                                        </div>
                                                        <span class="btn btn-file btn-info">
                                                            <span class="fileupload-new">Select file</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input id="anonFile" type="file" name="userfile" />
                                                        </span>
                                                        <a href="#" id="anonRemoveBtn" class="btn btn-info fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                        <button id="anonupload" class="btn btn-info" type="submit" name="upload" value="Upload"><i class="icon-upload icon-white"></i> Upload</button>
                                                        <br>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="anonUploadError" class="error">
                                                <p>Incorrect filetype or size.</p>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
    					</div>

                        <div class="span3">
                            <a class="btn btn-info btn-large grooveshark" href="<?php echo base_url(); ?>musics"><img src="<?php echo base_url(); ?>/img/gs.png"> Discover music!</a>
                        </div>
                        <!-- Sidebar -->

    			    </div>
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