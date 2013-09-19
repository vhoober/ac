<?php
ob_start();  // open output buffer to counter header error
session_start();

//require_once '../class/password.class.php';

if(isset($_GET['mod']))
{
    switch($_GET['mod'])
    {
        case "logout":
        {
            session_unset();
            session_destroy();
            $_SESSION['valid'] = "";
            header("location:index.php");
            break;
        }// end case logout

/* CHANGE PASSWORD SECTION */
        case "changepwdform":
        {
            $pwdform = new Password();
            $pwdform->EditPasswordForm();
            echo $pwdform->get();
            break;
        } // end case changepwdform

        case "savenewpassword":
        {
            $pwdform = new Password();
            $pwdform->SaveNewPassword($_SESSION['currentuserinfo'][0], $_POST['frmusername'], $_POST['frmnewpassword'], $_POST['frmconfpassword'], $connectionParameters);
            echo $pwdform->get();
            break;
        }// end case savenewpassword
        /* User */
         case "adduser":
        {
            require_once 'add_user.php';
            break;
        }
         case "saveuser":
        {
            require_once 'save_user.php';
            break;
        }
        case "listuser":
        {
            require_once 'list_user.php';
            break;
        }
        case "edituser":
        {
            require_once 'edit_user.php';
            break;
        }
        case "updateuser":
        {
            require_once 'update_user.php';
            break;
        }
        case "deleteuser":
        {
            require_once 'delete_user.php';
            break;
        }
/* END CHANGE PASSWORD SECTION */
        
      /* INVOICE MANG */ 
         case "invoice":
        {
            require_once 'invoice.php';
            break;
        }
        case "returninwards":
        {
            require_once 'return_inwards.php';
            break;
        }
        case "editreturninwards":
        {
            require_once 'edit_return_inwards.php';
            break;
        }
        case "CreateNewCustomer":
        {
            require_once 'add_customer.php';
            break;
        } 
        case "GetUnitSellingPrice":
        {
            require_once 'get_unit_selling_price.php';
            break;
        } 
        case "GetProductInBasket":
        {
            require_once 'get_basket_product.php';
            break;
        }  
        case "DeleteProductInBasket":
        {
            require_once 'delete_basket_product.php';
            break;
        }   	
        case "GetSubTotalProductInBasket":
        {
            require_once 'get_subtotal_basket_product.php';
            break;
        }  
        case "SaveBasketProduct":
        {
            require_once 'save_basket_product.php';
            break;
        }        
        case "GetCustomerDetails":
        {
            require_once 'get_customer_details.php';
            break;
        }
        case "listpaymentreceived":
        {
            require_once 'list_payment_received.php';
            break;
        }
        case "processpaymentreceived":
        {
            require_once 'process_payment_received.php';
            break;
        }
        case "confirmpaymentreceived":
        {
            require_once 'confirm_payment_received.php';
            break;
        }    


        /* END PRODUCT */
        
/* PRODUCT */
        case "listproduct":
        {
            require_once 'list_product.php';
            break;
        }

        case "addproduct":
        {
        	require_once 'add_product.php';
        	break;	
        } // end case add product	
        
        case "saveproduct":
        {
			require_once 'save_product.php';
        	break;
        }	
        
        case "editproduct":
        {
			require_once 'edit_product.php';
        	break;
        }
        
        case "updateproduct":
        {
        	require_once 'update_product.php';
        	break;
        }
        
        case "deleteproduct":
        {      	
     		require_once 'delete_product.php';	
        	break;
        }

        case "deleteproductimg":
        {
            require_once 'delete_product_img.php';
            break;
        }
        
        case "displaylowstockproducts":
        {
        	require_once 'display_low_stock_products.php';
        	break;
        }  
        case "changeproductstatus" :  
        {
        	require_once 'change_product_status.php';
        	break;
        }  
        /*
        case "UploadProductImage": 	
        {
        	require_once 'upload_product_image.php';
        	break;
        }  */      	
/* END PRODUCT */
//
        
        case "addsupplier":
        {
         require_once 'add_supplier.php';
         break; 
        } // end case add supplier
        case "savesupplier":
        {
            require_once 'save_supplier.php';
            break;
        }
        case "listsupplier":
        {
            require_once 'list_supplier.php';
            break;
        }
        case "editsupplier":
        {
            require_once 'edit_supplier.php';
            break;
        }
        case "updatesupplier":
        {
            require_once 'update_supplier.php';
            break;
        }
/* PAGES */
        case "listpage":
        {
            require_once 'editor/editor.php';
            break;
        }

        case "savepage":
        {
            require_once 'editor/check.php';
            break;
        }
        
        case "confirmpagedelete":
        {
        	require_once 'editor/pages/pagedelete.php';
        	break;
        }
        
        case "deletepage":
        {
        	require_once 'editor/pages/pagedeleteconfirm.php';
        	break;
        }

/* END PAGES */

/* UPLOAD PHOTO */
        case "uploadphoto":
        {
            require_once 'upload_photo.php';
            break;
        }

        case "saveuploadphoto":
        {
            require_once 'save_photo.php';
            break;
        }
/* END UPLOAD PHOTO */


/* GALLERY */
        case "browsegallery":
        {
            require_once 'browse_gallery.php';
            break;
        }

        case "editgallery":
        {
            require_once 'edit_gallery.php';
            break;
        }

        case "updategallery":
        {
            require_once 'update_gallery.php';
            break;
        }

        case "deletegallery":
        {
            require_once 'delete_gallery.php';
            break;
        }

        case "productassocgallery":
        {
            require_once 'product_assoc_gallery.php';
            break;
        }
/* END GALLERY */
/* ADMIN SECTION */
// COMPANY INFORMATION
        case "companyinfo":
        {
            require_once 'company_info.php';
            break;
        }

	case "savecompanyinfo":
	{
            require_once 'save_company_info.php';
            break;
	}
//CATEGORY
        case "category":
        {
            require_once 'category.php';
            break;
        }
//TRANSPORT REGION
        case "transport":
        {
            require_once 'transport.php';
            break;
        }
// REPORTS
        case "invoice_receipt":
        {
            require_once 'report/invoice_receipt.php';
            break;
        }        
        case "cash_sales":
        {
            require_once 'report/cash_sales_report.php';
            break;
        }
		case "VAT_cash_sales":
        {
            require_once 'report/vat_report_cash_sales.php';
            break;
        }

/* END ADMIN SECTION */
    } // end switch case
}// end if

ob_end_flush();  // turn off output buffer
?>
