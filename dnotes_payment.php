<?php
        
        $usd_notes = $_POST['usd_notes'];
        $amount_price = $_POST['amount_price'];
        $tolerance = $_POST['tolerance'];
        $download_link = $_POST['download_link'];
        $confirmations_num = $_POST['confirmations_num'];
        $dnotes_address = $_POST['dnotes_address'];
        $payment_description = $_POST['payment_description'];
?>
        <style>
            .dnotes_data {
            background: #ffffff none repeat scroll 0 0;
            display: table;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            }

            .img_section {
            float: left;
            margin: 0;
            padding: 0;
            width: 100%;
            }

            .img_section img {
                display: block;
                float: none;
                margin: 0 auto;
                width: auto;
            }
            .img_section .sec_img {
                float: left;
                width: auto;
            }
            .img_section .sec_img img {
                float: left;
                margin: 0 20px 0 0;
                width: auto;
            }
            .img_section .sec_img p {
            color: #000000;
            float: left;
            font-size: 22px;
            font-weight: bold;
            margin: 18px 0 0;
            width: auto;
            }
            .img_section .sec_img span {
            color: #000000;
            float: left;
            font-size: 18px;
            font-style: italic;
            font-weight: normal;
            margin: 0;
            width: 60%;
            }
            .lable_sec {
            color: #000000;
            float: left;
            margin-top: 30px;
            width: auto;
            }
            .lable_sec p {
            clear: both;
            float: left;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 14px;
            padding: 0;
            width: auto;
            }
            .res_sec {
            color: #000000;
            float: left;
            margin-left: 5px;
            margin-top: 33px;
            position: relative;
            width: auto;
            }
            .res_sec p {
            clear: both;
            float: left;
            font-size: 16px;
            margin: 0 0 14px;
            width: auto;
            }
            .res_sec p span {
                margin: 0 20px;
            }
            .aling_left {
                left: -167px;
                position: absolute;
                top: 37px;
                width: 700px !important;
            }
            .res_sec a {
            color: #4ba2e0;
            float: right;
            font-weight: 600;
            margin: 0 20px;
            }

            .res_sec a:hover {
                color: #3B4751
            }
            .sec_img1 {
            clear: left;
            float: left;
            margin-top: 40px;
            width: 50%;
            }
            .sec_img1 img {
            float: left;
            margin: 0;
            padding: 0;
            width: 50px;
            }
            .sec_img1 p {
            color: #000000;
            float: left;
            font-size: 18px;
            margin: 13px 0 0 14px;
            width: auto;
            }
            .one_donate {
            float: right;
            margin: 50px 0 0;
            padding: 0;
            width: auto;
            }
            .one_donate p {
            color: #000000;
            float: left;
            font-size: 17px;
            margin: 5px 0 0;
            padding: 0;
            width: auto;
            }

            /*
			p{ line-height: 1em; }
            h1, h2, h3, h4{
                color: orange;
                font-weight: normal;
                line-height: 1.1em;
                margin: 0 0 .5em 0;
            }
            h1{ font-size: 1.7em; }
            h2{ font-size: 1.5em; }
            a{
                color: black;
                text-decoration: none;
            }
                a:hover,
                a:active{ text-decoration: underline; }



            body{
                font-family: arial; font-size: 80%; line-height: 1.2em; width: 100%; margin: 0; background: #eee;
            }
			*/
            /* #dnotes-page{ 
                display: none;
                position: fixed;
                z-index: 10000;
                padding-top: 100px;
                left: 0;
                top: 0px;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            } */


            /*
			#logo{
                width: 35%;
                margin-top: 5px;
                font-family: georgia;
                display: inline-block;
            }
			*/
            #nav{
                width: 60%;
                display: inline-block;
                text-align: right;
                float: right;
            }
                #nav ul{}
                    #nav ul li{
                        display: inline-block;
                        height: 62px;
                    }
                        #nav ul li a{
                            padding: 20px;
                            background: orange;
                            color: white;
                        }
                        #nav ul li a:hover{
                            background-color: #ffb424;
                            box-shadow: 0px 1px 1px #666;
                        }
                        #nav ul li a:active{ background-color: #ff8f00; }

            #dnotes-content{
                background: white;
                padding: 40px 25px;
                clear: both;
                margin-top: 5px;
                border-radius: 6px;
                border: 1px solid grey;
            }
            #footer{
                border-bottom: 1px #ccc solid;
                margin-bottom: 10px;
            }
                #footer p{
                    text-align: right;
                    text-transform: uppercase;
                    font-size: 80%;
                    color: grey;
                }


            .custom-select {
            position: relative;
            font-family: Arial;
            }
            .custom-select select {
            display: none; 
            }
            .select-selected {
            background-color: #4caf50;
            }

            .select-selected:after {
            position: absolute;
            content: "";
            top: 14px;
            right: 10px;
            width: 0;
            height: 0;
            border: 6px solid transparent;
            border-color: #fff transparent transparent transparent;
            }

            .select-selected.select-arrow-active:after {
            border-color: transparent transparent #fff transparent;
            top: 7px;
            }

            .select-items div,.select-selected {
            color: #ffffff;
            padding: 11px 16px;
            border: 1px solid transparent;
            border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
            cursor: pointer;
            }
            /*style items (options):*/
            .select-items {
            position: absolute;
            background-color: #4caf50;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 99;
            }

            .select-hide {
            display: none;
            }
            .select-items div:hover, .same-as-selected {
            background-color: rgba(0, 0, 0, 0.1);
            }

            input[type=number] {
                width: 25%;
                padding: 12px 20px;
                margin: 15px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                display: inline-block;
                box-sizing: border-box;
                margin-left: 3%;
            }

            .header-text {
            font-size: 3.5em;
            margin-top: 6%;
            text-align: center;
            }
            .download-btnprop {
                width: 208px !important;
                height: 55px !important;
                white-space: inherit !important;
                margin-left: 35% !important;
            }

            #loading {
                width: 50px; 
                height: 50px; 
                background: url('assets/left.png') no-repeat center center;
                border-radius: 50%;
                display: inline-block;
            }

            #loading_gif {
                width: 45px; 
                height: 45px; 
                background: url('assets/loading.gif') no-repeat center center;
                border-radius: 50%;
                display: inline-block;
                vertical-align: bottom;
            }

            .state_checktext {
                width: 40%;
                display: inline-block;
                vertical-align: top;
                font-size: 18px;
                padding-left: 10px;
                margin-top: 12px;
                margin-bottom: 0px !important;
            }

            .btnsubmit-property {
                background: #fff !important;
                border: none !important;
                font-style: oblique;
                font-size: 14px !important;
                cursor: pointer;
                padding: 0px !important;
                text-decoration: underline;
                color: #29aae2 !important;
                font-family: none !important;
            }
            .btnsubmit-property :hover {
                opacity: 0.85;
            } 

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
            .popup-dialogvalue {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                width: 650px;
            }
            .close-option {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close-option:hover,
            .close-option:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            </style>
    <div id="dnotes-page">
            <h1 class="header-text"><img src="assets/header.png" alt="header"></h1>
            <div style="margin-top:4%;">
            <div id="loading"></div>
            <div style="display: inline-block;vertical-align: top;margin-top: 0px;">
                <p style="margin: 5px;font-size: 20px;font-weight: bold;">Pay with DNotes</p>
                <p style="margin: 5px;font-style: italic;font-size: 15px;"><?php echo $payment_description ;  ?></p>
            </div>
            </div>
            <div id="dnotes-content">
                <div id="content-blogval">
                    <?php
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL, 'https://api.coinmarketcap.com/v2/ticker/184/');
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
                    $result_json = json_decode($result);
                    $result_data = $result_json->data;
                    $result_quotes = $result_data->quotes;
                    $result_usd = $result_quotes->USD;
                    $usd_price = $result_usd->price;
                    $show_usdprice = round($usd_price , 3);

                    if($usd_notes =="0")
                    {
                        $send_mount = round(( $amount_price / $usd_price ) , 5);
                    }else{
                        $send_mount = $amount_price;
                    }

                    $unix_time = time();
                    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $invoice_number = $unix_time.$randomString;

                    $dnotes_address = substr( $dnotes_address , 0 , 34 );
                    $send_address = $dnotes_address."+".$invoice_number;

                ?>
                <input type="hidden" id="send_value_address" value="<?php echo $send_address;  ?>" />
                <input type="hidden" id="send_mount" name="send_mount" value="<?php echo $send_mount;  ?>" />
                <input type="hidden" id="product_download_url" value="<?php echo $download_link;  ?>" />
                <input type="hidden" id="confirmations_num" value="<?php echo $confirmations_num;  ?>" />
                <input type="hidden" id="tolerance" value="<?php echo $tolerance;  ?>" />
                <div style="font-size: 16px;margin-bottom: 15px;">
                <?php if ($usd_notes==0) { ?><font style="font-weight: bold;">Amount:</font> $<?php echo $amount_price;  ?>
                <?php } else { ?><font style="font-weight: bold;">Amount:</font> <?php echo $amount_price;  ?> 
                <?php } ?></div>
                <div style="font-size: 16px;margin-bottom: 15px;">
                    <font style="font-weight: bold;">Please send exactly: </font> 
                    <input style="width: 105px;font-size: 14px;border: 1px solid #fff;" type="text" id="copyAmount" value="<?php echo $send_mount; ?>" readonly>
                    <input type="button" value="Click to Copy" id="copy_amounty" class="btnsubmit-property" style="margin-left: 29%;">
                </div>
                <div style="font-size: 16px;margin-bottom: 15px;">
                    <font style="font-weight: bold;">To : </font>
                    <input style="width: 91%;font-size: 14px;border: 1px solid #fff;" type="text" id="copyTarget" value="<?php echo $send_address; ?>" readonly>
                    <input type="button" value="Click to Copy" id="copy_address" class="btnsubmit-property" style="margin-left: 72%;">
                </div>
                <div id="payment_state_btn"></div>
                <div style="margin-top:100px;">
                    <div id="loading_gif"></div>
                    <p class="state_checktext" id="state_checktext">Checking for Payment.</p>
                    <p style="width: 45%;display: inline-block;text-align: right;margin-bottom: 5px;">1 DNote = <?php echo $show_usdprice; ?> USD</p>
                </div>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
                var check_flag = 0;
                document.getElementById("copy_address").addEventListener("click", function() {
                    copyToClipboard(document.getElementById("copyTarget"));
                });

                function copyToClipboard(elem) {
                    var targetId = "_hiddenCopyText_";
                    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                    var origSelectionStart, origSelectionEnd;
                    if (isInput) {
                        target = elem;
                        origSelectionStart = elem.selectionStart;
                        origSelectionEnd = elem.selectionEnd;
                    } else {
                        target = document.getElementById(targetId);
                        if (!target) {
                            var target = document.createElement("textarea");
                            target.style.position = "absolute";
                            target.style.left = "-9999px";
                            target.style.top = "0";
                            target.id = targetId;
                            document.body.appendChild(target);
                        }
                        target.textContent = elem.textContent;
                    }
                    var currentFocus = document.activeElement;
                    target.focus();
                    target.setSelectionRange(0, target.value.length);
                    
                    var succeed;
                    try {
                        succeed = document.execCommand("copy");
                    } catch(e) {
                        succeed = false;
                    }
                    
                    if (currentFocus && typeof currentFocus.focus === "function") {
                        currentFocus.focus();
                    }
                    
                    if (isInput) {
                        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                    } else {
                        target.textContent = "";
                    }
                    return succeed;
                }

                document.getElementById("copy_amounty").addEventListener("click", function() {
                    copyToClipboardAmount(document.getElementById("copyAmount"));
                });

                function copyToClipboardAmount(elem) {
                    var targetId = "_hiddenCopyText_";
                    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                    var origSelectionStart, origSelectionEnd;
                    if (isInput) {
                        target = elem;
                        origSelectionStart = elem.selectionStart;
                        origSelectionEnd = elem.selectionEnd;
                    } else {
                        target = document.getElementById(targetId);
                        if (!target) {
                            var target = document.createElement("textarea");
                            target.style.position = "absolute";
                            target.style.left = "-9999px";
                            target.style.top = "0";
                            target.id = targetId;
                            document.body.appendChild(target);
                        }
                        target.textContent = elem.textContent;
                    }
                    var currentFocus = document.activeElement;
                    target.focus();
                    target.setSelectionRange(0, target.value.length);
                    
                    var succeed;
                    try {
                        succeed = document.execCommand("copy");
                    } catch(e) {
                        succeed = false;
                    }
                    
                    if (currentFocus && typeof currentFocus.focus === "function") {
                        currentFocus.focus();
                    }
                    
                    if (isInput) {
                        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                    } else {
                        target.textContent = "";
                    }
                    return succeed;
                }

                function showProductUrl()
                {
                var btnNode = document.getElementById("payment_state_btn");
                btnNode.innerHTML = '';
                btnNode.innerHTML = '<input type="submit" style="background: #29aae2 !important;padding: 15px 2rem;height: 70px !important;" value="Payment Complete! Click HERE to continue " id="download_product" class="download-btnprop">';
                document.getElementById("download_product").addEventListener("click", function() {
                    var download_url = document.getElementById("product_download_url").value;
                    window.open( download_url , '_blank' );
                });
                check_flag = 1;
                }

                var countDownDate = new Date().getTime();
                var confirmations_num = document.getElementById("confirmations_num").value;
                var tolerance = document.getElementById("tolerance").value;
                if(tolerance)
                tolerance = tolerance;
                else
                tolerance = 0.1;
                var x = setInterval(function() {
                    
                    if(check_flag == "0")
                    {
                    var send_value_address = document.getElementById("send_value_address").value;
                    var send_mount = document.getElementById("send_mount").value;

                    var post_response = jQuery.ajax({type: "GET", url: "https://abe.dnotescoin.com/chain/DNotes/q/invoice/<?php echo $dnotes_address; ?>+<?php echo $invoice_number; ?>", async: false}).responseText;
                    var res_data = post_response.split(",");
                    console.log(res_data[0]);
                    console.log(res_data[1]);

                    var limit_price = send_mount - tolerance;
                    if( (res_data[0] > limit_price) && (res_data[1] >= confirmations_num) )
                    {
                        showProductUrl();
                        document.getElementById("loading_gif").style.background = "none";
                        var state_checktext = document.getElementById("state_checktext");
                        state_checktext.innerHTML = '';
                        state_checktext.innerHTML = 'Payment Successful';
                    }
                    }

                }, 10000);
            </script>
    </div>
