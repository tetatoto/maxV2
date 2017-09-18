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
                <!-- The text -->
                <h2>This is the script of your video :</h2>
                <p><?php echo $finalText; ?></p>
                <!-- The sound file .mp3 -->
                <h2>This is your sound file :</h2>
                <audio controls>
                    <source src="model/outputs/soundFile.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio> 
                <br>

                <!-- FOR TESTING -->
                <!-- <p><?php //echo $logSound; ?></p>
                <br> -->
                <!-- END TESTING -->

                <!-- Images selected -->
                <h2>You selected the following images : </h2>
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
                <br><br><br><br>

                <!-- FOR TESTING -->

                <p>Nb POST variable Dump = <?php var_dump($_POST); ?></p>
                <p>Add Title Logs variable Dump = <?php var_dump($runAddTitle); ?></p>

                <!-- <div class="col-lg-12">
                <h2>  Result Video Creation </h2>
                <p> <?php //var_dump($runVideoCreationScript); ?></p> -->

                <!-- <br><br><br><br> -->
                
                <!-- <h2>GENERATED VIDEO 1</h2>
                <video width="640" height="360" controls>
                  <source src="model/outputs/generated_video_step1.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video> 

                <h2>GENERATED VIDEO 2</h2>
                <video width="640" height="360" controls>
                  <source src="model/outputs/generated_video_step2.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video> -->

                <!-- END TESTING -->
            </div>
            <div class="col-lg-12">
                <!-- Final Video Displayed -->
                <h2>Here is your video !</h2>
                <video width="640" height="360" controls>
                  <source src="<?= "model/outputs/".$finalVideoName ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>

                <h2>You can upload it on your YouTube channel (in private)</h2>

                <form action="index.php?section=video_upload" method="POST" >

                  <label for="privacyChoice">Please choose the gender of your presentator</label><br>
                  <div class="btn-group" data-toggle="buttons" id="privacyChoice">
                    <label class="btn btn-primary">
                      <input type="radio" name="privacy" id="option1" autocomplete="off" value="private" checked> PRIVATE
                    </label>
                    <label class="btn btn-primary">
                      <input type="radio" name="privacy" id="option2" autocomplete="off" value="public"> PUBLIC
                    </label>
                  </div>

                  <label for="youtubeTitle">Please enter the title you want</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Ex : James bond is the new black" id="youtubeTitle" name="youtubeTitle">
                  </div>

                  <select name="cars">
                    <option value="2">Cars and Vehicles</option>
                    <option value="23">Comedy</option>
                    <option value="27">Education</option>
                    <option value="24">Entertainment</option>
                    <option value="1">Film and Animation</option>
                    <option value="20">Gaming</option>
                    <option value="24">How-to and Style</option>
                    <option value="24">Music</option>
                    <option value="24">News and politics</option>
                    <option value="24">Non-profits and Activism</option>
                    <option value="24">People and blogs</option>
                    <option value="24">Pets and animals</option>
                    <option value="24">Science and technology</option>
                    <option value="24">Sport</option>
                    <option value="24">travel and events</option>
                  </select>

                  descreiption, categoryid,
                    2 - Cars & Vehicles
    23 - Comedy
    27 - Education
    24 - Entertainment
    1 - Film & Animation
    20 - Gaming
    26 - How-to & Style
    10 - Music
    25 - News & Politics
    29 - Non-profits & Activism
    22 - People & Blogs
    15 - Pets & Animals
    28 - Science & Technology
    17 - Sport
    19 - Travel & Events

                  <a href=<?= "index.php?section=video_upload&title=".$finalVideoName ?> ><button type="submit" class="btn btn-primary btn-lg btn-block" >Upload the video on YouTube </button></a>
                </form>
                <!-- <h2>  Result Video Creation </h2> -->
                <p> <?php //var_dump($runAddPicturesScript); ?></p>
                </div>
                <br><br>
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
