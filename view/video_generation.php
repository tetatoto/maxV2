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
                    <input type="radio" name="gender" id="option1" autocomplete="off" value="male" checked> Male (Bob)
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="gender" id="option2" autocomplete="off" value="female"> Female (Alice)
                  </label>
                </div>

                <br><br>

                <!--The choice of the subtitles-->
                <label for="subtitlesChoice">Please choose if you want subtitles or not</label><br>
                <div class="btn-group" data-toggle="buttons" id="subtitlesChoice">
                  <label class="btn btn-primary active">
                    <input type="radio" name="subtitles" id="option1" autocomplete="off" value="yes" checked> With Subtitles
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="subtitles" id="option2" autocomplete="off" value="no"> Without Subtitles
                  </label>
                </div>

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



                <h2>IV. Run the generation of the video</h2>

                <!--This is the button that send the form to video_result-->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Generate the video</button>

                </form>

                <br><br><br><br><br><br><br><br><br><br><br><br>
                <h1>Getting the post variables</h1>
                <ul class="list-group">

                  <li class="list-group-item">URL <?php echo $url; ?></li>
                  <li class="list-group-item">KO OU PAS <?php echo $konotko; ?></li>
                  <li class="list-group-item">THEME <?php echo $theme; ?></li>
                  <li class="list-group-item">CURSOR <?php echo $logDlPics; ?></li>
                </ul>


                <h1>Parameters</h1>
                <ul class="list-group">

                  <li class="list-group-item">Male / Female</li>
                  <li class="list-group-item">Text</li>
                  <li class="list-group-item">Subtitles</li>
                </ul>


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
  </body>
</html>
