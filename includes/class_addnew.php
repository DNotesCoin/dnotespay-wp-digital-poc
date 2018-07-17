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
        add_submenu_page('dnotes-token-new', 'Add new', 'Add new', 'manage_options', 'add_newqg', array($this, 'add_newdata'));
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
                                    <select name="currency" class="qgcurrency" required>
                                        <option value="">Select...</option>
                                        <option value="usd">USD</option>
                                        <option value="dnotes token">DNotes</option>
                                    </select>
                                </p>
                                <p>
                                    <label>Price/Amount</label>
                                    <input type="text" name="price" class="price"  value="<?php echo $myquery->price; ?>" />
                                    <span class="span-desc">Purchase price in USD if you have selected USD, or amount in DNotes if you have selected DNotes</span>
                                </p>
                                <p>
                                    <label>Tolerance</label>
                                    <input type="text" name="tolerance" class="tolerance"  value="<?php echo $myquery->tolerance; ?>" />
                                    <span class="span-desc">If the user doesn't pay for the correct amount of DNotes, this is the tolerance for how much they can be off by, example 0.1</span>
                                </p>
                                <p>
                                    <label>Link to Download or Product</label>
                                    <input type="text" name="product" class="product"  value="<?php echo $myquery->product; ?>">
                                    <span class="span-desc">This will be shown to the user once the user has paid, product download or URL to the product you would like to deliver. Example: 
                                        Link to an article, a download zip, or PDF file such as http://mydomain.com/pdf_file.pdf</span>
                                </p>
                                <p>
                                    <label>Confirmations</label>
                                    <input type="text" name="confirmation" class="confirmation"  value="<?php echo $myquery->confirmation; ?>">
                                    <span class="span-desc">0=Fastest, payment has been sent but not confirmed to be valid, up to 1 minute. 6=Slow, up to 6 minutes, transaction fully validated on the network.</span>
                                </p>
                                <p>
                                    <label>Short Product Description</label>
                                    <input type="text" name="description" class="description"  value="<?php echo $myquery->description; ?>">
                                    <span class="span-desc">Enter a short description of the product you are selling</span>
                                </p>
                                <p>
                                    <label>Button Text</label>
                                    <input type="text" name="btn_text" class="btn_text"  value="<?php echo $myquery->b_text; ?>">
                                    <span class="span-desc">Examples: Buy Now, Buy with DNotes, DNotes Pay</span>
                                </p>
                                <p>
                                    <label>Button Color</label>
                                    <input type="color" name="btn_color" class="btn_color"  value="<?php echo $myquery->b_color; ?>">
                                    <!--<span class="span-desc">Select color for Button here.</span>-->
                                </p>

                                <p><!--<input type="button" name="btn-preview" class="btn-preview" value="Preview">--><input type="submit" name="update" class="submits" value="Update"></p>

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
                                <input type="color" name="btn_color" class="btn_color">
                                <!--<span class="span-desc">Select color for Button here.</span>-->
                            </p>

                            <p><!--<input type="button" name="btn-preview" class="btn-preview" value="Preview">--><input type="submit" name="submit" class="submits" value="Publish"></p>

                        </div>
                    </form>

                <?php } ?>
            </div>
        </div>

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

        /**
         * 
         * INSERT TOKEN DATA
         * * */
        if (isset($_POST['submit']) && isset($title) && isset($currency) && isset($price) && isset($tolerance) && isset($product) && isset($confirmation) && isset($description) && isset($btn_color) && isset($btn_text)) {
            $result_array = array(
                'title' => $title,
                'currency' => $currency,
                'price' => $price,
                'tolerance' => $tolerance,
                'product' => $product,
                'confir' => $confirmation,
                'desc' => $description,
                'btn-text' => $btn_text,
                'btn-color' => $btn_color
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
                    ), array('id' => $item_id)
            );
            $url = admin_url('admin.php?page=dnotes-token-new');
            ?>
            <script>document.location.href = "<?php echo $url; ?>"</script>

            <?php
//                     wp_safe_redirect($url);
//                     exit;
        endif;
        ob_flush();
        ?>


        <!--
        ###Button shows the Shortcode
        -->

        <div class="shortcode-container">
            <h2>Your Shortcode:</h2>

        <?php if ($_GET['id']) { ?>
                <input type="text" readonly=readonly value="[ dnotespay id='<?php echo $_GET['id']; ?>' ]">
                <?php } else {
                ?>
                <input type="text" readonly=readonly value="[ dnotespay id='<?php echo $this_insert; ?>' ]">
            <?php } ?>
        </div>
            <?php
        }

    }

    $add_token = new Addnew_token();
    