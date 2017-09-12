  <?php 
    $ret =  mysql_select_db('stbbedup_exam',mysql_connect('localhost','stbbedup_examdb','examdb'));
    $result =  mysql_query("SELECT * FROM scheme");
    $rows = mysql_num_rows($result);
    echo 'niice: ';
    echo 'rows: '.$rows;
   while($row=mysql_fetch_object($result)){
		echo($row->YEAR);  
   }
    ?>