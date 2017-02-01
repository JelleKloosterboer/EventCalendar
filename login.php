<?php
     // all green code is optional
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $userError = null;
		$passError = null;
		
         
        // keep track post values
		$user = $_POST['user'];
		$pass = $_POST['pass'];
         
        // validate input
        $valid = true;
        if (empty($user)) {
            $userError = 'Voer een gebruikersnaam in.';
            $valid = false;
        }
		
		if (empty($pass)) {
            $passError = 'Voer een wachtwoord in.';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            // insert values into database
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM gebruiker WHERE gebruikersnaam = ? AND wachtwoord = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($user,$pass));
			Database::disconnect();
			header("Location: index.php");
		}		
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link  href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Inloggen</h3>
                    </div>
             
                    <form class="form-horizontal" action="login.php" method="post">
                        <div class="control-group <?php echo !empty($userError)?'error':'';?>">
                        <label class="control-label">Gebruikersnaam</label>
                        <div class="controls">
                            <input name="user" type="text"  placeholder="Gebruikersnaam" value="<?php echo !empty($user)?$user:'';?>">
                            <?php if (!empty($userError)): ?>
                                <span class="help-inline"><?php echo $userError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="control-group <?php echo !empty($passError)?'error':'';?>">
                        <label class="control-label">Wachtwoord</label>
                        <div class="controls">
                            <input name="pass" type="password"  placeholder="Wachtwoord" value="<?php echo !empty($pass)?$pass:'';?>">
                            <?php if (!empty($passError)): ?>
                                <span class="help-inline"><?php echo $passError;?></span>
                            <?php endif;?>
                        </div>
						</div>
						<div class="form-actions">
                          <button type="submit" class="btn btn-success">Inloggen</button>
                          <a class="btn" href="index.php">Terug</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
</body>