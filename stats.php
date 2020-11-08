<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
<head>
    <meta charset="utf-8">
    <title>Jeu</title>
</head>
<body>
    <?php
        //This file is used to display a specific game with its id sent through the url
        include 'header.php';
    ?>
    <div class="corps">
        <div id="titre_stats">
            Les statistiques de UnTrollBienMécontent
        </div>
        <?php
            /* a function which let us know the best way to display our graph with a logarithmic logic */
            function percent($nb){
                $max = 10;
                while($nb>=$max){
                    $max *=10;
                }
                $per = (int) $nb/$max * 100;
                return array('max'=> $max,'per' => $per);
            }

            /* We initialize all the datas we need to build our graphs */

            $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

            // We get all the number of users on this site
            $sql_nb_users='SELECT COUNT(*) AS nb_users FROM utilisateur';
            $req_nb_users = $db->prepare($sql_nb_users);
            $req_nb_users->execute();
            $nb_users= $req_nb_users->fetch();

            // We get the ages of peoples on the site
            $sql_ages='SELECT date_de_naissance FROM utilisateur';
            $req_ages = $db->prepare($sql_ages);
            $req_ages->execute();
            $ages= $req_ages->fetch();

            // We get all the number of games on this site
            $sql_nb_games='SELECT COUNT(*) AS nb_games FROM jeux';
            $req_nb_games = $db->prepare($sql_nb_games);
            $req_nb_games->execute();
            $nb_games= $req_nb_games->fetch();

            // We get all the number of critics published on this site
            $sql_nb_critics='SELECT COUNT(*) AS nb_critics FROM critiques';
            $req_nb_critics = $db->prepare($sql_nb_critics);
            $req_nb_critics->execute();
            $nb_critics= $req_nb_critics->fetch();

            // We get all the number of private messages sended on this site
            $sql_nb_messages='SELECT COUNT(*) AS nb_messages FROM messages';
            $req_nb_messages = $db->prepare($sql_nb_messages);
            $req_nb_messages->execute();
            $nb_messages= $req_nb_messages->fetch();


        ?>
        <!-- Display the graph about the number of games on this site -->
        <div class="rubrique_graphique">
            <div class="titre_graph">
                Nombre de jeux :
            </div>
            <div id="max">
                <?php
                    echo percent($nb_games['nb_games'])['max'];
                ?>
            </div>
            <div class="background_graph_1">
                <div class="rectangle_stat taille<?=percent($nb_games['nb_games'])['per']?>">
                    <?php
                        if($nb_games['nb_games'] != 0){
                            echo $nb_games['nb_games'];
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Display the graph about the number of critics published on this site -->
        <div class="rubrique_graphique">
            <div class="titre_graph">
                Nombre de critiques :
            </div>
            <div id="max">
                <?php
                    echo percent($nb_critics['nb_critics'])['max'];
                ?>
            </div>
            <div class="background_graph_1">
                <div class="rectangle_stat taille<?=percent($nb_critics['nb_critics'])['per']?>">
                    <?php
                        if($nb_critics['nb_critics']!=0){
                            echo $nb_critics['nb_critics'] ;
                        }
                    ?>
                </div>
            </div>
        </div>
        <br />

        <br />
        <!-- Display the graph about the number of users on this site -->
        <div class="rubrique_graphique" >
            <div class="titre_graph">
                Nombre d'utilisateurs :
            </div>
            <div id="max">
                <?php
                    echo percent($nb_users['nb_users'])['max'];
                ?>
            </div>
            <div class="background_graph_1">
                <div class="rectangle_stat taille<?=percent($nb_users['nb_users'])['per']?>">
                    <?php
                        if($nb_users['nb_users']!=0){
                            echo $nb_users['nb_users'] ;
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Display the graph about the number of private messages sended -->
        <div class="rubrique_graphique">
            <div class="titre_graph">
                Nombre de messags privés envoyés :
            </div>
            <div id="max">
                <?php
                    echo percent($nb_messages['nb_messages'])['max'];
                ?>
            </div>
            <div class="background_graph_1">
                <div class="rectangle_stat taille<?=percent($nb_messages['nb_messages'])['per']?>">
                    <?php
                        if($nb_messages['nb_messages']!=0){
                            echo $nb_messages['nb_messages'];
                        }
                    ?>
                </div>
            </div>
        </div>


    </div>
</body>
</html>
