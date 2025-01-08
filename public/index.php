<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index</title>

    <link rel="stylesheet" href="menu.css" />
    <link rel="stylesheet" href="main.css" />


    <link href="https://fonts.cdnfonts.com/css/auto-mode" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/neonize" rel="stylesheet">
  
  </head>
  <body class="startfx">
    

    <header id="start">
      <div class="overlay">
        <h1>WILLKOMMEN</h1>
      </div>
    </header>

    <div class="menu">
      <div class="logo">
        <!-- <img src="Planung-Startseite.png" alt="" width="40" /> -->
      </div>
      <?php //require("/navbar.php") ?>
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

    </div>

    <main>
      <h2>Lorem.</h2>
      <section>
        <article>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam iste
          vel necessitatibus, autem ut consequatur nam doloremque, quam
          doloribus deleniti officiis possimus praesentium inventore fugiat
          amet, commodi veritatis cupiditate corrupti?
          <br />
          <br />
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. A aut
          eligendi eum recusandae vel dicta adipisci, minus quo iste totam esse
          numquam. Officiis, magnam tempore.
          <br />
          <br />
          Odit explicabo mollitia reprehenderit vel fugiat similique provident
          assumenda illo rerum nemo ad amet sapiente modi est dicta soluta
          doloribus, quod animi ullam doloremque deleniti ea porro culpa sed?
          Aspernatur, molestiae cupiditate? Nulla molestias recusandae hic magni
          sunt perspiciatis. Vero impedit consequuntur repudiandae provident
          porro, itaque officiis doloremque molestias temporibus ad veniam
          maxime facilis expedita! Iste quasi vero et repudiandae dolorum
          similique ad tempore ipsa odit, voluptatibus velit in a illum tenetur,
          alias porro. Animi optio fuga eaque vitae nihil iste ex neque placeat
          nisi dicta eveniet, vel asperiores accusamus possimus libero odio
          officia nemo dolorum labore quod blanditiis laudantium.
          <br />
          <br />
          Dolorum nobis ea accusantium sint amet maiores ipsum delectus
          quibusdam et voluptas aspernatur, quisquam explicabo dignissimos
          consequatur. Iusto quis quisquam accusantium adipisci temporibus
          alias, totam eligendi maiores reiciendis dolorem aliquam quo
          aspernatur, esse fuga autem ut odio possimus error.
          <br />
          <br />
          Libero ratione maiores esse. Facilis, velit dolorem! Veniam veritatis
          corrupti odio porro nesciunt, et excepturi unde.
        </article>
      </section>


      <div class="cards">
        <div class="card">div card 1</div>
        <div class="card">div card 2</div>
        <div class="card">div card 4</div>
      </div>

            <section>
        <article>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam iste
          vel necessitatibus, autem ut consequatur nam doloremque, quam
          doloribus deleniti officiis possimus praesentium inventore fugiat
          amet, commodi veritatis cupiditate corrupti?
          <br />
          <br />
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. A aut
          eligendi eum recusandae vel dicta adipisci, minus quo iste totam esse
          numquam. Officiis, magnam tempore.
          <br />
          <br />
          Odit explicabo mollitia reprehenderit vel fugiat similique provident
          assumenda illo rerum nemo ad amet sapiente modi est dicta soluta
          doloribus, quod animi ullam doloremque deleniti ea porro culpa sed?
          Aspernatur, molestiae cupiditate? Nulla molestias recusandae hic magni
          sunt perspiciatis. Vero impedit consequuntur repudiandae provident
          porro, itaque officiis doloremque molestias temporibus ad veniam
          maxime facilis expedita! Iste quasi vero et repudiandae dolorum
          similique ad tempore ipsa odit, voluptatibus velit in a illum tenetur,
          alias porro. Animi optio fuga eaque vitae nihil iste ex neque placeat
          nisi dicta eveniet, vel asperiores accusamus possimus libero odio
          officia nemo dolorum labore quod blanditiis laudantium.
          <br />
          <br />
          Dolorum nobis ea accusantium sint amet maiores ipsum delectus
          quibusdam et voluptas aspernatur, quisquam explicabo dignissimos
          consequatur. Iusto quis quisquam accusantium adipisci temporibus
          alias, totam eligendi maiores reiciendis dolorem aliquam quo
          aspernatur, esse fuga autem ut odio possimus error.
          <br />
          <br />
          Libero ratione maiores esse. Facilis, velit dolorem! Veniam veritatis
          corrupti odio porro nesciunt, et excepturi unde.
        </article>

    </main>

    <footer>
      <div class="flex33">
       Text
      </div>

      <div class="flex33">
        <a href="#start">Home</a>
        <p>|</p>
        <a href="kontakt.php">Kontakt</a>
        <p>|</p>
        <a href="imprssum.php">Impressum</a>
      </div>

      <div class="flex33">
        Text
      </div>
    </footer>
  </body>
</html>
