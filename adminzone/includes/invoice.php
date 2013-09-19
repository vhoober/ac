<link href="js/select2/select2.css" rel="stylesheet"/>
<script src="js/select2/select2.js"></script> 
<?php
// Truncate table tmp_basket in case previous user left without saving invoice
$db = new DBQuery();

$truncateBasket = "TRUNCATE TABLE tmp_basket";
$db->executeNonQuery($truncateBasket, $connectionParameters);
?>
<form id="formInvoice" method="post" action="">
<div id="invoice_region">
<!-- Fieldset customer 
<?php //echo substr($_SERVER['HTTP_REFERER'], 0, (strlen($_SERVER['HTTP_REFERER']) - 11));?>
-->  

<fieldset><legend>Customer Details</legend>
  <table  border="0" cellpadding="0" cellspacing="0" id="tableHeader">
    <tr>
    <!-- onchange="GetCustomerDetails('customer_result',this.value);" -->
        <td>SEARCH CUSTOMER (By name) :     <select id="search_customer">
                <option value="-1">Please select customer name</option>
				<?php
					$customer = "SELECT CustomerID, Name FROM customer ORDER BY Name ASC";
					$resultCustomer = $db->executeQuery($customer, $connectionParameters);
					
					if(count($resultCustomer) > 0){
					for($x=0;$x<count($resultCustomer);$x++){
				?>
					<option value="<?php echo $resultCustomer[$x]['CustomerID']?>" id="<?php echo $resultCustomer[$x]['CustomerID']?>"><?php echo strtoupper($resultCustomer[$x]['Name'])?></option>
				<?php } }?>
            </select>&nbsp;&nbsp;<input type="button" value="Create New Customer" id="butCreateCustomer" />
        </td>          
    </tr>
    <tr>
        <td>
            <span id="customer_result"></span>
        </td>          
    </tr>
  </table>
</fieldset><p />
<!-- Fieldset product -->    
<fieldset><legend>Select Product</legend>
<table border="0" cellspacing="2" cellpadding="2" id="tableHeader">
<tr>
	<td colspan="2">&nbsp;</td>
	<td>QUANTITY</td>
	<td colspan="2">UNIT SELLING PRICE</td>
</tr>
<tr><!-- style="font-family: Arial, Helvetica, sans-serif;font-size:11px;" -->
	<td colspan="2">PRODUCT NAME :     <select width="150px" id="search_product">
				<?php
					$product = "SELECT ID, ProductName, Quantity FROM products WHERE Quantity > 0 AND ID <> '1922' ORDER BY ProductName ASC";
					$result = $db->executeQuery($product, $connectionParameters);
					
					if(count($result) > 0){
					for($i=0;$i<count($result);$i++){
				?>
					<option value="<?php echo $result[$i]['ID']?>" id="<?php echo $result[$i]['ID']?>"><?php echo strtoupper($result[$i]['ProductName'])." [".$result[$i]['Quantity']."]"?></option>
				<?php } }?>
			    </select>
	</td>
	<td><input type="text" name="product_qty" id="product_qty" class="validate[optional,custom[integer]]" /></td>
        <td><span style="width:150px;display: inline-block;" id="product_unit_sp"></span></td>
	<td><span id="span_add_button"><input title="Add product in basket" type="image" src="images/sub_blue_add.png" id="imgAddProductInBasket" /></span></td>
</tr>
</table>
<p />
<div id="added_product">    
</div>
</fieldset>
<p />
<fieldset><legend>Invoice</legend>
    <table border="0" id="tableHeader" width="100%">
        <tr>
            <td align="right">
                TRANSPORT REQUIRED : <input type="checkbox" name="chkTransportRequired" id="chkTransportRequired" />
            </td>    
            <td>
                <span id="span_transport" style="display:none">
                <select id="cboTransport" name="cboTransport" id="tableHeader">
                    <option value="-1">Please select region</option>
                            <?php
                                $queryTransport = "SELECT * FROM transport ORDER BY region ASC";
                                $resultTransport = $db->executeQuery($queryTransport, $connectionParameters);

                                if(count($resultTransport) > 0){
                                for($i=0;$i<count($resultTransport);$i++){
                        ?>
                                <option value="<?php echo $resultTransport[$i]['fees']?>" id="<?php echo $resultTransport[$i]['region_id']?>"><?php echo strtoupper($resultTransport[$i]['region']).' ['.$resultTransport[$i]['fees'].']';?></option>
                        <?php } }?>
                        </select>        </span>                
            </td>
        </tr>        
        <tr>
            <td valign="top">
    <fieldset><legend>Totals</legend>
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>SUBTOTAL</td>
            <td> : <input type="text" name="txtSubTotal" id="txtSubTotal" disabled /></td>
        </tr>
        <tr>
            <td>DISCOUNT</td>
            <td> : <input type="text" name="txtDiscount" id="txtDiscount" class="validate[optional,custom[number]]" /> (in Rs)</td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td> : <input type="text" name="txtGrandTotal" id="txtGrandTotal" disabled /></td>
        </tr>        
    </table>    
    </fieldset>
    </td>
    <td valign="top" width="60%">
    <fieldset style="width: 90%;"><legend>Details</legend>
    <table border="0" cellspacing="0" cellpadding="0" id="tableHeader">
        <tr>
            <td>DATE</td>
            <td> : <input type="text" id="txtDate" name="txtDate" value="<?php echo date("d-m-Y");?>" onfocus="this.select();lcs(this)" onclick="event.cancelBubble=true;this.select();lcs(this)" /></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>PAYMENT TYPE</td>
            <td align="left"> : <select id="cboPaymentType" name="cboPaymentType">
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>
                    <option value="Cheque">Cheque</option>
                </select>
            </td>            
        </tr>
        <tr>
            <td>BRANCH</td>
            <td> : <select id="cboBranch" name="cboBranch">
                    <?php
                        $queryBranch = "SELECT ID, BranchName FROM branch ORDER BY BranchName ASC";
                        $resultBranch = $db->executeQuery($queryBranch, $connectionParameters);
                        
                        if(count($resultBranch) > 0){
                        for($i=0;$i<count($resultBranch);$i++){
                ?>
                        <option value="<?php echo $resultBranch[$i]['ID']?>" <?php if($resultBranch[$i]['ID'] == 1){echo "selected";}?> id="<?php echo $resultBranch[$i]['ID']?>"><?php echo strtoupper($resultBranch[$i]['BranchName'])?></option>
                <?php } }?>
                </select>
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan="2" align="left"><span id="span_chequeNumber" style="display:none">
                CHEQUE NO. : <input type="text" name="txtChequeNo" id="txtChequeNo" class="validate[required,custom[integer]]" />
             </span>
<span id="span_credit" style="display:none">
                PAYMENT AMOUNT : <input type="text" name="txtPaymentAmount" id="txtPaymentAmount" class="validate[required,custom[integer]]" />
             </span>
</td>
        </tr>
        <tr>
            <td>SALES PERSON</td>
            <td> : <input type="text" name="txtSalesPerson" id="txtSalesPerson" class="validate[required,custom[onlyLetterSp]]" /></td>
            <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>           
    </table>  
    </fieldset> 
    </td>        
        </tr>
        </table>
</fieldset>
<p />
</div>
<div><input type="hidden" name="invoiceID" id="invoiceID" />
    <input type="button" name="btnSave" id="btnSave" value="Save" />&nbsp;&nbsp;&nbsp;
    <span id="msg" class="warningmsg"></span><span id="success_msg" class="infomsg"></span>
</div>
</form>