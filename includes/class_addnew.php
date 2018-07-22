<?php
/*
 * Class ##Addnew_token
 * Obj-> $add_token
 */

class Addnew_token {

    public function __construct() {
        add_action('admin_menu', array($this, 'addnew_menu'));
    }

    public function addnew_menu() {
        add_submenu_page('dnotes-token-new', 'Add new', 'Add new', 'manage_options', 'add_newtoken', array($this, 'add_newdata'));
    }

    /*
     * @Function add_newdata()
     *  Works for backend of Add New Token page
     */

    public function add_newdata() {

        ob_start();
        $item_id = $_GET['id'];
        ?>
        <div class="mycontainer">
            <div class="data-container">
                <h2>Add Shortcode</h2>
                <?php
                if ($_GET['id']) {
                    global $wpdb;

                    $tablename = $wpdb->prefix . 'dnotes_token';
                    $query = $wpdb->get_results("SELECT * FROM $tablename WHERE id = $item_id");


                    foreach ($query as $myquery):


                        $data[] = array(
                            'id' => $myquery->id,
                            'title' => $myquery->title,
                            'date' => $myquery->published_date,
                            'shortcode' => '<code>[dnotespay id=' . '"' . $myquery->id . '"' . ']</code>',
                        );
                        ?>
                        <form method="POST" class="token-form">
                            <input type="text" name="title" placeholder="Enter Title" class="title" value="<?php echo $myquery->title; ?>" />
                            <div class="setting-section">
                                <h4>Settings</h4>
                                <p>
                                    <label>USD OR DNotes</label>
                                    <select onchange="currencyChange(this.value)" name="currency" class="qgcurrency" required>
                                        <option value="">Select...</option>
                                        <option value="usd">USD</option>
                                        <option value="dnotes token">DNotes</option>
                                    </select>
                                </p>
                                <p>
                                    <label>Price/Amount</label>
                                    <input type="text" name="price" class="price"  value="<?php echo $myquery->price; ?>" onchange="priceChange(this.value)" />
                                    <span class="span-desc">Purchase price in USD if you have selected USD, or amount in DNotes if you have selected DNotes</span>
                                </p>
                                <p>
                                    <label>Tolerance</label>
                                    <input type="text" name="tolerance" class="tolerance"  value="<?php echo $myquery->tolerance; ?>" onchange="toleranceChange(this.value)"/>
                                    <span class="span-desc">If the user doesn't pay for the correct amount of DNotes, this is the tolerance for how much they can be off by, example 0.1</span>
                                </p>
                                <p>
                                    <label>Link to Download or Product</label>
                                    <input type="text" name="product" class="product"  value="<?php echo $myquery->product; ?>" onchange="productChange(this.value)" >
                                    <span class="span-desc">This will be shown to the user once the user has paid, product download or URL to the product you would like to deliver. Example: 
                                        Link to an article, a download zip, or PDF file such as http://mydomain.com/pdf_file.pdf</span>
                                </p>
                                <p>
                                    <label>Confirmations</label>
                                    <input type="text" name="confirmation" class="confirmation"  value="<?php echo $myquery->confirmation; ?>" onchange="confirmationChange(this.value)" >
                                    <span class="span-desc">0=Fastest, payment has been sent but not confirmed to be valid, up to 1 minute. 6=Slow, up to 6 minutes, transaction fully validated on the network.</span>
                                </p>
                                <p>
                                    <label>Short Product Description</label>
                                    <input type="text" name="description" class="description"  value="<?php echo $myquery->description; ?>" onchange="descriptionChange(this.value)">
                                    <span class="span-desc">Enter a short description of the product you are selling</span>
                                </p>
                                <p>
                                    <label>Button Text</label>
                                    <input type="text" name="btn_text" class="btn_text"  value="<?php echo $myquery->b_text; ?>" onchange="btntextChange(this.value)">
                                    <span class="span-desc">Examples: Buy Now, Buy with DNotes, DNotes Pay</span>
                                </p>
                                <p>
                                    <label>Button Color</label>
                                    <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php echo $myquery->b_color; ?>" id="btn_color" name="btn_color" placeholder="#ffffff" onchange="buttoncolorSync(this.value , 1)">
                                    <input type="color" name="btn_hexcolor" id="btn_hexcolor" class="btn_color"  value="<?php echo $myquery->b_color; ?>" onchange="buttoncolorSync(this.value , 2)">
                                </p>
                                <p>
                                    <label>Button Border Color</label>
                                    <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php echo $myquery->b_border_color; ?>" id="btn_border_color" name="btn_border_color" placeholder="#ffffff" onchange="buttoncolorSync(this.value , 3)">
                                    <input type="color" name="btn_border_hexcolor" id="btn_border_hexcolor" class="btn_color"  value="<?php echo $myquery->b_border_color; ?>" onchange="buttoncolorSync(this.value , 4)">
                                </p>
                                <p>
                                    <label>Mouse Over State Color</label>
                                    <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php echo $myquery->b_horver_color; ?>" id="btn_horver_color" name="btn_horver_color" placeholder="#ffffff" onchange="buttoncolorSync(this.value , 5)">
                                    <input type="color" name="btn_horver_hexcolor" id="btn_horver_hexcolor" class="btn_color"  value="<?php echo $myquery->b_horver_color; ?>" onchange="buttoncolorSync(this.value , 6)">
                                </p>

                                <p><input type="submit" name="update" class="submits" value="Update"></p>

                            </div>
                        </form>
                    <?php endforeach; ?>
                <?php }else { ?>

                    <form method="POST" class="token-form">
                        <input type="text" name="title" placeholder="Enter Title" class="title" />
                        <div class="setting-section">
                            <h4>Settings</h4>
                            <p>
                                <label>USD OR DNotes</label>
                                <select name="currency" class="qgcurrency">
                                    <option value="">Select...</option>
                                    <option value="usd">USD</option>
                                    <option value="dnotes token">DNotes</option>
                                </select>
                            </p>
                            <p>
                                <label>Price/Amount</label>
                                <input type="text" name="price" class="price">
                                <span class="span-desc">Purchase price in USD if you have selected USD, or amount in DNotes if you have selected DNotes</span>
                            </p>
                            <p>
                                <label>Tolerance</label>
                                <input type="text" name="tolerance" class="tolerance">
                                <span class="span-desc">If the user doesn't pay for the correct amount of DNotes, this is the tolerance for how much they can be off by, example 0.1</span>
                            </p>
                            <p>
                                <label>Link to Download or Product</label>
                                <input type="text" name="product" class="product">
                                <span class="span-desc">This will be shown to the user once the user has paid, product download or URL to the product you would like to deliver. Example: 
                                        Link to an article, a download zip, or PDF file such as http://mydomain.com/pdf_file.pdf</span>
                            </p>
                            <p>
                                <label>Confirmations</label>
                                <input type="text" name="confirmation" class="confirmation">
                                <span class="span-desc">0=Fastest, payment has been sent but not confirmed to be valid,  up to 1 minute. 6=Slow, up to 6 minutes, transaction fully validated on the network.</span>
                            </p>
                            <p>
                                <label>Short Product Description</label>
                                <input type="text" name="description" class="description">
                                <span class="span-desc">Enter a short description of the product you are selling</span>
                            </p>
                            <p>
                                <label>Button Text</label>
                                <input type="text" name="btn_text" class="btn_text">
                                <span class="span-desc">Examples: Buy Now, Buy with DNotes, DNotes Pay</span>
                            </p>
                            <p>
                                <label>Button Color</label>
                                <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="btn_color" name="btn_color" placeholder="#ffffff" value="#bada55" onchange="buttoncolorSync(this.value , 1)">
                                <input type="color" name="btn_hexcolor" id="btn_hexcolor" class="btn_color" value="#bada55" onchange="buttoncolorSync(this.value , 2)">
                            </p>
                            <p>
                                <label>Button Border Color</label>
                                <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="btn_border_color" name="btn_border_color" placeholder="#ffffff" value="#bada55" onchange="buttoncolorSync(this.value , 3)">
                                <input type="color" name="btn_border_hexcolor" id="btn_border_hexcolor" class="btn_color" value="#bada55" onchange="buttoncolorSync(this.value , 4)">
                            </p>
                            <p>
                                <label>Mouse Over State Color</label>
                                <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="btn_horver_color" name="btn_horver_color" placeholder="#ffffff" value="#bada55" onchange="buttoncolorSync(this.value , 5)">
                                <input type="color" name="btn_horver_hexcolor" id="btn_horver_hexcolor" class="btn_color" value="#bada55" onchange="buttoncolorSync(this.value , 6)">
                            </p>

                            <p><input type="submit" name="submit" class="submits" value="Publish"></p>

                        </div>
                    </form>

                <?php } ?>
            </div>
        </div>

        <script>
            function buttoncolorSync( indexvalue , checkid) {
                if( checkid == 1)   
                {
                    document.getElementById("btn_hexcolor").value = indexvalue;
                    document.getElementById("btn_color").value = indexvalue;   
                }
                if( checkid == 2)
                {
                    document.getElementById("btn_color").value = indexvalue;
                    document.getElementById("btn_hexcolor").value = indexvalue;
                }
                if( checkid == 3)
                {
                    document.getElementById("btn_border_hexcolor").value = indexvalue;
                    document.getElementById("btn_border_color").value = indexvalue;
                }
                if( checkid == 4)
                {
                    document.getElementById("btn_border_hexcolor").value = indexvalue;
                    document.getElementById("btn_border_color").value = indexvalue;
                }
                if( checkid == 5)
                {
                    document.getElementById("btn_horver_hexcolor").value = indexvalue;
                    document.getElementById("btn_horver_color").value = indexvalue;
                }
                if( checkid == 6)
                {
                    document.getElementById("btn_horver_hexcolor").value = indexvalue;
                    document.getElementById("btn_horver_color").value = indexvalue;
                }
            }
            function currencyChange(val) {
                $('.currency').attr('value', val);
            }
            function priceChange(val) {
                $('.price').attr('value', val);
            }
            function toleranceChange(val) {
                $('.tolerance').attr('value', val);
            }
            function productChange(val) {
                $('.product').attr('value', val);
            }
            function confirmationChange(val) {
                $('.confirmation').attr('value', val);
            }
            function descriptionChange(val) {
                $('.description').attr('value', val);
            }
            function btntextChange(val) {
                $('.btn_text').attr('value', val);
            }
        </script>
        
        <?php
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'dnotes_token';

        $title = $_POST['title'];
        $currency = $_POST['currency'];
        $price = $_POST['price'];
        $tolerance = $_POST['tolerance'];
        $product = $_POST['product'];
        $confirmation = $_POST['confirmation'];
        $description = $_POST['description'];
        $btn_text = $_POST['btn_text'];
        $btn_color = $_POST['btn_color'];
        $btn_border_color = $_POST['btn_border_color'];
        $btn_horver_color = $_POST['btn_horver_color'];

        /**
         * 
         * INSERT TOKEN DATA
         * * */
        if (isset($_POST['submit']) && isset($title) && isset($currency) && isset($price) && isset($tolerance) && isset($product) && isset($confirmation) && isset($description) && isset($btn_text)) {
            $result_array = array(
                'title' => $title,
                'currency' => $currency,
                'price' => $price,
                'tolerance' => $tolerance,
                'product' => $product,
                'confir' => $confirmation,
                'desc' => $description,
                'btn-text' => $btn_text,
                'btn-color' => $btn_color,
                'btn-border-color' => $btn_border_color,
                'btn-horver-color' => $btn_horver_color
            );



            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              title varchar(255) DEFAULT 'dnotespay' NOT NULL,
              currency varchar(20) NOT NULL,
              price double NOT NULL,
              tolerance varchar(255) NOT NULL,
              product varchar(255) NOT NULL,
              confirmation varchar(255) NOT NULL,
              description varchar(255) NOT NULL,
              b_text varchar(100) NOT NULL,
              b_color varchar(10) NOT NULL,
              b_border_color varchar(10) NOT NULL,
              b_horver_color varchar(10) NOT NULL,
              published_date date NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($sql);


            $insert = $wpdb->insert($table_name, array(
                'title' => $title,
                'currency' => $currency,
                'price' => $price,
                'tolerance' => $tolerance,
                'product' => $product,
                'confirmation' => $confirmation,
                'description' => $description,
                'b_text' => $btn_text,
                'b_color' => $btn_color,
                'b_border_color' => $btn_border_color,
                'b_horver_color' => $btn_horver_color,
                'published_date' => date("Y-m-d h:i:s")
                    )
            );
            $this_insert = $wpdb->insert_id;

            $url = admin_url('admin.php?page=dnotes-token-new');
            ?>
            <script>document.location.href = "<?php echo $url; ?>"</script>

            <?php
        }

        /**
         * 
         * UPDATE TOKEN DATA
         * * */
        if (isset($_POST['update'])):

            $wpdb->update($table_name, array(
                'title' => $title,
                'currency' => $currency,
                'price' => $price,
                'tolerance' => $tolerance,
                'product' => $product,
                'confirmation' => $confirmation,
                'description' => $description,
                'b_text' => $btn_text,
                'b_color' => $btn_color,
                'b_border_color' => $btn_border_color,
                'b_horver_color' => $btn_horver_color,
                    ), array('id' => $item_id)
            );
            $url = admin_url('admin.php?page=dnotes-token-new');
            ?>
            <script>document.location.href = "<?php echo $url; ?>"</script>

        <?php
        endif;
        ob_flush();
        ?>


        <!--
        ###Button shows the Shortcode
        -->

        <div class="shortcode-container">
            <h2>Your Shortcode:</h2>

        <?php if ($_GET['id']) { ?>
                <input type="text" readonly=readonly value='[ dnotespay id="<?php echo $_GET['id']; ?>" ]'>
                <?php } else {
                ?>
                <input type="text" readonly=readonly value='[ dnotespay id="<?php echo $this_insert; ?>" ]'>
            <?php } ?>
        </div>
            <?php
        }

    }

    $add_token = new Addnew_token();
    