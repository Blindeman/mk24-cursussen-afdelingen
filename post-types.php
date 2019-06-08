<?php 
/* Plugin Name: MK24 Cursussen en afdelingen
 * Plugin URI: http://www.mk24.nl
 * GitHub Plugin URI: https://github.com/Blindeman/mk24-cursussen-afdelingen
 * Description: Hiermee worden de 'cursus' post type en 'afdeling' taxonomy geregistreerd.
 * Author: Naomi Blindeman
 * Version: 1.0
 * Author URI: http://blindemanwebsites.com
 * License: GPLv2
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 //hook into the init action and call ak_create_cursus_taxonomies when it fires
add_action( 'init', 'ak_create_cursus_taxonomies', 0 );

//create new taxonomy: afdeling for the post types "cursussen" and "portfolio" 
function ak_create_cursus_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Afdelingen', 'taxonomy general name', 'framework'),
		'singular_name' => _x( 'Afdeling', 'taxonomy singular name', 'framework'),
		'search_items' =>  __( 'Doorzoek afdelingen', 'framework'),
		'all_items' => __( 'Alle afdelingen', 'framework'),
		'parent_item' => __( 'Hoofdafdeling', 'framework'),
		'parent_item_colon' => __( 'Hoofdafdeling:', 'framework'),
		'edit_item' => __( 'Bewerk afdeling', 'framework'), 
		'update_item' => __( 'Update afdeling', 'framework'),
		'add_new_item' => __( 'Nieuwe afdeling', 'framework'),
		'new_item_name' => __( 'Naam nieuwe afdeling', 'framework'),
		'menu_name' => __( 'Afdelingen', 'framework'),
	); 	

	register_taxonomy(
		'afdeling',
		array('portfolio','cursussen'),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'afdeling' ),
		)
	);
}

function mk24_cursus_post_types() {
	$labels = array(
		'name' => __( 'Cursussen', 'framework'),
		'singular_name' => __( 'Cursus', 'framework'),
		'add_new' => __( 'Nieuwe cursus', 'framework' ),
		'add_new_item' => __( 'Nieuwe cursus toevoegen', 'framework'),
		'edit' => __( 'Bewerk', 'framework' ),
		'edit_item' => __( 'Bewerk cursus', 'framework'),
		'new_item' => __( 'Nieuwe cursus', 'framework'),
		'view' => __( 'Bekijk cursussen', 'framework'),
		'view_item' => __( 'Bekijk cursus', 'framework'),
		'search_items' => __( 'Zoek cursus', 'framework'),
		'not_found' => __( 'Geen cursussen gevonden', 'framework'),
		'not_found_in_trash' => __( 'Geen cursus in de prullenbak', 'framework'),
		'parent' => __( 'Parent Cursus', 'framework')
	);
	$args = array (
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title','editor','thumbnail','author', 'excerpt' )
	);
	register_post_type( 'cursussen', $args );
}
add_action( 'init', 'mk24_cursus_post_types' );

?>