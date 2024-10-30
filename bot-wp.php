<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Plugin Name: BusOnlineTicket Search Box
* Plugin URI: https://www.busonlineticket.com/
* Description: Empower your site with a customizable search box for bus, train, and ferry tickets in Malaysia and Singapore. Designed for busonlineticket.com affiliates.
* Version: 1.0
* Author: BusOnlineTicket
* Author URI: https://profiles.wordpress.org/busonlineticket/
* License: GPL2
*/

$plugin_url = WP_PLUGIN_URL . '/bot-wp';

$global_titleValue = '';
$global_sizeValue = '';
$global_typeValue = '';
$global_fromValue = '';
$global_toValue = '';

function botwp_plugin_menu()
{
    add_menu_page(
		__( 'BusOnlineTicket', 'textdomain' ),
		'BusOnlineTicket',
		'manage_options',
		'bot-wp',
		'botwp_plugin_page_content',
		'dashicons-tickets-alt',
		6
	);
}

add_action('admin_menu', 'botwp_plugin_menu');

// Main function
function botwp_plugin_page_content()
{		
	// Check user capabilities
    if (!current_user_can('manage_bot_searchbox_settings'))
    {
        wp_die('You do not have enough permission to view this page.');
    }            

	global $plugin_url;
	
	if (isset($_POST['partner_id_submitted']))
	{
		$hidden_field = esc_html(sanitize_text_field($_POST['partner_id_submitted']));
		
		if ($hidden_field == 'Y')
		{
			$partner_id = esc_html(sanitize_text_field($_POST['partner_id']));			
		}
	}	
	
	// Enqueue scripts and styles here
    // wp_enqueue_script('custom-search-box', plugin_dir_url(__FILE__) . 'inc/js/search_box_function.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('custom-from-to', plugin_dir_url(__FILE__) . 'inc/js/from_to_function.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('all-route', 'https://cdn.busonlineticket.com/js/all_route.js', array('jquery'), '1.0', true);
    
    // wp_localize_script('custom-search-box', 'my_ajax_object', array('ajax_nonce' => wp_create_nonce('my_ajax_nonce')));

    // wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . 'inc/css/options-page-wrapper.css');
    // Enqueue scripts and styles
    enqueue_botwp_scripts_and_styles();
	
	require('inc/options-page-wrapper.php');
}

// Enqueue scripts and styles
function enqueue_botwp_scripts_and_styles() 
{
    // Enqueue scripts
    wp_enqueue_script('custom-search-box', plugin_dir_url(__FILE__) . 'inc/js/search_box_function.js', array('jquery'), '1.0', true);
    wp_enqueue_script('custom-from-to', plugin_dir_url(__FILE__) . 'inc/js/from_to_function.js', array('jquery'), '1.0', true);
    wp_enqueue_script('all-route', 'https://cdn.busonlineticket.com/js/all_route.js', array('jquery'), '1.0', true);
    
    // Localize script
    wp_localize_script('custom-search-box', 'my_ajax_object', array('ajax_nonce' => wp_create_nonce('my_ajax_nonce')));
    wp_localize_script('custom-search-box', 'plugin_data', array(
        'image_url' => esc_url(plugin_dir_url(__FILE__) . 'inc/img/Logo-01.png')
    ));
    
    // Enqueue styles
    wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . 'inc/css/options-page-wrapper.css');
}

add_action('wp_enqueue_scripts', 'enqueue_botwp_scripts_and_styles');

//call css file
// function botwp_plugin_enqueue_admin_styles() 
// {
    // wp_enqueue_style('bot-plugin-styles', plugins_url(''));
// }

// add_action('admin_enqueue_scripts', 'botwp_plugin_enqueue_admin_styles');

function botwp_process_form_data() 
{
	// Check the nonce
    if (!isset($_POST['_wpnonce']) || !check_ajax_referer('my_ajax_nonce', '_wpnonce', false)) 
	{
        wp_die('Nonce verification failed.');
    }
	
    if (!current_user_can('manage_bot_searchbox_settings')) 
	{
        wp_die('You do not have sufficient permissions to perform this action.');
    }
	
	global $global_titleValue, $global_sizeValue, $global_typeValue, $global_fromValue, $global_toValue;
	
	$global_titleValue = esc_html(sanitize_text_field($_POST['title_searchbox']));
    $global_sizeValue = esc_html(sanitize_text_field($_POST['example']));
    $global_typeValue = esc_html(sanitize_text_field($_POST['type_searchbox']));
    $global_fromValue = esc_html(sanitize_text_field($_POST['from_searchbox']));
    $global_toValue = esc_html(sanitize_text_field($_POST['to_searchbox']));

    // Insert data into the custom table
	botwp_insert_searchbox_data();

    wp_die(); 
}

add_action('wp_ajax_process_form_data', 'botwp_process_form_data');
add_action('wp_ajax_nopriv_process_form_data', 'botwp_process_form_data');

