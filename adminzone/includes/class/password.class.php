<?php
class Password
{
    var $username;
    var $password;
    var $confirmpassword;
    var $form;

    function Password()
    {
        $this->username = "";
        $this->password = "";
        $this->confirmpassword = "";
    }

    function EditPasswordForm()
    {
        $this->form .= <<<EOD
        <form method="post" action="website.php?act=action&mod=savenewpassword" id="frm2" name="frm2">
        <label class="contentHeader">Change Password</label><br><br>
        <table border="0" cellspacing="10" cellpadding="0" class="contentText">
            <tr>
                <td>Username</td>
                <td> : <input type="text" name="frmusername" /></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td> : <input type="password" name="frmnewpassword" /></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td> : <input type="password" name="frmconfpassword" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;<input type="submit" name="savepwd" class="buttonText" value="Change Password" /></td>
            </tr>
        </table>
        </form>
        <script type="text/javascript">
 var frmvalidator  = new Validator("frm2");
 frmvalidator.addValidation("frmusername","req","Please enter your Username");
 frmvalidator.addValidation("frmnewpassword","req","Please enter New Passord");
  frmvalidator.addValidation("frmconfpassword","req","Please re-type your New Password");
</script>

EOD;
    }

    function SaveNewPassword($loginid, $username, $password, $confirmpassword, $con)
    {
        if(md5($password) == md5($confirmpassword))
        {
            $db = new DBQuery();

            $update = "UPDATE Users SET Password = '".$this->password = md5($password)."'
                       WHERE Username = '".$this->username = $username."'
                       AND ID = '".$loginid."'";
            $db->executeNonQuery($update, $con);

            $this->form = '<label class="infomsg">Your password has been changed successfully! Your new password will be applied the next time you login.</label>';
        }
        else
        {
            $this->form = '<label class="infomsg">Password and confirmpassword do not match! Try again</label>';
        }
    }

 // Gets the contents of the page
 function get()
 {
   return $this->form;
 }

} // end class

?>
