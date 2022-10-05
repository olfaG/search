<?php

            // ------------POUR L'IMPORT CSV--------------
            // Obtenir les rangées de membres

            //configuration de la base de donnée
            $dbHost     = "localhost"; 
            $dbUsername = "root"; 
            $dbPassword = ""; 
            $dbName     = "recherche"; 
 
            // création de la connexion
            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
            // vérifier la connexion
            if ($db->connect_error) { 
            die("erreur de connexion: " . $db->connect_error); 
            }

            $result = $db->query("SELECT * FROM data ORDER BY id DESC");
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['inscription']; ?></td>
                    <td><?php echo $row['lecons']; ?></td>
                    <td><?php echo $row['chapitres']; ?></td>
                    <td><?php echo $row['modules']; ?></td>
                    <td><?php echo $row['quizz']; ?></td>
                    <td><?php echo $row['points']; ?></td>
                    <td><?php echo $row['dercon']; ?></td>
                </tr>
            <?php } }else{ ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
            <?php } ?>