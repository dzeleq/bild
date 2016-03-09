<?php

if(isset($_GET['like'])){

	$komentarId = $_GET['like'];

	  $link = mysql_connect('localhost', 'root', 'dzele333') or die('Could not connect: ' . mysql_error());
             mysql_select_db('projekat') or die('Could not select database');
  


        $query = "SELECT  lajk,dislajk FROM  komentar where idkomentar = $komentarId";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $rez = mysql_fetch_assoc($result);
        $brojLajkova = (int)$rez['lajk']; //trenutno lajkova
 		$brojDislajkova = (int)$rez['dislajk']; 

        $noviBr = $brojLajkova+1;
       
        $query = "update  komentar set  lajk = $noviBr where idkomentar = $komentarId";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());


        echo round(100*$noviBr /($noviBr + $brojDislajkova));


}

if(isset($_GET['dislike'])){

	$komentarId = $_GET['dislike'];

	  $link = mysql_connect('localhost', 'root', 'dzele333') or die('Could not connect: ' . mysql_error());
             mysql_select_db('projekat') or die('Could not select database');
  


        $query = "SELECT  lajk,dislajk FROM  komentar where idkomentar = $komentarId";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $rez = mysql_fetch_assoc($result);
        $brojLajkova = (int)$rez['lajk']; //trenutno lajkova
 		$brojDislajkova = (int)$rez['dislajk']; 


        $noviBr = $brojDislajkova+1;
        

        $query = "update  komentar set  dislajk = $noviBr where idkomentar = $komentarId";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
   		
   		echo round(100*$brojLajkova /($brojLajkova + $noviBr));

}


?>