function GetUnitSellingPrice(element, val)
{
	var params = "prodID=" + val;
	//getSSContent(element, "GetUnitSellingPrice", params);
	
	getSSContentjQuery(element, "GetUnitSellingPrice", params);
	//$(element).value = Number(val).toFixed(2); ;       
    //GetProductInBasket('added_product', 0);
    
    //GetCustomerDetails('customer_result', $("search_customer").options[$("search_customer").selectedIndex].value);
}

function GetProductInBasket(element, operation)
{
   var params = "";
   if(operation === 1)
   {
       if($('#product_id').val() > 0 && $('#product_qty').val() > 0)
       {
         params = "prodID=" + $('#product_id').val() + "&prodQty=" + $('#product_qty').val();
       }
   }
	getSSContentjQuery(element, "GetProductInBasket", params);   	
	GetSubTotalProductInBasket(); 
        $('#product_qty').val('');
}

function DeleteProductInBasket(element, basketID)
{
	var params = "basketID=" + basketID;
	getSSContentjQuery(element, "DeleteProductInBasket", params);
}

function GetSubTotalProductInBasket()
{
	var params = "";
	getSSContentjQuery("txtSubTotal", "GetSubTotalProductInBasket", params);
}

function SaveBasketProduct()
{
    // Simple validation
    if($("#txtSalesPerson").val().length === 0)
    {
        $("#msg").val("Please enter sales person name");
        $("#txtSalesPerson").focus();
        exit;
    }
    
    if(!$("#txtAddress"))
    {
        $("#msg").val("Please select customer from list OR create new customer");
        exit;
    }
    
    // Transport checkbox
    if($("#chkTransportRequired").attr('checked',true))
    {
        //if($("#cboTransport").options[$("cboTransport").selectedIndex].value === -1)
        if($("#cboTransport").val() === -1)
        {
            $("#msg").val("Please select transport region");
            exit;   
        }
    }
    
	var params = "";
        
        // CUSTOMER SECTION
        var customerID = "";
        var customerName = "";
       // var title = $("txtTitle").options[$("txtTitle").selectedIndex].value;
       var title = $("#txtTitle").val();
        var address = $("#txtAddress").val();        
        var city = $("#txtCity").val();
        var phoneNo = $("#txtPhoneNo").val();        
        var mobileNo = $("#txtMobileNo").val();
        var faxNo = $("#txtFaxNo").val();
        var email = $("#txtEmail").val();
        var contactName = $("#txtContactName").val();
        var vatNo = $("#txtVatNo").val();
        
        // INVOICE SECTION
        var chequeNo = "";
        var paymentAmt = "";	
        var transport = "";
        var invoiceDate = $("#txtDate").val();
        //var branchID = $("cboBranch").options[$("cboBranch").selectedIndex].value;
        var branchID = $("#cboBranch").val();
        var salesPerson = $("#txtSalesPerson").val();
        //var paymentType = $("cboPaymentType").options[$("cboPaymentType").selectedIndex].value;
        var paymentType = $("#cboPaymentType").val();
        var subtotal = $("#txtSubTotal").val();
        var discount = $("#txtDiscount").val();
        var total = $("#txtGrandTotal").val();
        
        if($("#chkTransportRequired").attr('checked',true))      
        {
            //transport = "&transport=" +$("cboTransport").options[$("cboTransport").selectedIndex].value;
            transport = "&transport=" +$("#cboTransport").val();
        }
        
        if (paymentType === "Cheque") 
        {
		   if($("#txtChequeNo").val().length < 1)
		   {
	            $("#msg").html("Please enter cheque number");
	            $("#txtChequeNo").focus();
	            exit; 
		   }
           chequeNo = "&chequeNo=" + $("#txtChequeNo").val();
    	}

        if (paymentType === "Credit")
	{
	   if($("#txtPaymentAmount").val().length < 1)
	   {
            $("#msg").html("Please enter payment amount");
	    $("#txtPaymentAmount").focus();
            exit; 
	   }
           paymentAmt = "&paymentAmt=" + $("#txtPaymentAmount").val();
    	}
        
        if($('#txtCustomerID'))
        {
            customerID = "&CustomerID=" + $('#txtCustomerID').val();
        } 
        
        if($('#txtName'))
        {
            customerName = "&Name=" + $('#txtName').val();
        }         
        
        params = "title=" + title + "&address=" + address + "&city=" + city + "&phoneNo=" + phoneNo + "&mobileNo=" + mobileNo 
                + "&faxNo=" + faxNo + "&email=" + email + "&contactName=" + contactName + "&vatNo=" + vatNo
                + "&invoiceDate=" + invoiceDate + "&branchID=" + branchID + "&salesPerson=" + salesPerson + "&paymentType=" + paymentType
                + "&subtotal=" + subtotal + "&discount=" + discount + "&total=" + total
                + customerID + customerName + chequeNo + paymentAmt + transport;
	getSSContentjQuery("success_msg", "SaveBasketProduct", params);
}

