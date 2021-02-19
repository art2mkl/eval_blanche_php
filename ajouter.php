<?php
if (isset($_POST['nom']) and $_POST['nom'] != "" and isset($_POST['marque']) and $_POST['marque'] != "" and isset($_POST['prix']) and $_POST['prix'] != "") {
    $nom = htmlspecialchars($_POST['nom']);
    $marque = htmlspecialchars($_POST['marque']);
    $prix = htmlspecialchars($_POST['prix']);
    $description = htmlspecialchars($_POST['description']) ?? "";

    if (isset($_FILES['image']) and $_FILES['image']['error'] == 0) {

        // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000) {

            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['image']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'jfif');

            if (in_array($extension_upload, $extensions_autorisees)) {

                // vérification de l'existence du repertoire
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . time() . $_FILES['image']['name']);

                //header('Location: index.php?img='.$_FILES['image']['name']);
                $image = 'uploads/' . time() . $_FILES['image']['name'] ?? "";
            }
        }
    }

    //ouverture de la base de donnée
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $insert = $bdd->prepare('INSERT INTO `voiture`(`nom`, `marque`, `prix`, `photo`, `description`) VALUES (?,?,?,?,?)');

    if ($insert->execute(array($nom, $marque, $prix, $image, $description))) {
        echo 'Cela marche';
    } else {
        echo 'ERROR';
    }
} //else header('Location: index.php?success=2');

header('Location: index.php?success=1');
