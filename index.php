<?php
session_start();

$userinfo = array(
                'user1'=>'password1',
                'user2'=>'password2'
                );

if(isset($_GET['logout'])) {
    unset($_SESSION['username']);
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
        header("Location:administracija.php");
    }else {
        $greska_pri_logovanju = '<p>Greska pri logovanju!</p>';
    }
}
?>


<!DOCTYPE html>
<!-- Template by Quackit.com -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Bild Testni projekat</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-globe"></span> Bild testni projekat</a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">


				<!-- Search -->
				<form class="navbar-form navbar-right" method="post" role="search">
					<div class="form-group">
						<input type="text" name="search" class="form-control">
					</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
				</form>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div class="container-fluid">

		<!-- Left Column -->
		<div class="col-sm-3">

			<!-- List-Group Panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title"><span class="glyphicon glyphicon-random"></span> Kategorije vijesti</h1>
				</div>
				<div class="list-group">

				<?php
					$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
					mysql_select_db('dzevadku_test') or die('Could not select database');


					//izlistavanje
					$query = "SELECT  * FROM  kategorije";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());
					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

						echo '<a href="index.php?kategorija='.$line['idkategorije'].'" class="list-group-item">'.
						$line['nazivkategorije'].'</a>';
					}

				?>
		
				</div>
			</div>


	
				
		</div><!--/Left Column-->
  
  
		<!-- Center Column -->
		<div class="col-sm-6">
			
			<?php 
			if(isset($greska_pri_logovanju)){
				echo '
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.
					$greska_pri_logovanju.'
				</div>
				';
			}
			?>


			<?php 

		

			if(isset($_POST['search'])){ 
				$search = $_POST['search'];
			
				$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
					mysql_select_db('dzevadku_test') or die('Could not select database');


					//izlistavanje
					$query = "SELECT  * FROM  vijest where Naslov like '% $search%' or TekstVijesti like '% $search%'";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());
					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
							
						$naslov=$line['Naslov'];
						$tekst=$line['TekstVijesti'];
						$id=$line['idvijest'];	
						echo '<div class="row">
							<style>
						p {
   							    width: 500px;
     							white-space: nowrap;
     							overflow: hidden;
    						    text-overflow: ellipsis;
															}
							</style>
				
				    <article class="col-xs-12">
					<h2>'.$naslov.'</h2>
					<p>'.$tekst.'</p>
					<p><button class="btn btn-default name="dugme" value="'.$id.'"><a href="index.php?vijesti='.$line['idvijest'].'">'.'Citaj vise'.'</a></button></p>
					</article>
			</div>' ;
					}
			}

			elseif(isset($_GET['kategorija'])){ 

				 	$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
					mysql_select_db('dzevadku_test') or die('Could not select database');
						
					$id=$_GET['kategorija'];

					//izlistavanje
					$query = "SELECT  * FROM  vijest where idkategorije='$id'";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());

					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

						$naslov=$line['Naslov'];
						$tekst=$line['TekstVijesti'];
						$id=$line['idvijest'];

						

						echo '<div class="row">
						<style>
						p {
    						 width: 650px;
   							  white-space: nowrap;
   							  overflow: hidden;
    						 text-overflow: ellipsis;
															}
						</style>
				    <article class="col-xs-12">
					<h2><a href="index.php?vijesti='.$line['idvijest'].'">'.
						$line['Naslov'].'</a></h2>
					<p>'.$tekst.'</p>
					<p><button class="btn btn-default name="dugme" value="'.$id.'"><a href="index.php?vijesti='.$line['idvijest'].'">'.'Citaj vise'.'</a></button></p>
					</article>
			</div>' ;
					}
			

		 

					}
						elseif(isset($_GET['vijesti'])){ 

				    $link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
					mysql_select_db('dzevadku_test') or die('Could not select database');


					$id=$_GET['vijesti'];

					//izlistavanje
					$query = "SELECT  * FROM  vijest where idvijest='$id'";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());


					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

						$naslov=$line['Naslov'];
						$tekst=$line['TekstVijesti'];
					
							echo '<div class="row">															
									<article class="col-xs-12">
										<h2>'.$naslov.'</h2>
										<p>'.$tekst.'</p>
										<hr>
									</article>

									</div>' ;
					
					}
					
						//insertovanje
						if (isset($_POST['dodavanje_komentara'])) {
  						 $potpis = $_POST['potpis'];
 						 $tekst = $_POST['tekst'];
 						 $vijest = $_GET['vijesti'];
 						 $date = date("Y-m-d H:i:s");

						 $query = "INSERT INTO komentar( Potpis, Tekst, Datum, idvijest) VALUES ('$potpis','$tekst','$date','$vijest')";
						 $result = mysql_query($query) or die('Query failed: ' . mysql_error());
							}  
