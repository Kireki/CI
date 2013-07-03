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
        <div class="container">
            <div align="center">            
                <form action="<?php echo base_url();?>musics" method="post" accept-charset="utf-8">
                    <fieldset>
                        <input class="song-search" type="text" name="song" placeholder="Enter a name of the song or an artist">
                    </fieldset>
                </form>
                <object class="player" width="600" height="400">
                    <param name="movie" value="http://grooveshark.com/widget.swf">
                    <param name="wmode" value="window">
                    <param name="allowScriptAccess" value="always">
                    <param name="flashvars" value="hostname=cowbell.grooveshark.com&amp;songIDs=<?php echo $songs ?>&amp;bbg=000000&amp;bth=000000&amp;pfg=000000&amp;lfg=000000&amp;bt=FFFFFF&amp;pbg=FFFFFF&amp;pfgh=FFFFFF&amp;si=FFFFFF&amp;lbg=FFFFFF&amp;lfgh=FFFFFF&amp;sb=FFFFFF&amp;bfg=666666&amp;pbgh=666666&amp;lbgh=666666&amp;sbh=666666&amp;p=0">
                    <embed src="http://grooveshark.com/widget.swf" type="application/x-shockwave-flash" width="250" height="250" flashvars="hostname=cowbell.grooveshark.com&amp;songIDs=<?php echo $songs ?>&amp;bbg=000000&amp;bth=000000&amp;pfg=000000&amp;lfg=000000&amp;bt=FFFFFF&amp;pbg=FFFFFF&amp;pfgh=FFFFFF&amp;si=FFFFFF&amp;lbg=FFFFFF&amp;lfgh=FFFFFF&amp;sb=FFFFFF&amp;bfg=666666&amp;pbgh=666666&amp;lbgh=666666&amp;sbh=666666&amp;p=0" allowscriptaccess="always" wmode="window">
                </object>
                <br>
                <br>
                <a class="btn btn-info btn-large" href="<?php echo base_url(); ?>">Back to images</a>
            </div>
        </div>
    </body>