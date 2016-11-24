<?php

if (!defined('WP_UNINSTALL_PLUGIN'))
  wp_die(__('Plugin uninstallation can not be executed in this fashion.'));

global $wpdb;

define( 'VIMEOGRAPHY_PRO_TABLE', $wpdb->prefix . "vimeography_pro_meta");

delete_option('vimeography_pro_db_version');
delete_option('vimeography_pro_access_token');

$wpdb->query('DROP TABLE ' . VIMEOGRAPHY_PRO_TABLE);