<?php
error_reporting(0);

// function to read configuration file
function displayConfig($msg="")
{
    $filename = "../configuration/config.php";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);

    $params = explode("*", $contents);
    $values = explode(",", substr($params[0],8));

    $output = "";
    $output .= "<form method='post' action='configure_config.php'>
                    <table align='center' border='0'>
                        <tr>
                            <td colspan='2' height='15'>&nbsp;</td>
                        </tr>";
                        if($msg != "")
                        {
                            $output .=  "<tr>
                                            <td colspan='2' align='center' bgcolor='#DEDEDE'><font color='#0000FF'>".$msg."</font></td>
                                        </tr>";
                        }

            $output .=  "<tr>
                            <td>Host</td>
                            <td> : <input type='text' name='host' value='".$values[0]."' /></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td> : <input type='text' name='username' value='".$values[1]."' /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td> : <input type='password' name='password' value='".$values[2]."' /></td>
                        </tr>
                        <tr>
                            <td>Database</td>
                            <td> : <input type='text' name='database' value='".$values[3]."' /></td>
                        </tr>
                        <tr>
                            <td colspan='2'><hr></td>
                        </tr>
                        <tr>
                            <td>Admin Email</td>
                            <td> : <input type='text' name='admin_email' value='".$values[4]."' /></td>
                        </tr>
                        <tr><td colspan='2' height='10'>&nbsp;</td></tr>
                        <tr>
                             <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;<input type='submit' name='Operation' value='Write' /></td>
                        </tr>
                    </table>
                </form>";
    return $output;
}
// end of function

echo "<center><h3>Configure Configuration File</h3></center>";
if($_POST['Operation'] == "Write")
{
    // Write to config file and display msg and new config values
    $fp = fopen('../configuration/config.php', 'w');
    $content = "<?php
//".$_POST['host'].",".$_POST['username'].",".$_POST['password'].",".$_POST['database'].",".$_POST['admin_email']."*
\$connectionParameters['host'] = \"".$_POST['host']."\";
\$connectionParameters['username'] = \"".$_POST['username']."\";
\$connectionParameters['password'] = \"".$_POST['password']."\";
\$connectionParameters['database'] = \"".$_POST['database']."\";
\$adminEmail = \"".$_POST['admin_email']."\";
?>";
    fwrite($fp, $content);
    fclose($fp);
    echo displayConfig("Config file modified successfully!");
    exit;
}
else
{
    // Read config file
    echo displayConfig();
    exit;
}

?>