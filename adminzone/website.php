<?php
error_reporting(0);
ob_start();  // open output buffer to counter header error
session_start();

if(!isset($_SESSION['valid']))
{header("location:index.php");exit;}

require_once 'configuration/config.php';
require_once '../includes/class/DBQuery.php';
require_once '../includes/class/ps_pagination.php';
require_once 'includes/class/password.class.php';
require_once 'includes/class/class.upload.php';
require_once 'includes/class/sidebar.class.php';

// Include editor
//require_once 'editor/FCKeditor/fckeditor.php';

?>
<html>
    <head><title>AdminZone - Master of the website</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/lightbox.css" rel="stylesheet" type="text/css" />
     <link href="css/demo_table.css" rel="stylesheet" type="text/css" />
<link href="css/tableorderer.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
    <!-- <script src="../js/form_validator.js" type="text/javascript"></script> -->
    <script src="../js/general.js" type="text/javascript"></script>

    <!--<script type="text/javascript" src="js/lightbox.js"></script>-->
    <script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/script.js"></script>        
<script type="text/javascript" src="js/table_orderer.js"></script>
    </head>
    <body>
        <table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
            <tr>
                <td bgcolor="#F0F0F0" width="25%" valign="top">
                    <?php                 
                    $sidebar = new Sidebar($connectionParameters);
                    $sidebar->SidebarHeader($_SESSION['currentuserinfo'][1]);
                    echo $sidebar->get();
                 
                    ?></td>
                <td width="2%"></td>
                <td valign="top" width="73%" background="images/macosx.png">
                    <table cellspacing="10" cellpadding="0" width="100%">
                        <tr><td>
                    <?php
                        if($_GET['act'] == "action")
                        {    
                          require_once 'includes/action.php';
                        }?>
                            </td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
<?php
ob_end_flush();  // turn off output buffer
?>
