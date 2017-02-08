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
                    <a href="dashboard.php" class="btn">Terug naar dashboard</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
				  <!-- Table columns -->
                    <tr>
                      <th>Naam</th>
                      <th>Begin Datum</th>
                      <th>Eind Datum</th>
					  <th>Voorbereidings Datum</th>
					  <th>Soort Evenement</th>
					  <th>Opmerking</th>
					  <th>Briefing Map</th>
					  <th>Afgerond</th>
					  <th>Actie</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
						// connect to the database + select database
						// TODO: DISPLAY ALL THE PAST EVENTS ORDERED BY EIND_DATUM
						include 'database.php';
						$pdo = Database::connect();
						
						$date = date('d/m/Y');
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
						FROM evenement 
						WHERE eind_datum < ?
						ORDER BY eind_datum";
						$q = $pdo->prepare($sql);
						$q->execute(array($date));
						// store above command in the variable $records
						 foreach ($q as $row) {
								echo '<tr>';
								echo '<td>'.'<a href="read.php?id='.$row['id'].'">'.$row['naam'].'</a></td>';
								echo '<td>'.$row['start_datum'].'</td>';
								echo '<td>'.$row['eind_datum'].'</td>';
								echo '<td>'.$row['voorbereiding_datum'].'</td>';
								echo '<td>'.$row['soort_evenement'].'</td>';
								echo '<td>'.$row['opmerking'].'</td>';
								echo '<td>'.$row['briefing_map'].'</td>';
								echo '<td>'.$row['afgerond'].'</td>';
								echo '<td>';
								echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">-</a>';
								echo '</td>';
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
