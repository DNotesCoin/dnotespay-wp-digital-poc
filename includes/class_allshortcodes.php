<?php
/* *
 * Class Addshortcode - Display data table.
 * */

class Addshortcode {

    // class instance
    static $instance;
    // Item WP_List_Table object
    public $QGListTable;

    public function __construct() {

        add_action('admin_menu', array($this, 'add_qgmenu'), 10);
        add_filter('set-screen-option', [__CLASS__, 'set_screen'], 10, 3);
    }

    public function add_qgmenu() {
        $mymenu = add_menu_page(
            'DNotesPay', 
            'DNotesPay', 
            'manage_options', 
            'dnotes-token-new', 
            array($this, 'menudata'), 
            plugins_url( 'dnotes_pay/assets/dnotes.png' )
        );
        add_action("load-$mymenu", array($this, 'screen_option'));
    }

    /**
     * Screen options
     */
    public function screen_option() {

//            global $QGListTable;
        $screen = get_current_screen();
        $option = 'per_page';
        $args = [
            'label' => 'Items',
            'default' => 5,
            'option' => 'items_per_page'
        ];

        add_screen_option($option, $args);

        $this->QGListTable = new QGList();
    }

    public static function set_screen($status, $option, $value) {
        return $value;
    }

    public function menudata() {
        /**
         * Plugin settings page
         */
//        $QGListTable = new QGLIst();
        ?>
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <h2>DNotesPay</h2>
            <form method="post">
        <?php $this->QGListTable->prepare_items(); ?>
        <?php $this->QGListTable->search_box('Search item', 'dnotespay'); ?>
        <?php $this->QGListTable->display(); ?>
            </form>
        </div>
        <?php
    }

    /** Singleton instance */
    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}

$addnew = new Addshortcode();
