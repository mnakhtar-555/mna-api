<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_action( 'rest_api_init', 'custom_api_register_routes' );

function custom_api_register_routes() {
    register_rest_route( 'mna-api/v1', '/posts', array(
        'methods'  => 'GET',
        'callback' => 'custom_api_get_posts',
    ) );

    register_rest_route( 'mna-api/v1', '/pages', array(
        'methods'  => 'GET',
        'callback' => 'custom_api_get_pages',
    ) );

    register_rest_route( 'mna-api/v1', '/comments', array(
        'methods'  => 'GET',
        'callback' => 'custom_api_get_comments',
    ) );
    
    register_rest_route( 'mna-api/v1', '/specializations', array(
        'methods'       => 'GET',
        'callback'      => 'custom_api_get_specializations',
    ));

    register_rest_route( 'mna-api/v1', '/agency-intros', array(
        'methods'   => 'GET',
        'callback'  => 'custom_api_get_agency_intro'
    ));
}

function custom_api_get_posts( $request ) {
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    $posts = get_posts( $args );

    if ( empty( $posts ) ) {
        return new WP_Error( 'no_posts', 'No posts found', array( 'status' => 404 ) );
    }

    return rest_ensure_response( $posts );
}

function custom_api_get_pages( $request ) {
    $args = array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    $pages = get_posts( $args );

    if ( empty( $pages ) ) {
        return new WP_Error( 'no_pages', 'No pages found', array( 'status' => 404 ) );
    }

    return rest_ensure_response( $pages );
}

function custom_api_get_comments( $request ) {
    $args = array(
        'status' => 'approve',
    );

    $comments = get_comments( $args );

    if ( empty( $comments ) ) {
        return new WP_Error( 'no_comments', 'No comments found', array( 'status' => 404 ) );
    }

    return rest_ensure_response( $comments );
}

function custom_api_get_specializations( $request ){
    $args = array(
        'post_type'         => 'specialization',
        'post_status'       => 'publish',
        'posts_per_page'    => -1
    );
    $specializations = get_posts($args);

    if( empty($specializations)){
        return new WP_Error( 'no_posts', 'No post found in specialization', array( 'status'=>404));
    }
    return rest_ensure_response( $specializations );
}

function custom_api_get_agency_intro($request){
    $args = array(
        'post_type'     => 'agency-intro',
        'post_status'   => 'publish',
        'posts_per_page'=> -1
    );
    $agency_intros = get_posts($args);

    if( empty( $agency_intros) ) {
        return new WP_Error( 'no_posts', 'No post found in agency intro', array( 'status' => 404 ) );
    }
    return rest_ensure_response( $agency_intros);
}