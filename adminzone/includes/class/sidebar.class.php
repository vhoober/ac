<?php
class Sidebar{
    var $sidebar;
    var $connectionParameters;

    // constructor
    function Sidebar($connectionParameters)
    {
        $this->sidebar = "";
        $this->connectionParameters = $connectionParameters;
    }

    // Header section - sign out, change password
    function SidebarHeader($displayname)
    {
        $this->sidebar .= '
<table border="0" cellspacing="0" cellpadding="5" width="100%">
<tr>
    <td valign="top">
        <table border="0">
            <tr>
                <td colspan="2">
                    <label class="sideHeaderText">Welcome </label> <label class="adminName">'.$displayname.'</label>
                    <br>
                    <label class="adminSubText">AdminZone enables privilege user(s) and administrator(s) to maintain the website</label>
                    <br><br>
                    <a href="website.php?act=action&mod=logout">SIGN OUT</a><hr>
                </td>
            </tr>';

	if($_SESSION['currentuserinfo'][2] == 2)
	{
		$this->SidebarAdmin();
	}
	else
	{
    		$this->SidebarProduct();
	}			
       
    }


    
    // product section
    function SidebarProduct()
    {
      $this->sidebar .= '
            <tr>
                <td colspan="2" class="sidebarSectionHeader"<hr>PRODUCT<hr></td>
            </tr>           
     	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=listproduct">List Product</a> | <a href="website.php?act=action&mod=addproduct">Add Product</a></td>
            </tr>';
      // Query to check if stock level of any product is low
      $db = new DBQuery();
      
      $queryProductLevel = "SELECT COUNT(*) AS stock_level FROM products WHERE Quantity < ReorderLevel";
      $resultProductLevel = $db->executeQuery($queryProductLevel, $this->connectionParameters);
      
      if($resultProductLevel[0]['stock_level'] > 0)
      {
      	$this->sidebar .= '
     	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
				<td><a href="website.php?act=action&mod=displaylowstockproducts"><img src="images/lowlevel.gif" border="0"</a></td>
            </tr> ';
      }
      
 $this->sidebar .= '<tr>
                <td colspan="2" height="20"></td>
            </tr>            
            ';     
    	
    	$this->SidebarInvoice();
    }

    // Added Yaseen
        // invoice section
    function SidebarInvoice()
    {
      $this->sidebar .= '
            <tr>
                <td colspan="2" class="sidebarSectionHeader"<hr>INVOICE MGT<hr></td>
            </tr>  
     	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=invoice">Invoice</a></td>
            </tr>
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=returninwards">Return Inwards</a></td>
            </tr>
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=listpaymentreceived">Payment Received</a></td>
            </tr>
            <tr>
                <td colspan="2" height="20"></td>
            </tr>            
            ';     
    	
    	//$this->SidebarUpload();
      	$this->SidebarFooter();
    }

    //End Yaseen
    
    // upload section - determine if image is for a product or for gallery
    function SidebarUpload()
    {
      $this->sidebar .= '
            <tr>
                <td colspan="2" class="sidebarSectionHeader"<hr>UPLOAD<hr></td>
            </tr>
     	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=uploadphoto">Upload Photo</a></td>
            </tr>
            <tr>
                <td colspan="2" height="20"></td>
            </tr>             
            ';    	

	$this->SidebarFooter();
    }

    // Reports section
    function SidebarReports()
    {
      $this->sidebar .= '
            <tr>
                <td colspan="2" class="sidebarSectionHeader"<hr>REPORTS<hr></td>
            </tr>
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
				<td><a href="report/filemanager/browse.php" target="_blank">List Reports</a></td>
            </tr>			
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=cash_sales">Cash Sales</a></td>
            </tr>
    	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=VAT_cash_sales">VAT Cash Sales</a></td>
            </tr>
            <tr>
                <td colspan="2" height="20"></td>
            </tr>                        
            ';    	
    	
    
	$this->SidebarProduct();
    }
    
    
    
    // Section allowable to only admin - Add/Edit/Deactivate/Delete user details, edit company info,
    function SidebarAdmin()
    {
      $this->sidebar .= '
            <tr>
                <td colspan="2" class="sidebarSectionHeader"<hr>ADMIN SECTION<hr></td>
            </tr>
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td><td><a href="website.php?act=action&mod=changepwdform">Change Password</a>
                </td>
            </tr>	
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td><td><a target="blank" href="homepage.php">Homepage</a>
                </td>
            </tr>	
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=companyinfo">Company Info</a></td>
            </tr>
     	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=listsupplier">List Supplier</a> | <a href="website.php?act=action&mod=addsupplier">Add Supplier</a></td>
            </tr>               
            <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td><td><a href="website.php?act=action&mod=category">Category (List / Add / Edit)</a>
                </td>
            </tr>                    
    	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=listuser">List User</a> | <a href="website.php?act=action&mod=adduser">Add User</a></td>
            </tr>
    	    <tr>
                <td width="3%"><img border="0" src="images/ul_icon.png"></td>
		<td><a href="website.php?act=action&mod=transport">Delivery Region (List / Add / Edit)</a></td>
            </tr>
            <tr>
                <td colspan="2" height="20"></td>
            </tr>                        
            ';
	$this->SidebarReports();
    }   
    
    
    // footer - display adminzone logo
    function SidebarFooter()
    {
      $this->sidebar .= '  </table>
    </td>
    <td valign="top"><img border="0" src="images/sidebarimg.png" />
    </td>
</tr>
</table>
';
    }

     // Gets the contents of the page
     function get()
     {
       return $this->sidebar;
     }
}// end class
?>
