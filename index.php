<?php
require_once("./config/config.php");
try{
    if (isset($_POST['submit_connection'])){
        $sql='SELECT * FROM etudiant WHERE `Mail_Professionnel_Etud` = :mail';
        $verif_email = $pdo->prepare($sql);
        $verif_email ->execute([':mail' => $_POST['login_email']]);
        $resultat = $verif_email->fetch();
        
        if (password_verify($_POST['login_password'], $resultat->Mot_De_Passe_Etud))
        {
            session_start();
            $_SESSION['id'] = $resultat->Identifiant_Etud;
            $_SESSION['connect'] = 1;
            var_dump($_SESSION['id']);
            var_dump($_SESSION['connect']);
            header("Location: /Competence/Item/Competence.php");
        }else{
            $error = "Erreur1";
            $error2 = "test"; 
        }
    }

} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>

<?php if (isset($error)): ?>
<div class="alert alert-danger">
    
<?= $error?>
</div>

<?php endif ?>
<?php
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de compétences</title>

    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="background">
        
    </div>
    <div class="card">
        <section class="section_description_site">
            <div class="description_site">
                <p id="Title_description">
                    Bienvenue sur mon site de compétence
                </p> 
                <br>
                <br>                
                <p id="Description">
                
                    Votre adresse sera la même que votre mail professionel de BTS SIO2 <br><br>
                    Votre mot de passe initial est :<br>
                     PROSIO2
                </p>
            </div>
        </section>
        <section>
            <br>
        </section>
        <section class="section_connection">
            <div class="Connection_card" >
                <div class="connection_title_card">
                    <h1 id="Title_connection">Connexion</h1>
                    <br>
                </div>
                <form action="" method="post"  >
                    <div class="connection_Email_card">
                        <label id="Email_label">Email : ( Email professionel )<br></label>
                        <input id="Email" name ="login_email" required>
                    </div>
                    <div class="connection_mdp_card">
                        <label id="Mdp_label" >Mot De Passe :<br></label>
                        <input type="password" id="Mdp" name ="login_password" required>
                    </div>
                    <div class="submit_button" >
                        <button  type="submit" id="Submit_connection" name="submit_connection" >Connexion</button>
                    </div>
                </form>
            </div>
        </section>
    </div> 
</body>
</html>