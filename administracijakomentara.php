
<h1>Administracija Komentara</h1>




<?php



$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
mysql_select_db('dzevadku_test') or die('Could not select database');




if (isset($_POST['del'])) {

	$id = $_POST['delete'];

	mysql_select_db('dzevadku_test') or die('Could not select database');
	$query = "DELETE FROM komentar WHERE idkomentar= '$id' ";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}

$query = "SELECT  idkomentar,Potpis, Tekst, Datum FROM  komentar";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

 


echo "<table align='left' cellpadding=50px>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";										
   						$autor=$line['Potpis'];
						$tekst=$line['Tekst'];
						$datum = $line['Datum'];
						$komentarID= $line['idkomentar'];				
					
							echo '<div class="row">	
							<span class="autor">'.$autor.'</span>    
							<p class="tekst">'.$tekst.'</p> 
						    <div class="clearfix"></div>

							<span class="pull-left">'.$datum.'</span>
							<br>
     
           <form method="post"> 
           <input type="submit" name="del"value="delete">
           </input> <input type="hidden" name="delete" value="'.$line['idkomentar'].'" ></input>
           </form>
           </td>';

  echo "\t</tr>\n";

}
  
echo "</table>\n";


?>

