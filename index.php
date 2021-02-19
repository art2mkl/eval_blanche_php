<?php include "head.php" ?>

<body>

    <?php include "nav.php" ?>

    <div class="container">



        <form action="ajouter.php" method='post' class="w-100 mx-auto pt-5 my-3 " enctype="multipart/form-data">

            <h1 class="py-4">Enregistre ta caisse</h1>

            <div class="mb-3">
                <label for="nom" class="form-label">Entrez le nom du véhicule</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="marque" class="form-label">Entrez la marque</label>
                <input type="text" class="form-control" id="marque" name="marque" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Entrez le prix</label>
                <input type="number" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Choisissez une image</label>
                <input id="image" type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary mb-3">envoyer</button>
        </form>

        <table class="table table-bordered border-secondary table-striped py-5 my-5">
            <tr>
                <th class="text-center" scope="col">Nom</th>
                <th class="text-center" scope="col">Marque</th>
                <th class="text-center" scope="col">Prix</th>
                <th class="text-center" scope="col">Photo</th>
                <th class="text-center" scope="col">Description</th>
                <th class="text-center" scope="col"></th>
            </tr>

            <?php
            //ouverture de la base de donnée
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
                die($e->getMessage());
            }

            $query = $bdd->query('SELECT * FROM VOITURE ORDER BY id_voiture');
            while ($row = $query->fetch()) {
            ?>
                <tr class="">
                    <td class="text-center"><?= $row['nom'] ?></td>
                    <td class="text-center"><?= $row['marque'] ?></td>
                    <td class="text-center"><?= $row['prix'] ?> €</td>
                    <td class="text-center"><img src="./<?= $row['photo'] ?>" alt="photo voiture"></td>

                    <!-- gestion de la logueur de la chaine -->
                    <td class="text-center"><?= strlen($row['description']) >= 50 ? substr($row['description'], 0, 50) . "..." : $row['description']; ?></td>
                    <td class="text-center"><a href="description.php" class="btn btn-info">en savoir plus</a></td>
                </tr>
            <?php
            }
            ?>

        </table>

    </div>
    <?php include "footer.php" ?>
</body>

</html>