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

    <!-- Custom style with a fiew things (USELESS NOW)-->
    <!--<link href="view/max.css" rel="stylesheet">-->

    <style>
      .check
      {
          opacity:0.5;
          color:#996;
      }

      .img-thumbnail {
        height: 220px;
        width: 330px;
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
            <?php if (!$konotko) {
                ?>
                <div class="alert alert-danger" role="alert"><strong>Fail !</strong> This is not a valid URL. Please try again ! </div>                
                <?php
              }
              elseif (!$isTextPresent) {
                ?>
                <div class="alert alert-danger" role="alert"><strong>Fail !</strong> The URL is valid, but Max cannot retrieve the text of the article. Please try an other URL. </div>                
                <?php
              }
              else {
                ?>
                <div class="alert alert-success" role="alert"><strong>Success !</strong> The URL is correct</div>
                <div class="page-header">
                  <h1>Video Generation Parameters <small>Please set your preferences</small></h1>
                </div>
                

                <!--We propose the choice between the default parameters and a manual selection-->
                <!--<div class="btn-group btn-group-justified" role="group" aria-label="...">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">Manual Settings</button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">Default Settings</button>
                  </div>
                </div>-->

                <form action="index.php?section=video_result" method="POST" >

                <h2>I. Options</h2>

                <!--The choice of the gender of the presentator-->
                <label for="genderChoice">Please choose the gender of your presentator</label><br>
                <div class="btn-group" data-toggle="buttons" id="genderChoice">
                  <label class="btn btn-primary active">
                    <input type="radio" name="male" id="option1" autocomplete="off" value="male"> Male (Bob)
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="female" id="option2" autocomplete="off" value="female"> Female (Alice)
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="female2" id="option3" autocomplete="off" value="female2"> Female (Mary)
                  </label>
                </div>

                <br><br>

                <!--The choice of the subtitles NOT WORKING YET-->
                <!-- <label for="subtitlesChoice">Please choose if you want subtitles or not</label><br>
                <div class="btn-group" data-toggle="buttons" id="subtitlesChoice">
                  <label class="btn btn-primary active">
                    <input type="radio" name="subtitles" id="option1" autocomplete="off" value="yes" checked> With Subtitles
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="subtitles" id="option2" autocomplete="off" value="no"> Without Subtitles
                  </label>
                </div> -->

                <label for="title">Please enter the title you want</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Ex : James bond is the new black" id="title" name="title">
                </div><!-- /input-group -->


                <br><br><br><br>

                <h2>II. Select the script you want for your video</h2>

                <br><br>

                <div class="panel panel-default col-lg-12">
                    <!-- Default panel contents -->
                    <div class="panel-heading row">
                      <div class="col-lg-12">
                      <h3>Text Found</h3>
                      Please choose the text you want to keep on your script.
                      </div>
                    </div>
                    <!-- List group -->
                    <ul class="list-group">
                    <?php
                    $cursor=0;
                    foreach ($paragraphs as $paragraph) {
                      // We don't display the strings with less than 5 characters
                      if ($paragraph['size'] > 5) {
                        $paragraphName = 'p'.$cursor;
                        $cursor++;
                        // We make the difference between the small and the big strings
                        if ($paragraph['size'] > 35) {
                          ?>
                          <li class="list-group-item list-group-item-success row">
                            <div class="col-lg-1">
                              <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="<?php echo htmlspecialchars($paragraphName) ?>" value="<?php echo $paragraph['text'] ?>" checked>
                                <span class="custom-control-indicator"></span>
                              </label>
                            </div>

                            <div class="col-lg-10">
                              <?php echo $paragraph['text'] ?>
                            </div>

                            <div class="col-lg-1">
                              <span class="badge">
                                <?php echo htmlspecialchars($paragraph['size']) ?> words
                              </span>
                            </div>

                          </li>
                          <?php
                        } 
                        else {
                          ?>
                          <li class="list-group-item list-group-item-danger row">
                            <div class="col-lg-1">
                              <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="<?php echo htmlspecialchars($paragraphName) ?>" value="<?php echo $paragraph['text'] ?>">
                                <span class="custom-control-indicator"></span>
                              </label>
                            </div>

                            <div class="col-lg-10">
                              <?php echo $paragraph['text'] ?>
                            </div>

                            <div class="col-lg-1">
                              <span class="badge">
                                <?php echo htmlspecialchars($paragraph['size']) ?> words
                              </span>
                            </div>

                          </li>
                          <?php
                        }
                      }
                    }
                    ?>
                    </ul>
                </div>

                <br><br><br><br>

                <h2>III. Select the pictures you want for your video</h2>

                <br><br>

                <div class="row">
                  
                  <!-- Here we display all the images found -->
                  <?php
                  for ($j=0; $j < $nbPicturesDl; $j++) { 
                    $currentName = 'model/outputs/image'.$j.'.jpg';
                    ?>
                    <div class="col-lg-3">
                      <!--<div class="thumbnail" >-->
                        <!--<img src="" alt="image" style="height:100px;">-->
                        <div class="form-group">
                          <!--<h3>Thumbnail label</h3>
                          <p>Blablabla</p>-->
                          <label class="btn btn-primary">
                            <img src="<?php echo $currentName; ?>" alt="image" class="img-thumbnail img-check">
                            <input type="checkbox" class="hidden" name="<?php echo $currentName; ?>" value="<?php echo $currentName; ?>" autocomplete="off">
                            <!--<span class="custom-control-indicator"></span>-->
                          </label>
                        </div>
                      <!--</div>-->
                    </div>
                    <?php
                  }
                  ?>
                  
                </div>

                <h2>IV. Run the generation of the video</h2>

                <!--This is the button that send the form to video_result-->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Generate the video (This might takes a few minutes !)</button>

                
                <br><br><br><br><br>

                </form>

                <!--UNCOMMENT THE FOLLOWING LINES FOR TESTING-->
                <!--<br><br><br><br><br><br><br><br><br><br><br><br>
                <h1>Getting the post variables</h1>
                <ul class="list-group">

                  <li class="list-group-item">URL <?php //echo $url; ?></li>
                  <li class="list-group-item">KO OU PAS <?php //echo $konotko; ?></li>
                  <li class="list-group-item">THEME <?php //echo $theme; ?></li>
                  <li class="list-group-item">PictureUrls <?php //var_dump($pictureUrls); ?></li>
                  <li class="list-group-item">Nb pictures DL  <?php //echo $nbPicturesDl; ?></li>
                  <li class="list-group-item">resultResizing  <?php //echo $resultResizing; ?></li>
                </ul> -->
                <!--END TESTING-->

                <?php
              }
              ?>
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

    <!-- Image Checking -->
    <script>
      $(document).ready(function(e){
            $(".img-check").click(function(){
            $(this).toggleClass("check");
          });
      });  
    </script>
  </body>
</html>
