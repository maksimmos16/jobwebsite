<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'ZMW': $currency_symbol = 'ZMK'; break;
     }
     return $currency_symbol;
}

function easyjob_enqueue_scripts() {
    wp_enqueue_script( 'my', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true );  
 }
add_action( 'wp_enqueue_scripts', 'easyjob_enqueue_scripts', 10 );

function easyjob_enqueue_scripts_update_profile_page() {
    if( is_page_template( 'candidate-edit-profile.php' ) ){
	wp_enqueue_script( 'update-profile-page-confirmation', get_stylesheet_directory_uri() . '/assets/js/update-profile-page.js', array('jquery'), null, true );  
}
}
add_action( 'wp_enqueue_scripts', 'easyjob_enqueue_scripts_update_profile_page' );

/* Search JObs */
add_action('wp_ajax_search_job', 'home_job_search'); 
add_action('wp_ajax_nopriv_search_job', 'home_job_search');
function home_job_search(){   
	global $wpdb;
	$searchText = $_POST['search'];
    $search_arr = array();
    $query_args = array( 's' => $searchText, 'post_type' => 'job_post', 'post_status' => 'publish' );
	$query = new WP_Query( $query_args );
	// echo $query->request;
	/*$searchquery = $wpdb->get_results("
       SELECT * FROM ej_posts WHERE `ej_posts.post_title` LIKE ('%$searchText%')
OR (`ej_posts.post_content` LIKE '%$searchText%')))
       ORDER BY `ej_posts.post_date` DESC");
	print_r($searchquery);*/
	// echo $searcshquery;
	if ( $query->have_posts() ) {
		while ($query -> have_posts()): $query -> the_post(); 
		/*$id = get_the_ID();
        $name = get_the_title();
        $link = get_the_permalink();*/
        $search_arr[] = array("id" => get_the_ID(), "name" => get_the_title(), "link" => get_the_permalink() );	
		endwhile;
	}
	/*foreach ($query->posts as $post) {
        $id = $post->ID;
        $name = $post->post_title;
        $link = $post->guid;

        $search_arr[] = array("id" => $id, "name" => $name, "link" => $link );
    }*/
    /*$sql = "SELECT id,name FROM user where name like '%".$searchText."%' order by name asc limit 5";

    $result = mysqli_query($con,$sql);


    */
// $search_arr[] = array("id" => "1", "name" => "zee");
    echo json_encode($search_arr);
die();
}

function ads_widgets_init() {

	register_sidebar( array(
		'name'          => 'Ads sidebar',
		'id'            => 'ads_widgets',
		'before_widget' => '<div class="panel panel-default">',
		'after_widget'  => '</div>',
		// 'before_title'  => '<h2 class="rounded">',
		// 'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'ads_widgets_init' );

function fws_delete_row(){
    global $wpdb;
    $table = 'ej_user_messages';
    $id = $_POST['id'];
    $wpdb->delete($table, array('id_message' => $id));    
}
add_action( 'wp_ajax_fws_delete_row', 'fws_delete_row' );
add_action( 'wp_ajax_nopriv_fws_delete_row', 'fws_delete_row' );

add_action( 'wp_ajax_update_last_seen_value', 'update_last_seen_value' );
function update_last_seen_value() {
    global $wpdb;
    $table = 'ej_users';
    $id = $_POST['id'];
    $meta_value = date('Y-m-d H:i:s');
    update_user_meta( $id , 'last_seen', $meta_value );
        $data = array(
            "status"     => 'success'
        );
    echo json_encode($data);
    die();
}


@ini_set( 'upload_max_size' , '100M' );
@ini_set( 'post_max_size', '100M');
@ini_set( 'max_execution_time', '300' );


