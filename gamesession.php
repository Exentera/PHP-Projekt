<?php
    include ("fkt.php");
    generate_header('NOOOOOOB<br>NOOOOOOB<br>NOOOOOOB');
    sqlconnect();



    function check_game_id(){ //test id generieren
        return 1;
    }
    check_game_id();


    function turn(){

        $game_id = check_game_id();
        if (isset($_POST['end_turn']) && $_POST['end_turn'] == 'ZugBeenden') {
            
            $sql_next_turn = 
                'UPDATE game_sessions
                SET turn = turn + 1
                WHERE game_id = '.$game_id.';'
            ;

            mysqli_query(sqlconnect(), $sql_next_turn);
            header("Location: gamesession.php"); 
        }

        $sql_turn = 
            'SELECT turn 
            FROM game_sessions 
            WHERE game_id = '.$game_id.';'
        ;

        $result = mysqli_query(sqlconnect(),$sql_turn);
        $turn = mysqli_fetch_array($result);

        if($turn['turn'] % 2 == 1){
            echo '<div class="login_position">
                <form class="menu" action="gamesession.php" method="POST">
                    <input type="hidden" name="end_turn" value="ZugBeenden">
                    <input type="submit" value="Zug Beenden">
                </form>    
                <p> Du bist am zug! </p>
                <p>Zug '.$turn['turn'].'</p>
            </div>'; 
        }
        else{
            echo '<div class="login_position">
                <form class="menu" action="gamesession.php" method="POST">
                    <input type="hidden" name="end_turn" value="ZugBeenden">
                    <input type="submit" value="Zug Beenden">
                </form>                
                <p> Der Gegner ist am zug! </p>
                <p>Zug '.$turn['turn'].'</p>
            </div>';
        }
    }
    turn();
     
    generate_navbar();
    close_header();
    generate_footer();
    close_html();