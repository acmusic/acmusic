<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Vimeography_Pro_Database {

  /**
   * Current version of the Vimeography Pro database
   *
   * @var string
   */
  private static $_vimeography_pro_db_version;

  /**
   * Set the database version stored in WP_Options table
   */
  public function __construct() {
    self::$_vimeography_pro_db_version = get_site_option('vimeography_pro_db_version');
    register_activation_hook( VIMEOGRAPHY_PRO_BASENAME, array($this, 'vimeography_pro_update_tables') );

    add_action( 'plugins_loaded', array( $this, 'vimeography_pro_update_database') );
    add_action( 'admin_init',     array( $this, 'vimeography_pro_check_if_db_exists') );
  }

  /**
   * Adds a row containing default settings for the given
   * gallery id
   *
   * @access public
   * @param int $gallery_id The gallery ID to create a row for
   * @return mixed row on success, False on failure
   */
  public function add_default_settings($gallery_id) {
    global $wpdb;

    $row = $wpdb->insert(
      VIMEOGRAPHY_PRO_TABLE,
      array(
        'gallery_id' => $gallery_id,
        'per_page'   => 20,
        'sort'       => 'default',
        'direction'  => 'desc',
        'playlist'   => 0,
        'allow_downloads' => 0
      ),
      array('%d', '%d', '%s', '%s', '%d', '%d')
    );

    return $row;
  }

  /**
   * [vimeography_pro_update_database description]
   * @return [type] [description]
   */
  public function vimeography_pro_update_database() {
    self::vimeography_pro_update_db_to_0_6();
    self::vimeography_pro_update_db_to_0_9();
    self::vimeography_pro_update_db_to_1_0();
    self::_vimeography_pro_update_db_version();
  }

  /**
   * [vimeography_pro_check_if_db_exists description]
   * @return [type] [description]
   */
  public function vimeography_pro_check_if_db_exists() {
    if ( get_site_option('vimeography_pro_db_version') === FALSE )
      self::_vimeography_pro_update_db_version();
  }

  /**
   * Updates the Vimeography Pro version stored in the database.
   *
   * @access public
   * @return void
   */
  private static function _vimeography_pro_update_db_version() {
    update_site_option('vimeography_pro_db_version', VIMEOGRAPHY_PRO_VERSION);
  }


  /**
   * Create Pro table when plugin is activated.
   *
   * @access public
   * @return void
   */
  public function vimeography_pro_update_tables() {
    global $wpdb;

    $sql = 'CREATE TABLE '.VIMEOGRAPHY_PRO_TABLE.' (
    id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    gallery_id mediumint(8) unsigned NOT NULL,
    per_page int(11) unsigned NOT NULL DEFAULT 25,
    sort varchar(50) NOT NULL DEFAULT "default",
    direction varchar(10) NOT NULL DEFAULT "desc",
    playlist tinyint(1) NOT NULL DEFAULT 0,
    allow_downloads tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY  (id)
    );
    ';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

  /**
   * Check if the Vimeography database structure needs updated to version 0.6 based on the stored db version.
   *
   * @access public
   * @return void
   */
  public static function vimeography_pro_update_db_to_0_6() {
    if ( version_compare(self::$_vimeography_pro_db_version, '0.6', '<') ) {
      global $wpdb;
      $galleries = $wpdb->get_results(
        '
        SELECT *
        FROM ' . $wpdb->prefix . "vimeography_gallery_meta" . ' AS meta
        JOIN ' . $wpdb->prefix . "vimeography_gallery" . ' AS gallery
        ON meta.gallery_id = gallery.id;
        '
      );

      if ( is_array($galleries) ) {
        foreach ($galleries as $gallery) {
          $wpdb->insert(
            VIMEOGRAPHY_PRO_TABLE,
            array(
              'gallery_id' => $gallery->gallery_id,
              'per_page'   => 20,
              'sort'       => 'default',
              'playlist'   => 0
            ),
            array('%d', '%d', '%s', '%d')
          );
        }
      }
    }
  }

  /**
   * Adds an `enable_downloads` bool value to each gallery, which specifies
   * if the theme should render download links for each video.
   *
   * @return bool
   * @since 0.9
   */
  public static function vimeography_pro_update_db_to_0_9() {
    if ( version_compare(self::$_vimeography_pro_db_version, '0.9', '<') ) {
      global $wpdb;
      $wpdb->hide_errors();

      return $wpdb->query('ALTER TABLE '.VIMEOGRAPHY_PRO_TABLE.' ADD allow_downloads TINYINT(1) NOT NULL DEFAULT 0 AFTER playlist;');
    }
  }


  /**
   * Adds a `direction` varchar value to each gallery, which specifies
   * if the request to Vimeo should retrieve the videos in ascending
   * or descending order.
   *
   * @return bool
   * @since 1.0
   */
  public static function vimeography_pro_update_db_to_1_0() {
    if ( version_compare(self::$_vimeography_pro_db_version, '1.0', '<') ) {
      global $wpdb;
      $wpdb->hide_errors();

      return $wpdb->query('ALTER TABLE '.VIMEOGRAPHY_PRO_TABLE.' ADD direction varchar(10) NOT NULL DEFAULT "desc" AFTER sort;');
    }
  }

}