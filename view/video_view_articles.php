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

        <div class="row">
            <div class="col-lg-12">
                <?php if ($nbArticles > 0) {
                  ?>
                    <div class="alert alert-success" role="alert"><strong>Success !</strong> Max has found <?php echo $nbArticles; ?> articles</div>
                    <div class="page-header">
                      <h1>Articles found <small>Please choose one of them</small></h1>
                    </div>
                  <?php
                }
                else {
                  ?>
                    <div class="alert alert-danger" role="alert"><strong>Fail !</strong> Max did not found any articles</div>                
                  <?php
                }
                ?>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row --> 

        <div class="row">
            <div class="col-lg-12">
                <?php 
                foreach ($articles as $article) {
                  ?>
                  <div class="panel panel-default">
                    <!--Title containing the link to the article & button to run the creation of the video-->
                    <div class="panel-heading">
                      <form action="index.php?section=video_generation" method="POST" class="form-inline">
                        <div class="form-group">
                          <h3 class="panel-title"><?php echo $article['link']; ?></h3>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="title" value="<?php echo htmlspecialchars($article['title']) ?>"/>
                          <input type="hidden" name="link" value="<?php echo htmlspecialchars($article['link']) ?>"/>
                          <input type="hidden" name="text" value="<?php echo htmlspecialchars($article['text']) ?>"/>
                          <input type="hidden" name="url" value="<?php echo htmlspecialchars($article['url']) ?>"/>
                        </div>
                        <div class="form-group pull-right">
                          <button type="submit" class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span> Run
                          </button>
                        </div>
                      </form>
                    <!--Text of the article-->
                    </div>
                    <div class="panel-body">
                      <?php echo $article['text']; ?>
                    </div>

                  </div>
                  
                  
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