?>


								<form action="" method="post">
										<label>Potpis</label><br>
										<input type="text" name="potpis"></input><br>
										<label>Tekst Komentara</label><br>
										<textarea name="tekst" rows="4" cols="50"></textarea><br>
  										<input type="submit" name="dodavanje_komentara" value="Posalji komentar"></input><br><br>


								</form>




					<?php
		 			$query = "SELECT * FROM  komentar where idvijest='$id'";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());

						while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

						$autor=$line['Potpis'];
						$tekst=$line['Tekst'];
						$datum = $line['Datum'];
						$komentarID= $line['idkomentar'];				
					
							echo '<div class="row">	
							<span class="autor">'.$autor.'</span>    
							<p class="tekst">'.$tekst.'</p> 
							<div class="clearfix"></div>

							<span class="pull-left">'.$datum.'</span>
							<span class="pull-right">
							<span class="badge"></span>		
								<button data-id="'.$komentarID.'"  type="button" class="btn btn-default like" aria-label="Left Align">
								  <span class=" glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
								</button>
								
								<button data-id="'.$komentarID.'"  type="button" class="btn btn-default dislike" aria-label="Left Align">
								  <span  class="  glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
								</button>
							</span>
			
						</div>' ;
					
					}

					}
			
			else{
			 
					$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
					mysql_select_db('dzevadku_test') or die('Could not select database');

					$query = "SELECT  * FROM  vijest limit 10";
					$result = mysql_query($query) or die('Query failed: ' . mysql_error());

					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

						$naslov=$line['Naslov'];
						$tekst=$line['TekstVijesti'];
						$id=$line['idvijest'];

						echo '<div class="row">
						<style>
							p {
    								 width: 650px;
     								 white-space: nowrap;
    								 overflow: hidden;
    								 text-overflow: ellipsis;
								}
						</style>
				    <article class="col-xs-12">
					<h2><a href="index.php?vijesti='.$line['idvijest'].'">'.
						$line['Naslov'].'</a></h2>
					<p>'.$tekst.'</p>
				    <p><button class="btn btn-default name="dugme" value="'.$id.'"><a href="index.php?vijesti='.$line['idvijest'].'">'.'Citaj vise'.'</a></button></p>
					</article>
			</div>' ;
					}
				
					
			
				}
					



		 ?>
			<hr>
			
		</div><!--/Center Column-->


	  <!-- Right Column -->
	  <div class="col-sm-3">

			<!-- Form --> 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<span class="glyphicon glyphicon-log-in"></span> 
						Administracija Log In
					</h3>
				</div>
				<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group">
							<input type="text" class="form-control" id="uid" name="username" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
						</div>
						<button type="submit" class="btn btn-default">Log In</button>
					</form>
				</div>
			</div>
 
			
			

	  </div><!--/Right Column -->

	</div><!--/container-fluid-->
	
	<footer >
		<div class="footer-blurb">
			<div class="container">
				
			</div>
        </div>
        
        <div class="small-print">
        	<div class="container" align="center">
        	
        		<p>Copyright &copy;Bild testni projekat 2016 </p>
        	</div>
        </div>
	</footer>

	
    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- IE10 viewport bug workaround -->
	<script src="js/ie10-viewport-bug-workaround.js"></script>
	
	<!-- Placeholder Images -->
	<script src="js/holder.min.js"></script>

	<script src="js/custom.js"></script>
	
</body>

</html>
