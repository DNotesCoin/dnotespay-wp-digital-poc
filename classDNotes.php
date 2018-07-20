<?php

/* 
 * Plugin Name: DNotes Pay
 * Plugin URI: https://dnotescoin.com
 * Description: DNotes Pay for Digital Products
 * Author: DNotes Global
 * Author URI: https://dnotesglobal.com/
 * Version: 1.0
 */


// Abort if this file is accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 *  Loading the Base Class
 */

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
$short_codeid_value = 1;

class QuriGold{
    
    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( $this, 'add_extrafiles' ) );
        add_shortcode( 'dnotespay',array( $this, 'table_data1' ) );
        /**
        * LOAD THE CHILD CLASS
        **/
        include( plugin_dir_path(__FILE__) . 'dnotes_list_table.php' );
        include( plugin_dir_path(__FILE__) . 'includes/class_allshortcodes.php' );
        include( plugin_dir_path(__FILE__) . 'includes/class_addnew.php' );
        include( plugin_dir_path(__FILE__) . 'includes/class_dnotesSettings.php' );
		
        
    }
    
    public function add_extrafiles(){
        wp_enqueue_style( 'customcss', plugins_url( 'assets/css/custom.css', __FILE__ ), array());
        wp_enqueue_script( 'jqueryjs', plugins_url( 'assets/js/jquery.min.js', __FILE__ ), array());
        wp_enqueue_script( 'customjs', plugins_url( 'assets/js/custom.js', __FILE__ ), array());
        wp_localize_script( 'customjs', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
     }
	
	public function table_data1( $atts ){
        global $wpdb;

        $arguments = shortcode_atts( array( 'id' => null ), $atts );
        $tablename = $wpdb->prefix . 'dnotes_token';
        
        $query_table = $wpdb->get_row(" SELECT * FROM $tablename where id='".$arguments['id']."' ");
        $b_text = $query_table->b_text;
        $b_color = $query_table->b_color; 
        
        $address_table = $wpdb->prefix . 'dnotes_address';
        $address_query = $wpdb->get_row(" SELECT * FROM $address_table ORDER BY RAND() LIMIT 1 ");
        $dnotes_address = $address_query->address;

        if( $query_table->currency =="usd" )
          $usd_notes = 0;
        else
          $usd_notes = 1;
        $amount_price = $query_table->price;
        $tolerance = $query_table->tolerance; 
        $download_link = $query_table->product;
        $confirmations_num = $query_table->confirmation;
        $payment_description =  $query_table->description;
        $post_file_url = plugins_url( 'dnotes_payment.php', __FILE__ );

        echo '<form id="DnotesForm" method="post" action="'.$post_file_url.'" target="DnotesWindow"><input type="hidden" id="payment_description" name="payment_description" value="'.$payment_description.'" /><input type="hidden" id="dnotes_address" name="dnotes_address" value="'.$dnotes_address.'" /><input type="hidden" id="usd_notes" name="usd_notes" value="'.$usd_notes.'" /><input type="hidden" id="amount_price" name="amount_price" value="'.$amount_price.'" /><input type="hidden" id="tolerance" name="tolerance" value="'.$tolerance.'" /><input type="hidden" id="download_link" name="download_link" value="'.$download_link.'" /><input type="hidden" id="confirmations_num" name="confirmations_num" value="'.$confirmations_num.'" /><input type="button" id="dnotes_buttonvalue" class="buy-button" style="background: '.$b_color.';" value="'.$b_text.'" onclick="PaymentpageShow()" data-href="'.$arguments['id'].'"></form>';
        $GLOBALS['short_codeid_value'] = $arguments['id'];
		?>
        <style>
            #dnotes_buttonvalue {
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                border-radius:5px;
                border:1px solid #337bc4;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:17px;
                font-weight:bold;
                padding:12px 44px;
                text-decoration:none;
            }
        </style>
        <script>
            function PaymentpageShow() {
                // document.getElementById("dnotes_buttonvalue").style.display = "none";
                // document.getElementById("dnotes-page").style.display = "block";
                // var mapForm = document.createElement("form");
                // mapForm.target = "Dnotespay";
                // mapForm.method = "POST"; // or "post" if appropriate
                // mapForm.action = "dnotes_payment.php";

                // var mapInput = document.createElement("input");
                // mapInput.type = "text";
                // mapInput.name = "addrs";
                // mapInput.value = data;
                // mapForm.appendChild(mapInput);

                // document.body.appendChild(mapForm);

                // map = window.open("", "Dnotespay", "status=0,title=0,height=600,width=650,scrollbars=1");

                // if (map) {
                //     mapForm.submit();
                // } else {
                //     alert('You must allow popups for this map to work.');
                // }
                window.open('', 'DnotesWindow', 'toolbar=yes,scrollbars=yes,resizable=yes,top=350,left=500,width=650,height=600');
                document.getElementById('DnotesForm').submit();
                //window.open("dnotes_payment.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=350,left=500,width=650,height=600");
            }
        </script>
		<?php
    }  
    
}

new QuriGold();

?>