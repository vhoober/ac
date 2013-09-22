<?php
 ob_start(); /* open output buffer to counter header error */
require_once 'adminzone/configuration/config.php';
require_once 'includes/class/DBQuery.php';
$db = new DBQuery();

session_start();

$pageid = $_GET['pageid'];
if(!isset($pageid))
{
   $pageid = 1;
}

$queryPage = "SELECT * FROM page
              WHERE pageid = '".$pageid."'
                  AND status = 'active'
                  AND version = 'english'";
$resultPage = $db->executeQuery($queryPage, $connectionParameters);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php
       		      	if(isset($_GET['spid']))
       		      	{
                                    switch ($_GET['spid'])
                                    {
                                        case "1":
                                        {
                                            echo 'Atchia Ceramica Ltd - Products';
                                            break;
                                        }

                                        case "2":
                                        {
                                            echo 'Atchia Ceramica Ltd - Gallery';
                                            break;
                                        }

                                        case "3":
                                        {
                                            echo 'Atchia Ceramica Ltd - Contact us';
                                            break;
                                        }

                                    }
       		      	}
       		      	else
       		      	{
       		      		echo $resultPage[0]['pagetitle'];
       		      	}

?></title>
<meta name="keywords" content="<?php echo $resultPage[0]['keyword'];?>" />
<meta name="description" content="<?php echo $resultPage[0]['description'];?>" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/lightbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/turn.min.js"></script>
</head>
<body>

<div id="main">
<!-- header begins -->
<div id="header">
    <div id="logo">
    </div>
    <div id="buttons">
<?php
// Get pages - permanent and optional
$pages = "select `page`.`pageid` AS `pageid`,`page`.`title` AS `title` from `page` where (`page`.`version` = 'english') order by `page`.`pageid`,`page`.`type`";
$get_pages = $db->executeQuery($pages, $connectionParameters);

if(count($get_pages) > 0)
{
    for($i=0; $i<count($get_pages); $i++)
    {
        echo '<a href="index.php?pageid='.$get_pages[$i]['pageid'].'"  class="but" title="">'.$get_pages[$i]['title'].'</a>';
    }
}
?>
          <a href="index.php?spid=1"  class="but" title="">Products</a>
          <a href="index.php?spid=2"  class="but" title="">Gallery</a>
          <a href="index.php?spid=3" class="but" title="">Contact us</a>
    </div>
</div>
<!-- header ends -->
    <!-- content begins -->

    	<div id="content">
            <div id="left">
           	  <div class="tit_bot">
       		    <div class="tit">
       		      <h1><span class="tit_span">
       		      <?php
       		      	if(isset($_GET['spid']))
       		      	{
                                    switch ($_GET['spid'])
                                    {
                                        case "1":
                                        {
                                            echo 'Products';
                                            break;
                                        }

                                        case "2":
                                        {
                                            echo 'Gallery';
                                            break;
                                        }

                                        case "3":
                                        {
                                            echo 'Contact us';
                                            break;
                                        }

                                    }
       		      	}
       		      	else
       		      	{
       		      		echo $resultPage[0]['title'];
       		      	}
       		      ?>
       		      &nbsp;</span></h1>
       		    </div>
                  	<div class="text" style="margin-left:10px;">
                            <?php
                                if(isset($_GET['spid']))
                                {
                                    switch ($_GET['spid'])
                                    {
                                        case "1":
                                        {
                                            require_once 'pages/products.php';
                                            break;
                                        }

                                        case "2":
                                        {
                                            require_once 'pages/gallery.php';
                                            break;
                                        }

                                        case "3":
                                        {
                                            require_once 'pages/contactus.php';
                                            break;
                                        }

                                    }
                                }
                                else
                                {
                                    echo stripslashes($resultPage[0]['body']);
                                }
                                ?>
                    	                  	
           	  	</div>
           	  </div>
            </div>
            <br />
            <div style="clear: both"><img src="images/spaser.gif" alt="" width="1" height="1" /></div>
         <!-- footer begins -->
            <div id="footer">
          Copyright  2011. Designed by <a href="http://www.metamorphozis.com/" title="Flash Templates">Flash Templates</a><br />
                Website Created By <a href="http://www.virajtech.com">Viraj</a> & <a href="http://www.yaseenportal.com">Yaseen</a></div>
        <!-- footer ends -->
        </div>
    <!-- content ends -->
</div>
<div style="text-align: center; font-size: 0.75em;"></div></body>
</html>
<?php  ob_end_flush(); /* turn off output buffer */ ?>
