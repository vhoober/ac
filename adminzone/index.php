<?php
ob_start();  // open output buffer to counter header error
session_start();

require_once 'configuration/config.php';
require_once '../includes/class/DBQuery.php';

// Page class
class AdminLogin {

 // Declare a class member variable
 var $page;
 var $msg;
 var $connectionParameters;
 var $username;
 var $password;

 // The constructor function
 function AdminLogin()
 {
   $this->page = '';
 }


 // Adds some more text to the page
 function AdminContent($msg)
 {
   $this->page .= '
<html>
    <head><title>Secure Login - AdminZone</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body bgcolor="#000000">
    <br><br><br><br><br><br><br><br><br>
    <center>
        <form method="post" action="index.php" name="frm1">
        <table border="0" cellspacing="0" cellpadding="0" width="350" height="150" background="images/logincenterbackground.jpg">';

     $this->page .= '
            <tr>
                <td colspan="2" align="center" class="warningmsg">'.$this->msg=$msg.'</td>
            </tr>
        ';

 $this->page .= '<tr>
                <th class="loginText">Username</th>
                <td> : <input type="text" name="frmusername" /></td>
            </tr>
            <tr>
                <th class="loginText">Password</th>
                <td> : <input type="password" name="frmpassword" /></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td>&nbsp;&nbsp;<input class="buttonText" type="submit" name="logmein" value="Login" /></td>
            </tr>
        </table>
        </form>
    </center>
    </body>
</html>
';
 }

 function ProcessForm($username, $password, $connectionParameters)
 {
     $db = new DBQuery();

     $query = "SELECT * FROM users WHERE Username ='".$this->username = $username."' AND Password = '".$this->password = md5($password)."'";
     $result = $db->executeQuery($query, $this->connectionParameters = $connectionParameters);

     if(count($result) > 0)
     {
         $currentUser = array();
	 $_SESSION['currentuserinfo'] = "";
	 $_SESSION['valid'] = "";
         $currentUser[0] = $result[0]['ID'];
         $currentUser[1] = $result[0]['displayedname'];
	 $currentUser[2] = $result[0]['UserLevel'];
         $_SESSION['currentuserinfo'] = $currentUser;
         $_SESSION['valid'] = "yes";

         return 1;
     }
     else
     {
         return 0;
     }
 }

 // Gets the contents of the page
 function get()
 {
   return $this->page;
 }

} // end of class

// Instantiate the Page class
$webPage = new AdminLogin();

// Process form when posted
if($_POST['logmein'] == "Login")
{
    if(!empty($_POST['frmusername']) && !empty($_POST['frmpassword']))
    {
        $result = 0;
        $result = $webPage->ProcessForm($_POST['frmusername'], $_POST['frmpassword'], $connectionParameters);

        if($result == 1)
        {
            // Login successful - go to website
            header("location:website.php");
        }
        else
        {
            // Redirect to login page with error message
            $webPage->AdminContent($msg="Wrong Username and/or Password!!!");
            echo $webPage->get();
        }
    }
    else
    {
        // Username and password haven't been entered
        $webPage->AdminContent($msg="Please enter Username and/or Password!!!");
        echo $webPage->get();
    }
}
 else {
    // Display the page
    $webPage->AdminContent($msg="Please Login!!!");
    echo $webPage->get();
}

ob_end_flush();  // turn off output buffer
?>