/* VALIDATION */
/*
function ValidateNumeric(element)
{
    var stringName = $(element).val();
    for(var i=0;i<stringName.length;i++)
    {
        asciiNum = stringName.charCodeAt(i);
        if (!((asciiNum==46) || (asciiNum>47 && asciiNum<58))){
            alert('Value is not numeric!');
            $(element).val('');	        
        }
    }         
}

function ValidateAlphabets(element)
{
    var stringName = $(element).val();
    for(var i=0;i<stringName.length;i++)
    {
        asciiNum = stringName.charCodeAt(i);
        if (!((asciiNum==32) ||(asciiNum>64 && asciiNum<91) || (asciiNum>96 && asciiNum<123))){
            alert('Value entered is not alphabet!');
            $(element).val('');	        
        }
    }    
}

function ValidateEmail(element)
{
    
    var email = $(element);
    
    if(email.val().length > 0){
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.val())) {
    alert('Please provide a valid email address');
    email.val('');
    email.focus();
    return false;       
    }
    }
}

function CheckRequiredField(element)
{
    if($(element).val().length === 0)
    {
        alert('Value required for this field!');
        $(element).focus();
    }
    
    if(element === "#txtSalesPerson" && $(element).val().length > 0)
    {
        $("msg").html('');
    }
}
*/
/* END VALIDATION */

function GetCustomerDetails(element, customerID)
{
    $("#msg").html('');
    
    if(customerID === -1)
    {
        $('#'+element).html('');
    }
    else
    { 
	var params = "customerID=" + customerID;
	getSSContentjQuery(element, "GetCustomerDetails", params);
        $('#product_unit_sp').html('');
    }           
}

function CreateNewCustomer(element)
{
    var params = "";
    getSSContentjQuery(element, "CreateNewCustomer", params);
    //GetProductInBasket('added_product', 0);
    $('#product_unit_sp').html('');
}

function ShowListTransport(element, combo_transport)
{	
    $("#msg").html('');
    
    if($(element).attr('checked'))
    {
    	$(combo_transport).css('display', 'block');
    }
    else {
    	$(combo_transport).css('display', 'none');
    }
    

}

function ShowHideSpan(selectedVal)
{
    if(selectedVal === "Cheque")
    {
    	$('#span_credit').css('display', 'none');
    	$('#span_chequeNumber').css('display', 'block');
    }
    else if(selectedVal === "Credit")
    {
	$('#span_chequeNumber').css('display', 'none'); 
        $('#span_credit').css('display', 'block');
    }
    else
    {
        $('#span_chequeNumber').css('display', 'none');
	$('#span_credit').css('display', 'none');
    }
}
/*
function UploadProductImage(prodid, element)
{
	var params = "prodid=" + prodid;
	getSSContentjQuery(element, "UploadProductImage", params);
}
*/
function GetDiscountedTotal()
{
	var subtotal = parseFloat($('#txtSubTotal').val());
	var discount = parseFloat($('#txtDiscount').val());
        var grandTotal = "";
        
        if($('#txtDiscount').val().length > 0)
        {
            grandTotal = subtotal - discount;
        } 
        else
        {
            grandTotal = subtotal;
        }


	if(grandTotal < 0)
	{
		alert('Discount cannot be greater than subtotal value');
		$('#txtDiscount').val('');
		$('#txtGrandTotal').val(subtotal.toFixed(2));	
	}
	else{
		$('#txtGrandTotal').val(grandTotal.toFixed(2));
	}
}

function AddTransportToTotal()
{
    if($("#cboTransport").val() === -1)
    {
        alert('Please select a region if transport is required');
    }
    else
    {
    	GetSubTotalProductInBasket();    	
    }
}

$(document).ready(function(){
	 $("#search_product").select2();
         
         $("#formInvoice").validationEngine();
	 
	 // Change event
	 $("#search_customer").change(function(){
		  GetCustomerDetails('customer_result',$("#search_customer").val());
	  });
	 $("#search_product").change(function(){
		 GetUnitSellingPrice('product_unit_sp',$("#search_product").val());
	  });	
	 $("#cboPaymentType").change(function(){
		 ShowHideSpan($("#cboPaymentType").val());
	  });	 
	 $("#chkTransportRequired").change(function(){
		 ShowListTransport('#chkTransportRequired', '#span_transport');
	  });	 
	 $("#cboTransport").change(function(){
		 AddTransportToTotal();
	  });          
	 
	 // Click event
	 $("#butCreateCustomer").click(function(){
		 CreateNewCustomer('customer_result');
	  });
	 $("#imgAddProductInBasket").click(function(){
		 GetProductInBasket('added_product', 1);
	  });
	 $("#btnSave").click(function(){
		 SaveBasketProduct();
	  });	 
      
	 
	 $("#txtDiscount").keyup(function(){
		 GetDiscountedTotal();
	  });	 	                

	});
/* ################## */
/*    ajax - jquery   */
/* ################## */
/*
function getSSContentjQuery(element, action, params)
{   
  $("#"+element).ajaxStart(function(){
    $(this).html("<img src='../images/loading.gif' />");
  });
  $("#"+element).ajaxError(function(){
    $(this).html("An error occured!");
  });

  
$.ajax({
  type : 'GET',
  url: 'includes/action.php',
data: "mod=" + action + "&" + params,
success: function(data) {
    $("#"+element).html(data);
},
async:   false
});

}
*/
function getSSContentjQuery(element, action, params)
{    
$.ajax({
  type : 'GET',
  url: 'includes/action.php',
data: "mod=" + action + "&" + params,
beforeSend:function(){
	$(this).html("<img src='../images/loading.gif' />");
},
success: function(data) {
    $("#"+element).html(data);
},
error:function(){
	$(this).html("An error occured!");
}
});
}


