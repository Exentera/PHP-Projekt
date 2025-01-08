<?php

function logout(){
    session_start();
    session_destroy();
    header("Location: \php\TGC\index\index.php");
}
?>