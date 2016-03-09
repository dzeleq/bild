<h1>Administracija Vijesti</h1>


<form action="administracija.php?vijesti" method="post">

  <label>Naziv</label><br>
  <input type="text" name="naziv"></input><br>
  <label>Tekst</label><br>

  <textarea name="tekst" rows="4" cols="50"></textarea><br>
  <label>Kategorija</label>
  <?php 


        $link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
             mysql_select_db('dzevadku_test') or die('Could not select database');
  
        $query = "SELECT  * FROM  kategorije";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

  echo '<select name="kategorija">';
    
//izlistavanje
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
              
          $naziv = $line['nazivkategorije'];
          $id=$line['idkategorije'];
           echo "<option value='$id'>$naziv" ;

}
  
 echo '</select>' ;
  ?>

 <br> <input type="submit" name="dodavanje_vijesti" value="Dodaj vijest"></input><br><br>
</form>



<?php
$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
mysql_select_db('dzevadku_test') or die('Could not select database');



//insertovanje
if (isset($_POST['dodavanje_vijesti'])) {
  $nazivvijesti = $_POST['naziv'];
  $tekstvijesti = $_POST['tekst'];
  $kategorijavijesti = $_POST['kategorija'];
  $date = date("Y-m-d H:i:s");
$query = "INSERT INTO vijest( Naslov,TekstVijesti,DatumVijesti,idkategorije) VALUES ('$nazivvijesti','$tekstvijesti','$date','$kategorijavijesti')";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}

//brisanje
if (isset($_POST['del'])) {

	$id = $_POST['delete'];

	mysql_select_db('dzevadku_test') or die('Could not select database');
	$query = "DELETE FROM vijest WHERE idvijest= '$id' ";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}


//izlistavanje
$query = "SELECT  * FROM  vijest";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
            $naziv = $line['Naslov'];
            $tekst = $line['TekstVijesti'];
            $date = $line['DatumVijesti'];


           echo '<div class="row">  
              <span class="autor">'.$naziv.'</span>    
              <p class="tekst">'.$tekst.'</p> 
              <div class="clearfix"></div>

              <span class="pull-left">'.$date.'</span>
              <br>
           <form method="post"> 
           <input type="submit" name="del"value="delete">
           </input> <input type="hidden" name="delete" value="'.$line['idvijest'].'" ></input><br><br>
           </form>
           </td>';

  echo "\t</tr>\n";

}
  
echo "</table>\n";


?>