function botwp_process_partner_data() 
{
	if (!isset($_POST['_wpnonce']) || !check_ajax_referer('my_ajax_nonce', '_wpnonce', false)) {
		wp_die('Nonce verification failed.');
	}	
	
	global $global_partnerId;
	
	$global_partnerId = esc_html(sanitize_text_field($_POST['partner_id']));
	
	// Check if partner ID is already registered
	if (botwp_is_partner_id_registered($global_partnerId)) 
	{
		 $response = array('status' => 'error', 'message' => 'The Partner ID you provided has already been registered.');
	} 

	else
	{
		botwp_insert_data();
		$response = array('status' => 'success', 'message' => 'Partner ID successfully saved.');
	}
	
    wp_send_json($response);

    wp_die();
} 

add_action('wp_ajax_process_partner_data', 'botwp_process_partner_data');
add_action('wp_ajax_nopriv_process_partner_data', 'botwp_process_partner_data');

// Function to check if the partner ID is already registered
function botwp_is_partner_id_registered($partner_id) 
{
    global $wpdb;
    $table_name = $wpdb->prefix . "bot_generic_settings";

    $result = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE partner_id = %s", $partner_id));

    return $result > 0;
}

// Function to get updated data list table HTML
function botwp_get_data_list_table()
{
    if (!current_user_can('manage_bot_searchbox_settings')) 
	{
        wp_die('You do not have sufficient permissions to perform this action.');
    }
	
    $data = botwp_fetch_data();
	$count = 1; 
	
    echo '<table style="margin-bottom: 20px;" class="widefat">';
	echo '<thead>';
	echo '<tr>';
	echo '<th style="text-align: center;" class="sequence-number">No.</th>';
	echo '<th style="text-align: center;">Title</th>';
	echo '<th style="text-align: center;">Size</th>';
	echo '<th style="text-align: center;">Default Type</th>';
	echo '<th style="text-align: center;">Option</th>'; 
	echo '</tr>';
	echo '</thead>';
	echo '<tbody id="data-table">';
	
    foreach ($data as $row) 
	{
		echo '<tr>';
		echo '<td style="text-align: center;" class="sequence-number">' . esc_html($count) . '</td>';
		echo '<td style="text-align: center;">' . esc_html($row['title']) . '</td>';
		echo '<td style="text-align: center;">' . esc_html($row['size']) . '</td>';
		echo '<td style="text-align: center;">' . esc_html($row['default_type']) . '</td>';
		echo '<td style="text-align: center;">';
		
		echo '<a href="#" onclick="editRecord(' . esc_js(addslashes(json_encode($row['id']))) . ', \'' . esc_js(addslashes($row['title'])) . '\', \'' . esc_js(addslashes($row['size'])) . '\', \'' . esc_js(addslashes($row['default_type'])) . '\', \'' . esc_js(addslashes($row['default_from'])) . '\', \'' . esc_js(addslashes($row['default_to'])) . '\');">Edit</a>';
		echo ' | ';
		echo '<a href="#" onclick="deleteRecord(' . esc_js($row['id']) . ');">Delete</a>';
		
		echo '</td>';
		echo '</tr>';

		$count++; 
    }
	
    echo '</tbody>';
	echo '</table>';

    wp_die(); 
}

add_action('wp_ajax_get_data_list_table', 'botwp_get_data_list_table');
add_action('wp_ajax_nopriv_get_data_list_table', 'botwp_get_data_list_table');

// Function to fetch data from the custom table
function botwp_fetch_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "bot_searchbox_settings";

    // Fetch data from the custom table
    $data = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name" ), ARRAY_A );

    return $data;
}

// Create custom table
function botwp_install()
{
	global $wpdb; 
	
	// First table
	$table_name = $wpdb->prefix . "bot_generic_settings"; 
	$charset_collate = $wpdb->get_charset_collate(); 
	
	$sql1 = "CREATE TABLE $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT, 
	  update_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
	  country text NULL, 
	  partner_id text NOT NULL, 
	  PRIMARY KEY  (id) 
	) $charset_collate;"; 
	
	// Second table
	$table_name2 = $wpdb->prefix . "bot_searchbox_settings"; 
	
	$sql2 = "CREATE TABLE $table_name2 (
	  id mediumint(9) NOT NULL AUTO_INCREMENT, 
	  update_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
	  title text NOT NULL, 
	  size text NOT NULL, 
	  default_from text NOT NULL, 
	  default_to text NOT NULL, 
	  default_type text NOT NULL,
	  country text NULL, 
	  language text NULL, 
	  currency text NULL, 
	  PRIMARY KEY  (id) 
	) $charset_collate;"; 

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); 
	$result1 = dbDelta( $sql1 );
    $result2 = dbDelta( $sql2 );
	
	// Register custom capability
    $role = get_role('administrator'); 

    if ($role) 
	{
        $role->add_cap('manage_bot_searchbox_settings');
    }
}

register_activation_hook( __FILE__, 'botwp_install' );

