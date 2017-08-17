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
                <h1>If you don't already have an article to work from</h1>
                <p>Then you can use the search bar right there. You can type any theme in you mind, and we will make sure to create a video about this theme.</p>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row --> 

        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <label for="search-bar">Please enter the theme you want</label>
                <form action="index.php?section=video_view_articles" method="POST">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type the issue you want to create a video about..." id="search-bar" name="searchContent">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" value="submit">Search For News !</button>
                    </span>
                    </div><!-- /input-group -->
                </form>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row --> 

        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <h1>If you already have an article to work from</h1>
                <p>Then you can use the search bar right there. You can copy and paste the url of the article you choose, and Max will automatically create a video for you from this article.</p>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row --> 

        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <label for="search-bar">Please enter the URL of the article you want to make a video from</label>
                <form action="index.php?section=video_generation" method="POST">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type the url here..." id="search-bar" name="url">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" value="submit">Make The Video !</button>
                    </span>
                    </div><!-- /input-group -->
                </form>
            </div><!-- /.col-lg-6 -->
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
