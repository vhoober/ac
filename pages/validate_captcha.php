<?php
session_start();


if($_SESSION["captcha"]==$_GET["q"])
{
    //CAPTHCA is valid; proceed the message: save to database, send by e-mail ...
    echo 1;
}
else
{
    if($_SESSION['setlang'] == "EN")
    {
        echo 'Invalid code. Please insert again.';
    }
    else
    {
        echo 'Code erron&#233;. Veuillez r&#233;inserer.';
    }
}

?>
