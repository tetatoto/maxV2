<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Automatic Video Generation">
    <meta name="author" content="tetatoto">
    <link rel="icon" href="../../favicon.ico">

    <title>Max Index</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <style>
      .img-thumbnail {
        height: 210px;
        width: 320px;
        border: solid 1px #cccccc;
      }
    </style>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?section=index">MAX</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php?section=index">Home</a></li>
            <li class="active"><a href="index.php?section=video">Video Generator</a></li>
            <li><a href="index.php?section=about">About Max</a></li>
            <li><a href="index.php?section=contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
        <br>
        <br>
        <br>
        <br>

        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <h1>VIDEO RESULT PAGE</h1>
                <p><?php echo $finalText; ?></p>
                <audio controls>
                    <source src="model/outputs/soundFile.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio> 
                <br>
                <p><?php echo $logSound; ?></p>
                <br>

                <h1>DISPLAYING IMAGES SELECTED</h1>
                <p>Nb selected images = <?php echo $nbSelectedImages; ?></p>
                <?php 
                foreach ($selectedImages as $imagePath) {
                  ?>
                  <div class="col-lg-3">
                    <img src="<?php echo $imagePath; ?>" alt="image" class="img-thumbnail">
                  </div>
                  <?php
                }
                ?>
                <p> End displaying images </p>
                <!-- FOR TESTING -->
                <!--<p>Nb POST variable Dump = <?php //var_dump($_POST); ?></p>-->
                <br><br><br><br>
                <!-- FOR TESTING -->
                <p>Result Video Creation <?php var_dump($runVideoCreationScript); ?></p>

                <br><br><br><br>

                <video width="640" height="360" controls>
                  <source src="model/outputs/generated_video_step2.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video> 

            </div><!-- /.col-lg-12 -->
        </div><!-- /.row --> 





    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