// Insert data into first table
function botwp_insert_data() 
{
    global $wpdb, $global_partnerId;
    $table_name = $wpdb->prefix . "bot_generic_settings";

    $data = array(
        'update_date' => current_time('mysql', 1),
        // 'country' => $selectedCountry,
        'partner_id' => $global_partnerId,
    );

    $wpdb->insert($table_name, $data);
}

// Insert data into second table
function botwp_insert_searchbox_data() 
{
	if (!current_user_can('manage_bot_searchbox_settings')) 
	{
		wp_die('You do not have sufficient permissions to perform this action.');
	}

    global $wpdb, $global_titleValue, $global_sizeValue, $global_typeValue, $global_fromValue, $global_toValue;
    $table_name = $wpdb->prefix . "bot_searchbox_settings";

    $data = array(
        'update_date' => current_time('mysql', 1),
        'title' => $global_titleValue,
        'size' => $global_sizeValue,
        'default_from' => $global_fromValue,
        'default_to' => $global_toValue,
        'default_type' => $global_typeValue,
        // 'country' => $global_countryValue,
		// 'language' => null,
        // 'currency' => null,
    );

    $wpdb->insert($table_name, $data);
}

add_action('wp_ajax_save_css', 'botwp_save_css');
add_action('wp_ajax_nopriv_save_css', 'botwp_save_css');

function botwp_save_css() 
{
    if (isset($_POST['css_content'])) 
	{
		// Retrieve and sanitize css_content
        $css_content = wp_kses_post(stripslashes($_POST['css_content']));
		
		// Retrieve the content from jqueryCode.txt
        $jqueryCode = file_get_contents(plugin_dir_path(__FILE__) . 'inc/css/jquery.txt');

        // Concatenate with a new line
        $combinedValue = $css_content . "\n\n" . $jqueryCode;

        // Define the path to plugin folder
        $plugin_folder = plugin_dir_path(__FILE__);

        // Specify the subdirectory structure
        $subdirectory = 'inc/css/';
		
		$currentDateTime = date('mdHis', time());

        // Create a unique filename for the CSS file 
		$filename = 'custom-style.css';

        // Full path to the CSS file inside the subdirectory
        $css_file_path = $plugin_folder . $subdirectory . $filename;

        // Ensure the subdirectory exists, create it if needed
        if (!file_exists($plugin_folder . $subdirectory)) {
            mkdir($plugin_folder . $subdirectory, 0755, true);
        }

        // Write the CSS content to the file
        if (file_put_contents($css_file_path, $combinedValue) !== false) 
		{
            echo esc_html('CSS file saved successfully!');
        }  
		
		else 
		{
            echo esc_html('Error saving CSS file.');
			echo esc_html($css_file_path);
        }
    }

    wp_die(); 
}

// Remove the custom tables when the plugin is uninstalled
function botwp_uninstall() 
{
    global $wpdb;
	
	$tableArray = [   
		$wpdb->prefix . "bot_generic_settings",
		$wpdb->prefix . "bot_searchbox_settings",
	];

	foreach ($tableArray as $tablename) {
		$wpdb->query( $wpdb->prepare( "DROP TABLE IF EXISTS %s", $tablename ) );
	}
}

register_uninstall_hook(__FILE__, 'botwp_uninstall');

// Check if the custom table exist
function botwp_check_custom_table_existence() 
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'bot_generic_settings';

    $query = $wpdb->prepare("SHOW TABLES LIKE %s", $table_name);
    
    if ($wpdb->get_var($query) != $table_name) 
	{
        echo esc_html("The table $table_name does not exist.");
    } 
	
	else 
	{
        echo esc_html("The table $table_name exists.");
    }
}

//botwp_check_custom_table_existence();

// Shortcode generated
function botwp_bus_online_ticket_shortcode($atts) 
{
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'title'   => '', 
            'size'    => '', 
            'type'    => '', 
            'from'    => '', 
            'to'      => '', 
        ),
        $atts,
        'botwp_search_box'
    );
	
	global $wpdb;

	$table_name = $wpdb->prefix . "bot_generic_settings";
    $query = $wpdb->prepare("SELECT partner_id FROM $table_name ORDER BY update_date DESC LIMIT 1");
	$partnerId = $wpdb->get_var($query);

    // Retrieve attributes
    $titleValue  = $atts['title'];
    $sizeValue   = $atts['size'];
    $typeValue   = $atts['type'];
    $fromValue   = $atts['from'];
    $toValue     = $atts['to'];
	
	if ($sizeValue === '265x424') 
	{
        $sizeValue = '265_424';
    }
	
	else if ($sizeValue === '315x291') 
	{
        $sizeValue = '315_291';
    }
	
    else if ($sizeValue === '570x294') 
	{
        $sizeValue = '570_294';
    }

    // Include the HTML template file
    ob_start();
    include(plugin_dir_path(__FILE__) . 'inc/bot_search_box_template.php');
    return ob_get_clean();
}

add_shortcode('botwp_search_box', 'botwp_bus_online_ticket_shortcode');