<?php
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';

$db = new DBQuery();

$query = "SELECT SUM(sub_total) AS SUBTOTAL FROM tmp_basket";	
$result = $db->executeQuery($query, $connectionParameters);

$subtotal = number_format($result[0]['SUBTOTAL'], 2, '.', '');

// Need to verify if transport is checked, if so add transport amt to subtotal
echo "<script>
    var total ='';
	var subtotal = '';
		
	subtotal = ".$subtotal.";	
			
    if($('#chkTransportRequired').attr('checked'))
    {
        if($('#cboTransport').val() != -1)
        {
			subtotal = subtotal + parseFloat($('#cboTransport').val());
        }
    }		
		
    $('#txtSubTotal').val(subtotal.toFixed(2));
        
    if($('#txtDiscount').val().length > 0)
    {
        total = subtotal - $('#txtDiscount').val();
    }
    else
    {
        total = subtotal;
    }
    $('#txtGrandTotal').val(total.toFixed(2));
   </script>";
?>
