<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
if(isset($_GET['id'])) {
  $query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
  $result = mysql_query( $query );
  $result_row = mysql_fetch_assoc($result);
  //$filename=$result_row['filename'];
  $title=$result_row['title'];
  //$uploader=$result_row['username'];
  $filepath=$result_row['filepath'];
  //$type=$result_row['type'];
  $description=$result_row['description'];
  $permission=$result_row['permission'];
  $category=$result_row['category'];
  $query = "SELECT keyword from keywords WHERE mediaid='".$_GET['id']."'";
  $result = mysql_query( $query );
  $keyword="";
  while($row=mysql_fetch_array($result))
  {
  	$keyword=$keyword." ".$row[0];
  }

}



 ?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Metube</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <!--<link href="/metube/css/signin.css" rel="stylesheet"> -->
    <link href="/metube/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



  </head>

  <body>
    <div class="navbar  navbar-fixed-top" role="navigation">

      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
          </button>
          <a class="navbar-brand" href="/metube/homex.php">MeTube - All Media.One Source</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php">Hello,<?php echo get_firstname($username); ?></a></li>
            <li><a href="uploadmedia.php">Upload</a></li>
            <li><a href="signout.php">Sign out</a></li>
          </ul>

          <form class="navbar-form navbar-left" role="search" method=get action="searchmedia.php">
            <div class="form-group" >
              <input type="text" class="form-control" name="search" placeholder="Videos,images.." style="width:360px;">
            </div>
            <button type="submit" class="btn btn-default"  style="position:relative;left:-8px;border-top-left-radius:0;border-bottom-left-radius:0;"><span class="glyphicon glyphicon-search"></span> Search</button>
          </form>     
          
        </div>
      </div>
    </div>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="homex.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="allplaylist.php">playlists</li>
            <li><a href="mymedia.php">My Media</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="friends.php">Friends</a></li>
            <li><a href="channels.php">Channels</a></li>
            <li><a href="playlists.php">Playlists</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">Categories</a></li>
            <li><a href="">Music</a></li>
            <li><a href="">Sports</a></li>
            <li><a href="">Education</a></li>
            <li><a href="">Movies</a></li></span>
          </ul>

        </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="mainframe"> <!--Body Container-->
      	<h2>Edit media</h2>
      	<form role="form" method="post" action="editmediaprocess.php" enctype="multipart/form-data" >
    		<div class="form-group">
    			<label for="uploadTitle">Title</label>
    			<input type="text" class="form-control" name="title" required style="width:40%" value="<?php echo $title;?>">
    		</div>
    		<div class="form-group">
    			<label for="uploadDescription">Description</label>
    			<textarea  class="form-control" name="description" rows="4" cols="25" style="width:50%"><?php echo $description;?></textarea>
    		</div>
    		<div class="form-group">
    			<label for="uploadDescription">Keywords</label>
    			<input type="text" class="form-control" name="keyword" required style="width:30%" value="<?php echo $keyword;?>">
    		</div>
        <div class="form-group">
          <label>Category</label>
          <select class="form-control" name="category" required style="width:20%" >
          <option value="music">Music</option>
          <option value="sports">Sports</option>
          <option value="movies">Movies</option>
          <option value="kids">Kids</option>
          <option value="action">Action</option>
          <option value="education">Education</option>
          </select>
        </div>
        <div class="form-group">
          <label>Permission</label>
          <select class="form-control" name="permission" required style="width:15%">
          <option value="public">Public</option>
          <option value="private">Private</option>
      </select>
        </div>
        <input type="hidden" value="<?php echo $_GET['id']?>" name="mediaid">
        <button type="submit" class="btn btn-default" name="submit" value="Upload">Update</button>
  		</form>
        

    </div> <!-- /container -->
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  </body>
</html>