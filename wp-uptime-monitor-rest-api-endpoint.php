<?php

/**
 * Plugin Name:  WP Uptime Monitor REST API Endpoint
 * Plugin URI:   https://github.com/tombonez/wp-uptime-monitor-rest-api-endpoint
 * Description:  A WordPress plugin for adding a non-cacheable REST API endpoint to your website that can be used to monitor its uptime.
 * Version:      1.0.1
 * Author:       Tom Taylor
 * Author URI:   https://github.com/tombonez
 */

namespace WPUptimeMonitorRESTAPIEndpoint;

function register_route() {
	register_rest_route(
		'uptime-monitor/v1',
		'/check',
		array(
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => __NAMESPACE__ . '\handle_request',
		)
	);
}

function handle_request() {
	define( 'DONOTCACHEPAGE', true );

	global $wpdb;

	$query_result = $wpdb->get_row( 'SELECT NOW() as datetime' );

	if ( $query_result ) {
		return new \WP_REST_Response(
			array(
				'status'    => 'online',
				'timestamp' => $query_result->datetime,
			),
			200,
			wp_get_nocache_headers()
		);
	}

	return new \WP_Error(
		'service_unavailable',
		'Service Unavailable',
		array(
			'status' => 503,
		)
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\register_route' );
