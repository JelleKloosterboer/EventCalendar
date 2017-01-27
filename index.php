<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
	
<body>
    <div class="container">
            <div class="row">
                <h3>Evenementen</h3>
            </div>
            <div class="row">
				<p>
                    <a href="create.php" class="btn btn-success">Evenement toevoegen</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
				  <!-- Table columns -->
                    <tr>
					  <th>Actie</th>
                      <th>Naam</th>
                      <th>Begin Datum</th>
                      <th>Eind Datum</th>
					  <th>Voorbereidings Datum</th>
					  <th>Soort Evenement</th>
					  <th>Opmerking</th>
					  <th>Briefing Map</th>
					  <th>Afgerond</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
						// connect to the database + select database
						include 'database.php';
						$pdo = Database::connect();
						//select ALL data in the table
						$sql = "SELECT id,
						naam,
						date_format(start_datum, '%d-%m-%Y') AS start_datum,
						date_format(eind_datum, '%d-%m-%Y') AS eind_datum,
						date_format(voorbereiding_datum, '%d-%m-%Y') AS voorbereiding_datum,
						soort_evenement,
						opmerking,
						briefing_map,
						afgerond
						FROM evenement";
						// store above command in the variable $records
						 foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
								echo '<td width=107>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">=</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">+</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">-</a>';
                                echo '</td>';
								echo '<td>'.$row['naam'].'</td>';
								echo '<td>'.$row['start_datum'].'</td>';
								echo '<td>'.$row['eind_datum'].'</td>';
								echo '<td>'.$row['voorbereiding_datum'].'</td>';
								echo '<td>'.$row['soort_evenement'].'</td>';
								echo '<td>'.$row['opmerking'].'</td>';
								echo '<td>'.$row['briefing_map'].'</td>';
								echo '<td>'.$row['afgerond'].'</td>';
								echo '<tr/>';
						}
						Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
