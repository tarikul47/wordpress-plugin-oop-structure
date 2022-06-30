<?php
/**
 * Database data count
 *
 * @return  int
 */

function wc_ac_address_count()
{
    global $wpdb;
    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}ac_addresses");
}

/**
 * data fetch and show
 *
 * @return array
 */

function wc_ac_get_address($args = [])
{
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}ac_addresses
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
            $args['offset'], $args['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;
}

/**
 * Data insert  function in database
 * @param array $args
 * @return int| WP_Error
 */

function wc_ac_insert_address($args = [])
{
    global $wpdb;

    if (empty($args['name'])) {
        return new \WP_Error('no-name', __("You must provide a name", "wecoder_academy"));
    }

    $default = [
        'name' => '',
        'address' => '',
        'phone' => '',
        'created_at' => current_time('mysql'),
        'created_by' => get_current_user_id(),
    ];
    $data = wp_parse_args($args, $default);

    $inserted = $wpdb->insert(
        "{$wpdb->prefix}ac_addresses",
        $data,
        [
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
        ],
    );

    if (!$inserted) {
        return new \WP_Error('failed-to-inserted', __("Failed to inserty data", "wecoder_academy"));
    }

    return $wpdb->insert_id;
}
