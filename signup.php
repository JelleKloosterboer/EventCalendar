<?php
     // all green code is optional
	 // TODO insert the selected permission into the database
	session_start();
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $firsError = null;
        $lastError = null;
        $userError = null;
		$passError = null;
		//$permissionError = null;
		
         
        // keep track post values
        $first = $_POST['first'];
		$last = $_POST['last'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		//$permission = $_POST['permission'];
         
        // validate input
        $valid = true;
        if (empty($first)) {
            $firstError = 'Voer uw voornaam in.';
            $valid = false;
        }
         
        if (empty($last)) {
            $lastError = 'Voer uw achternaam in.';
            $valid = false;
        }
         
        if (empty($user)) {
            $userError = 'Voer een gebruikersnaam in.';
            $valid = false;
        }
		
		if (empty($pass)) {
            $passError = 'Voer een wachtwoord in.';
            $valid = false;
        }
		
		/*if (empty($permission)) {
            $permissionError = 'Voer uw permissie in.';
            $valid = false;
        }*/
         
        // insert data
        if ($valid) {
            // insert values into database
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO gebruiker (voornaam,achternaam,gebruikersnaam,wachtwoord) 
					VALUES (?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($first,$last,$user,$pass));//$permission
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
                        <h3>Registreren</h3>
                    </div>
             
                    <form class="form-horizontal" action="signup.php" method="post">
                      <div class="control-group <?php echo !empty($firstError)?'error':'';?>">
                        <label class="control-label">Voornaam</label>
                        <div class="controls">
                            <input name="first" type="text"  placeholder="Voornaam" value="<?php echo !empty($first)?$first:'';?>">
                            <?php if (!empty($firstError)): ?>
                                <span class="help-inline"><?php echo $firstError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($lastError)?'error':'';?>">
                        <label class="control-label">Achternaam</label>
                        <div class="controls">
                            <input name="last" type="text" placeholder="Achternaam" value="<?php echo !empty($last)?$last:'';?>">
                            <?php if (!empty($lastError)): ?>
                                <span class="help-inline"><?php echo $lastError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
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
						<!--<div class="control-group <?php /*echo !empty($permissionError)?'error':'';?>">
                        <label class="control-label">Permissie</label>
                        <div class="controls">
                            <select name="permission">
								<option value="">Selecteer een permissie
								<option value="<?php echo (!empty($permission) and $permission = 'gebruiker')?$permission:'';?>">Gebruiker
								<option value="<?php echo (!empty($permission) and $permission = 'moderator')?$permission:'';?>">Moderator
								<option value="<?php echo (!empty($permission) and $permission = 'admin')?$permission:'';?>">Admin
							</select>
                            <?php if (!empty($permissionError)): ?>
                                <span class="help-inline"><?php echo $permissionError;?></span>
                            <?php endif; */?>
                        </div>
						</div> -->
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registeren</button>
                          <a class="btn" href="index.php">Terug</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>