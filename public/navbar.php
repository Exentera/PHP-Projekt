      <nav class="navigation"  id="home">
        <ul>
          <li>
            <a class="na1" href="http://localhost/php/TGC/index/index.php">Home</a>
          </li>
          <li>
            <a class="na2" href="http://localhost/php/TGC/index/kontakt.php">Kontakt</a>
          </li>
          <li>
            <a class="na3" href="http://localhost/php/TGC/index/imprssum.php">Impressum</a>
          </li>
          <li>
            <?php
            session_start();
              if (isset($_SESSION['user_id'])) {
                  // Benutzer ist eingeloggt
                  // echo "Die Session ist aktiv.";
                echo "<li>";
                  echo "<a class='na3' href='/php/TGC/index/logout.php'>Logout</a>";
                echo "</li>";
              } else {
                // Benutzer ist nicht eingeloggt
                // echo "Die Session ist nicht aktiv.";
                echo "<a class='na3' href='http://localhost/php/TGC/index/login_tcg.php'>Login</a>";
              }
            ?>
          </li>
        </ul>
      </nav>