<?php include "head.php" ?>

<body>

    <?php include "nav.php" ?>

    <div class="container">
        <h1 class="p-4">Description</h1>
        <?php
        if (isset($_GET['type'])) {
            $id = htmlspecialchars($_GET['type']);
           //ouverture de la base de donnée
           try {
            $bdd = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', 'root');
        } catch (Exception $e) {
            die($e->getMessage());
        }
            $count = $bdd->prepare('SELECT COUNT(*) FROM voiture WHERE id_voiture = ?');
            $count->execute(array($id));
            $compteur = $count->fetch();

            if ($compteur[0] > 0) {
                $type = $bdd->prepare('SELECT * FROM voiture WHERE id_voiture = ?');
                $type->execute(array($id));
                $row = $type->fetch();

        ?>
                <div class="card p-1">
                    <div class="text-end">
                        <a class="btn btn-danger" href="index.php">X</a>
                    </div>
                    <div class=" row p-5 d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <h2><?= $row['marque'] . ' ' . $row['nom'] ?></h2>
                            <h4 class="fst-italic my-5"><?= $row['description'] ?></h4>
                            <h3 class="btn btn-secondary py-2"><?= $row['prix'] ?> €</h3>
                        </div>
                        <div class="col-md-6">
                            <img class="mw-100 rounded shadow" src="./<?= $row['photo'] ?>" alt="">
                        </div>
                    </div>

                </div>





        <?php
            } else header('Location: index.php');
        } else header('Location: index.php');


        ?>

    </div>
    <?php include "footer.php" ?>
</body>

</html>