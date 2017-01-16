<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- Add a CSS below
<link rel="stylesheet" type="text/css" href="__.css"> -->
<!-- Enter a Javascript here
<script type="text/javascript" src="__.js"></script> -->
<?php
	// connect to the database + select database
	include_once "mysql_connect.php";
	//select ALL data in the table
	// TODO: select only the date in d-m-Y format of datetime fields
	$sql = "SELECT naam,
			date_format(start_datum, '%d-%m-%Y') AS start_datum,
			date_format(eind_datum, '%d-%m-%Y') AS eind_datum,
			date_format(voorbereiding_datum, '%d-%m-%Y') AS voorbereiding_datum,
			soort_evenement,
			opmerking,
			briefing_map,
			afgerond
			FROM evenement";
	// store above command in the variable $records
	$records = mysql_query($sql);
?>
<html>
<title>
Dashbord
</title>
<head>

</head>
<body>
<!-- simple HTML table with a line for every field in the table -->
<table border="1" cellpadding = "1" cellspacing = "1">
  <tr>
    <th>Evenementnaam</th>
	<th>Startdatum</th>
	<th>Einddatum</th>
	<th>Datum voorbereiding</th>
	<th>Soort evenement</th>
	<th>Opmerking</th>
	<th>Briefing Map</th>
	<th>Afgerond?</th>
  <tr>
  
  <?php
  // Make a new row in the HTML table for every record in the database
	while($event=mysql_fetch_assoc($records)) {
		echo "<tr>";
		echo "<td>".$event['naam']."</td>";
		echo "<td>".$event['start_datum']."</td>";
		echo "<td>".$event['eind_datum']."</td>";
		echo "<td>".$event['voorbereiding_datum']."</td>";
		echo "<td>".$event['soort_evenement']."</td>";
		echo "<td>".$event['opmerking']."</td>";
		echo "<td>".$event['briefing_map']."</td>";
		echo "<td>".$event['afgerond']."</td>";
		echo "<tr/>";
	}
  ?>
</table>
</body>
</html>
