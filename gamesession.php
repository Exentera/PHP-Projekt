<?php
    include ("fkt.php");
    session_start();
    check_game_id();
    // generate_header('NOOOOOOB<br>NOOOOOOB<br>NOOOOOOB');
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Index</title>

            <link rel="stylesheet" href="menu.css" />
            <link rel="stylesheet" href="main.css" />
            <link rel="stylesheet" href="spielfeld.css" />

            <link href="https://fonts.cdnfonts.com/css/auto-mode" rel="stylesheet">
            <link href="https://fonts.cdnfonts.com/css/neonize" rel="stylesheet">
        </head>

        <body>
            <header class="spiel">

                <div class="statusanzeige grid-container">
                    <div>
                        <div class="p1leben">Leben</div>
                    </div>
                    <div>
                        <div class="zugnummer">'.turn_nr().'</div>
                    </div>
                    <div>
                        <div class="p2leben">Leben</div>
                    </div>
                </div>

                <div class="turndiv grid-container">
                    <div></div>
                    <div class="zugbutton">';
                        turn_button();
                        echo 
                    '</div>
                    <div></div>
                </div>

                <div class="spielfeld grid-container">
                    <div class="p1img">Bild 1</div>
                    <div class="log">Spiellog</div>
                    <div class="p2img">Bild 2</div>
                </div>

                <div class="info grid-container">
                    <div class="deck">Deck</div>
                    <div class="turninfo">'.turn_who().'</div>
                    <div class="ablagestapel">Ablagestapel</div>
                </div>

                <div class="hand grid-container">';
                    draw();
                echo '</div>
            </header>
        </body>'
    ;



    sqlconnect();



    function check_game_id(){ //test id generieren
        return 1;
    }
    


     
    gamesession_navbar();
    close_header();
    // generate_footer();
    close_html();