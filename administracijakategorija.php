
<h1>Administracija Kategorija</h1>


<form action="administracija.php?kategorije" method="post">
  <label>Naziv</label><br>
  <input type="text" name="naziv"></input><br>
  <input type="submit" name="dodavanje_kategorije" value="Dodaj kategoriju"></input><br><br>
</form>

<?php
$link = mysql_connect('localhost', 'dzevadku_root', '123123123') or die('Could not connect: ' . mysql_error());
mysql_select_db('dzevadku_test') or die('Could not select database');



//insertovanje
if (isset($_POST['dodavanje_kategorije'])) {
  $nazivkategorije = $_POST['naziv'];
$query = "INSERT INTO kategorije( nazivkategorije) VALUES ('$nazivkategorije')";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}

//brisanje
if (isset($_POST['del'])) {

	$id = $_POST['delete'];

	mysql_select_db('dzevadku_test') or die('Could not select database');
	$query = "DELETE FROM kategorije WHERE idkategorije= '$id' ";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}


//izlistavanje
$query = "SELECT  * FROM  kategorije";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
            $naziv = $line['nazivkategorije'];
           echo "<td>$naziv<td>";
           echo '<td>
           <form method="post"> 
           <input type="submit" name="del"value="delete">
           </input> <input type="hidden" name="delete" value="'.$line['idkategorije'].'" ></input>
           </form>
           </td>';

  echo "\t</tr>\n";

}
  
echo "</table>\n";


?>

