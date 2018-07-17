<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class QGSettings {

    public function __construct() {
        add_action('admin_menu', array($this, 'addnew_settingmenu'));
    }

    public function addnew_settingmenu() {
        add_submenu_page('dnotes-token-new', 'DNotes Settings', 'DNotes Settings', 'manage_options', 'qg_settings', array($this, 'settingsmenudata'));
    }

    public function settingsmenudata() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'dnotes_address';
        $charset_collate = $wpdb->get_charset_collate();

        $getaddress = $wpdb->get_results("SELECT * FROM $table_name");
        ?>
        <div class="mycontainer">
            <div class="data-container">
                <h2>DNotesPay Settings</h2>
                <form method="POST" name="qg-address">
                    <div class="setting-section">
                        <p>
                            <label>DNotes Addresses One per line</label>
                            <textarea class="address" name="address" cols="100" rows="3"><?php
        $addID = array();
        foreach ($getaddress as $addrss):
            echo $addrss->address;

        endforeach;
        ?></textarea>
                        </p>

                        <p style="text-align:right;"><input type="submit" name="delete" class="submits" value="Delete Address"><input type="submit" class="submits" name="submit" value="Save Address"></p>
                </form>
            </div>

        </div>
        <?php
        $address = $_POST['address'];

        if (isset($address) && isset($_POST['submit'])) {
            $create_table = "CREATE TABLE IF NOT EXISTS $table_name("
                    . "id int(9) NOT NULL AUTO_INCREMENT,"
                    . "address varchar(255) NOT NULL,"
                    . "PRIMARY KEY  (id))$charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($create_table);
            
            $delete = $wpdb->query("TRUNCATE TABLE $table_name");
            $address_lines = explode("\n", $address);
            foreach($address_lines as $address_line) {
                $insert = $wpdb->insert($table_name, array(
                    'address' => $address_line
                ));
            }
            
            $url = admin_url('admin.php?page=dnotes_settings');
            ?>
            <script>document.location.href = "<?php echo $url; ?>"</script>

            <?php
        }
        if (isset($_POST['delete'])):

            $addID = array();
            foreach ($getaddress as $addrss):



                $wpdb->delete(
                        "{$wpdb->prefix}dnotes_address", ['id' => $addrss->id], ['%d']
                );
            endforeach;
            $url = admin_url('admin.php?page=qg_settings');
            ?>
            <script>document.location.href = "<?php echo $url; ?>"</script>

            <?php
        endif;
    }

}

new QGSettings();
