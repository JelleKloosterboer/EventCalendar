<!DOCTYPE html>
<?php
     // all green code is optional
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        //$SdateError = null;
        //$EdateError = null;
		//$PdateError = null;
		$typeEventError = null;
		//$commentError = null;
		//$briefingMError = null;
		$finishedError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $Sdate = $_POST['Sdate'];
        $Edate = $_POST['Edate'];
		$Pdate = $_POST['Pdate'];
		$typeEvent = $_POST['typeEvent'];
		$comment = $_POST['comment'];
		$briefingM = $_POST['briefingM'];
		$finished = $_POST['finished'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Voer een naam voor het evenement in.';
            $valid = false;
        }
         
        /*if (empty($Sdate)) {
            $SdateError = 'Voer een begin datum in.';
            $valid = false;
        }*/
         
        /*if (empty($Edate)) {
            $EdateError = 'Voer een eind datum in.';
            $valid = false;
        }*/
		
		/*if (empty($Pdate)) {
            $PdateError = 'Voer een voorbereidings datum in.';
            $valid = false;
        }*/
		
		if (empty($typeEvent)) {
            $typeEventError = 'Voer een type voor het evenement in.';
            $valid = false;
        }
		
		/*if (empty($comment)) {
            $commentError = 'Voer een opmerking in.';
            $valid = false;
        }*/
		
		/*if (empty($briefingM)) {
            $briefingMError = 'Voer een briefing document in.';
            $valid = false;
        }*/
		
		if (empty($finished)) {
            $finishedError = 'Voer in of het evenement afgerond is.';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO evenement (naam,start_datum,eind_datum,voorbereiding_datum,soort_evenement
			,opmerking,briefing_map,afgerond) values(?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$Sdate,$Edate,$Pdate,$typeEvent,$comment,$briefingM,$finished));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>
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
                        <h3>Voeg evenement toe</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Naam</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Naam" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($SdateError)?'error':'';?>">
                        <label class="control-label">Begin Datum</label>
                        <div class="controls">
                            <input name="Sdate" type="date" placeholder="Begin Datum" value="<?php echo !empty($Sdate)?$Sdate:'';?>">
                            <?php if (!empty($SdateError)): ?>
                                <span class="help-inline"><?php echo $SdateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($EdateError)?'error':'';?>">
                        <label class="control-label">Eind Datum</label>
                        <div class="controls">
                            <input name="Edate" type="date"  placeholder="Eind Datum" value="<?php echo !empty($Edate)?$Edate:'';?>">
                            <?php if (!empty($EdateError)): ?>
                                <span class="help-inline"><?php echo $EdateError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="control-group <?php echo !empty($PdateError)?'error':'';?>">
                        <label class="control-label">Voorbereidings Datum</label>
                        <div class="controls">
                            <input name="Pdate" type="date"  placeholder="Voorbereidings Datum" value="<?php echo !empty($Pdate)?$Pdate:'';?>">
                            <?php if (!empty($PdateError)): ?>
                                <span class="help-inline"><?php echo $PdateError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="control-group <?php echo !empty($typeEventError)?'error':'';?>">
                        <label class="control-label">Soort Evenement</label>
                        <div class="controls">
                            <input name="typeEvent" type="text"  placeholder="Soort Evenement" value="<?php echo !empty($typeEvent)?$typeEvent:'';?>">
                            <?php if (!empty($typeEventError)): ?>
                                <span class="help-inline"><?php echo $typeEventError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="control-group <?php echo !empty($commentError)?'error':'';?>">
                        <label class="control-label">Opmerkingen</label>
                        <div class="controls">
                            <input name="comment" type="text"  placeholder="Opmerkingen" value="<?php echo !empty($comment)?$comment:'';?>">
                            <?php if (!empty($commentError)): ?>
                                <span class="help-inline"><?php echo $commentError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="control-group <?php echo !empty($briefingMError)?'error':'';?>">
                        <label class="control-label">Briefing Map</label>
                        <div class="controls">
                            <input name="briefingM" type="text"  placeholder="Briefing Map" value="<?php echo !empty($briefingM)?$briefingM:'';?>">
                            <?php if (!empty($briefingMError)): ?>
                                <span class="help-inline"><?php echo $briefingMError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="control-group <?php echo !empty($finishedError)?'error':'';?>">
                        <label class="control-label">Afgerond?</label>
                        <div class="controls">
                            <input name="finished" type="text"  placeholder="Afgerond" value="<?php echo !empty($finished)?$finished:'';?>">
                            <?php if (!empty($finishedError)): ?>
                                <span class="help-inline"><?php echo $finishedError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Toevoegen</button>
                          <a class="btn" href="index.php">Terug</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>