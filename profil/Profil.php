
<?php require_once("../auth.php");

if(!est_connecte()){
    header("Location: /Competence/");
    exit();
}
?>

<?php require_once("./navbarre_Item.php")?>
<?php require_once("../config/config.php")?>
<div class="card_profil">
    <h1>PROFIL</h1>
    <section class="profil_user">

        <div class="user_nom">
        <label>Nom :</label>
        <?php
        $requete_nom = "SELECT Nom_Etud FROM etudiant Where Identifiant_Etud = :id";
        $user_nom = $pdo->prepare($requete_nom);
        $user_nom->execute([':id' => $_SESSION['id']]);
        $resultat_nom = $user_nom -> fetch();
        
        foreach ($resultat_nom as $key_nom => $value_nom) 
        {
            echo("$value_nom");
        }
        ?>
        </div>
        <div class="user_prenom">
        <label>Prenom:</label>
        <?php
        $requete_prenom = "SELECT Prenom_Etud FROM etudiant Where Identifiant_Etud= :id";
        $user_prenom = $pdo->prepare($requete_prenom);
        $user_prenom->execute([':id' => $_SESSION['id']]);
        $resultat_prenom = $user_prenom -> fetch();
        
        foreach ($resultat_prenom as $key_prenom => $value_prenom) 
        {
            echo(" $value_prenom");
        }
        ?>
        </div>
        <div class="user_opt_BTS">
        <label>Option du BTS SIO :</label>
        <?php
        $requete_opt_BTS = "SELECT Option_BTS_Etud FROM etudiant Where Identifiant_Etud = :id";
        $user_opt_BTS = $pdo->prepare($requete_opt_BTS);
        $user_opt_BTS->execute([':id' => $_SESSION['id']]);
        $resultat_opt_BTS = $user_opt_BTS -> fetch();
        
        foreach ($resultat_opt_BTS as $key_opt_BTS => $value_opt_BTS) 
        {
            echo(" $value_opt_BTS");
        }
        ?>
        </div>
        <div class="user_date">
        <label>Date Anniversaire :</label>
        <?php
        $requete_date = "SELECT Date_Naissance_Etud FROM etudiant Where Identifiant_Etud = :id";
        $user_date = $pdo->prepare($requete_date);
        $user_date->execute([':id' => $_SESSION['id']]);
        $resultat_date = $user_date -> fetch();
        
        foreach ($resultat_date as $key_date => $value_date) 
        {
            echo(" $value_date");
        }
        ?>
        </div>

    </section>
    <section class="barre_Profil"></section>
    <section class="profil_account_user">
    <div class="user_mail">
    <label>Email (Profesionnel) :</label>
    <?php
    $requete_mail_ac = "SELECT Mail_Professionnel_Etud FROM etudiant Where Identifiant_Etud = :id";
    $user_mail_ac = $pdo->prepare($requete_mail_ac);
    $user_mail_ac->execute([':id' => $_SESSION['id']]);
    $resultat_mail_ac = $user_mail_ac -> fetch();
    
    foreach ($resultat_mail_ac as $key_mail_ac => $value_mail_ac) 
    {
        echo(" $value_mail_ac");
    }
    ?>
   
    </div>
    <div class="test">        
        <form method="post" action="" id="formulaire" > 
            <div class="profil_mdp">
                <label id="label_new_mdp">Nouveau Mot de passe    :</label>
                <input class="input_profil_mdp" type="password" name="new_mdp" required>
            </div>
            <div class="profil_mdp_verif">
                <label>Répéter le Mot de passe :</label>
                <input class="input_profil_mdp_verif" type="password" name="new_mdp_verif" required>
            </div>
            <div class="profil_mdp_register">
                <button class="button_profil_mdp_register"  name="button_new_mdp">Enregistrer</button>
                
            </div>
        </form>
    </div>
    </section>
<?php
try{
    if (isset($_POST['button_new_mdp'])){
    
    $mdp_hash = password_hash($_POST['new_mdp'], PASSWORD_DEFAULT);

        if (password_verify($_POST['new_mdp'],$mdp_hash)){
            if (password_verify($_POST['new_mdp_verif'],$mdp_hash)){

            $requete_new_mdp = "UPDATE etudiant SET Mot_De_Passe_Etud = :psw WHERE `Identifiant_Etud`= :id ";

            $query = $pdo->prepare($requete_new_mdp);

            $query->execute([
                'psw' => $mdp_hash,
                ':id' => $_SESSION['id']
            ]);
            $success ="Votre Mot de passe à bien été modifié";
            }else{
                echo("Les 2 mot de Passe ne sont pas identiques");
            }

        }
    }else{
        $error= "";
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
<?php if (isset($success)): ?>
<div class="alert-success">
    <?= $success?>
</div>
<?php endif ?>

    <section class="barre_end"></section>
</div>
