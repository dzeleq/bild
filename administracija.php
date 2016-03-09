<?php
		session_start();
    	if (!isset($_SESSION['username'])) {
    		header("Location:index.php");
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
            <div class="collapse navbar-collapse pull-right navbar-brand"  id="navbar">
		        <?php if($_SESSION['username']): ?>
		            <span> <?=$_SESSION['username']?></span>
		            <span><a href="index.php?logout=1">Logout</a></span>
		        <?php endif; ?>
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
					<h1 class="panel-title"><span class="glyphicon glyphicon-random"></span> Meni</h1>
				</div>
				<div class="list-group">

				<?php



				?>
					<a href="administracija.php?kategorije" class="list-group-item">Administracija kategorija</a>
					<a href="administracija.php?vijesti" class="list-group-item">Administracija vijesti</a>
					<a href="administracija.php?komentari" class="list-group-item">Administracija komentara</a>

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

			<!-- Articles -->
			<div class="row">
				

				<?php

					if(isset($_GET['kategorije'])){
						include('administracijakategorija.php');
					}
					elseif(isset($_GET['vijesti'])){
						include('administracijavijesti.php');
					}
					elseif(isset($_GET['komentari'])){
						include('administracijakomentara.php');
					}
					else{
						include('administracijakategorija.php');
					}


				?>




			</div>
			<hr>
			
		</div><!--/Center Column-->


	  <!-- Right Column -->
	  <div class="col-sm-3">

		
			
			

	  </div><!--/Right Column -->

	</div><!--/container-fluid-->
	
	<footer>
		<div class="footer-blurb">
			<div class="container">
				
			</div>
        </div>
        
        <div class="small-print">
        	<div class="container">
        	
        		<p>Copyright &copy; Bild testni projekat 2016 </p>
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
	
</body>

</html>
