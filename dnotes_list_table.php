<?php
/* * *
 * #CLASS QGLIst extends the default WP_List_Table class.
 * This child class graps the functionality for admin list table.
 * ** */

class QGLIst extends WP_List_Table {

    /**
     * QGLIst constructor.
     *
     * REQUIRED. Set up a constructor that references the parent constructor. We
     * use the parent reference to set some default configs.
     */
    public function __construct() {
        // Set parent defaults.
        parent::__construct(array(
            'singular' => 'dnotespay', // Singular name of the listed records.
            'plural' => 'dnotespays', // Plural name of the listed records.
            'ajax' => false, // Does this table support ajax?
        ));
    }

    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items() {
        $user_search_key = isset($_REQUEST['s']) ? wp_unslash(trim($_REQUEST['s'])) : '';
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->process_bulk_action();
        $data = $this->table_data();
        if ($user_search_key) {
            $data = $this->filter_table_data($data, $user_search_key);
        }
        usort($data, array(&$this, 'sort_data'));
        $perPage = $this->get_items_per_page('items_per_page', 5);
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $perPage,
            'total_pages' => ceil($totalItems / $perPage),
        ));
        $data = array_slice($data, ( ( $currentPage - 1 ) * $perPage), $perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /* Filter the table data based on the search key
     * @return Search based data
     */

    public function filter_table_data($data, $search_key) {
        $filtered_table_data = array_values(array_filter($data, function( $row ) use( $search_key ) {
                    foreach ($row as $row_val) {
                        if (stripos($row_val, $search_key) !== false) {
                            return true;
                        }
                    }
                }));
        return $filtered_table_data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => 'Title',
            'date' => 'Date',
            'shortcode' => 'Shortcode',
        );
        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns() {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns() {
        return array('title' => array('title', true),
            'date' => array('date', true)
        );
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data() {
        global $wpdb;

        $tablename = $wpdb->prefix . 'dnotes_token';
        $query = $wpdb->get_results("SELECT * FROM $tablename");
        $data = array();

        foreach ($query as $myquery):


            $data[] = array(
                'id' => $myquery->id,
                'title' => $myquery->title,
                'date' => $myquery->published_date,
                'shortcode' => '<code>[dnotespay id=' . '"' . $myquery->id . '"' . ']</code>',
            );
        endforeach;
        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default($item, $column_name) {
        switch ($column_name) {

            case 'title':
            case 'date':
            case 'shortcode':
                return $item[$column_name];
            default:
                return print_r($item, true);
        }
    }

    /**
     * Get value for checkbox column.
     *
     * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
     * is given special treatment when columns are processed. It ALWAYS needs to
     * have it's own method.
     *
     * @param object $item A singular item (one full row's worth of data).
     * @return string Text to be placed inside the column <td>.
     */
    protected function column_cb($item) {

        return sprintf(
                '<input type="checkbox" name="%1$s[]" value="%2$s" class="%1$s" />', $this->_args['singular'], // Let's simply repurpose the table's singular label ("movie").
                $item['id']                // The value of the checkbox should be the record's ID.
        );
    }

    protected function column_title($item) {

        $actions = array(
            'edit' => sprintf('<a href="?page=add_newtoken&action=edit&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'cltd_example')),
        );
        return sprintf('%s %s', $item['title'], $this->row_actions($actions)
        );
    }

    /**
     * GET List of bulk actions. 
     * * */
    protected function get_bulk_actions() {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
     * HANDLE bulk actions.
     * * */
    protected function process_bulk_action() {
        global $wpdb;
        $id = $_GET['id'];
        // Detect when a bulk action is being triggered.
        if ('delete' === $this->current_action()) {

            $wpdb->delete(
                    "{$wpdb->prefix}dnotes_token", ['id' => $id], ['%d']
            );

            $url = admin_url('admin.php?page=dnotes-token-new');
            ?>
            <script>document.location.href = "<?php echo $url; ?>"</script>

            <?php
        }

        // Bulk-Action.

        if (( isset($_POST['action']) && $_POST['action'] == 'delete' ) || ( isset($_POST['action2']) && $_POST['action2'] == 'delete' )
        ) {

            $delete_ids = esc_sql($_POST['dnotespay']);

            // loop over the array of record IDs and delete them
            foreach ($delete_ids as $ids) {

                $wpdb->delete(
                        "{$wpdb->prefix}dnotes_token", ['id' => $ids], ['%d']
                );
            }

//                 wp_redirect( esc_url( add_query_arg() ) );
//                 exit;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data($a, $b) {
        // Set defaults
        $orderby = 'date';
        $order = 'desc';
        // If orderby is set, use this as the sort column
        if (!empty($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        }
        // If order is set use this as the order
        if (!empty($_GET['order'])) {
            $order = $_GET['order'];
        }
        $result = strcmp($a[$orderby], $b[$orderby]);
        if ($order === 'desc') {
            return $result;
        }
        return $result;
    }

}
?>