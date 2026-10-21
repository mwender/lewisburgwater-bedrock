<?php
/**
 * Plugin Name:  Disable REST Batch Endpoint
 * Description:  Blocks /batch/v1 (CVE-2026-60137 / CVE-2026-63030 attack surface). Runs at PHP_INT_MAX so ACF Pro's rest_pre_dispatch can't override it.
 * Version:      1.0.0
 */

add_filter( 'rest_pre_dispatch', function ( $result, $server, $request ) {
    if ( '/batch/v1' === $request->get_route() ) {
        return new WP_Error( 'rest_batch_disabled', 'Batch endpoint disabled.', array( 'status' => 403 ) );
    }
    return $result;
}, PHP_INT_MAX, 3 );
