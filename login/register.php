<?php
include('../accueil/header.php');
if(empty($_SESSION['identifiant'])){
    ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title></title>
                <link rel="stylesheet" href="./register.css">
            </head>

            <body>
                <div class="container">
                    <h2>Inscription</h2>
                    <form action="../traitement/traitement_register.php" method="post">
                        <label for="type">Type of user :</label><br>
                            <select id="type" name="type">
                                <option value="User">User</option>
                                <option value="School">School</option>
                                <option value="Company">Company</option>
                                <option value="Admin">Admin</option>
                            </select>
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                        <label for="identifiant">Identifiant :</label>
                        <input type="text" id="identifiant" name="identifiant" required>
                        <label for="mot_de_passe">Mot de passe :</label>
                        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                        <input type="submit" value="S'inscrire">
                    </form>
                    <p>Vous avez un compte ? <a href="connection.php"> Connexion</a></p>
                </div>
            </body>

            </html>
<?php
}
else{
    header('location: ../accueil/index.php');
}
?>