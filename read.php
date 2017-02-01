<?php
	session_start();
	
	require 'database.php';
	//check for the id (row)
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
		// fetch the corresponding row from the database
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
						WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Overzicht Evenement <?php echo $data['naam'];?></h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Begin datum</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['start_datum'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Eind Datum</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['eind_datum'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Voorbereidings Datum</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['voorbereiding_datum'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Soort Evenement</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['soort_evenement'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Opmerking</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['opmerking'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Briefing Map</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['briefing_map'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Afgerond?</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['afgerond'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
							<a class="btn btn-success" href="update.php">Bewerken</a>
							<a class="btn" href="dashboard.php">Terug</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>