<?php
/**
 * Created by RPS Team
 * User: RPS
 * Date: 8/13/2018
 * Time: 9:42 AM
 */

class SCROLL_TO_TOP_SETTINGS
{
    private $defail_settings;
    function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts',array( $this, 'wkc_scroll_to_top_add_color_picker' ));
        $this->defail_settings = array(
            'scroll_distance' => '300',
            'scroll_speed' => '300',
            'button_animation' => 'fade',
            'button_position' => 'bottom_right',
            'distance_from_left_right' => '20',
            'distance_from_bottom' => '20',
            'wkc_icon_image_url' => '',
            'wkc_icon_image_id' => '',
            'wkc_bga_color' => '#95beea',
            'wkc_hover_bga_color' => '#95beea',
        );
        add_action( 'activated_plugin', array($this, 'add_plugin_default_settings') );
    }
    public function wkc_scroll_to_top_add_color_picker( $hook ) {
        if( is_admin() ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );
            if ( ! did_action( "wp_enqueue_media" ) )
                wp_enqueue_media();
        }
    }
    public function add_plugin_default_settings(){
        if(!get_option('_scroll_page_to_top_settings')){
            update_option('_scroll_page_to_top_settings',serialize($this->defail_settings));
        }
    }

    function admin_menu() {
        add_options_page(
            'Scroll Back To Top',
            'Scroll Back To Top',
            'manage_options',
            'scroll_back_to_top_button',
            array(
                $this,
                'settings_page_callback'
            )
        );
    }

    function  settings_page_callback() {
        include_once "settings.temp.php";
    }
    public function applyActions($action,$data){
        if(empty($action)) return array('status'=>false,'msg'=>"Error occurred! Form has no action.");
        if($action == 'SCROLL_PAGE_TO_TOP_SETTINGS'){
            $_scroll_to_top_settings = [];
            $is_nonce_valid = ( isset( $data['_wpnonce'] ) && wp_verify_nonce( $data['_wpnonce'], $action) ) ? true : false;
            if(!$is_nonce_valid) return array('status'=>false,'msg'=>"Error occurred! Failed security check.");
            if($data['scroll_page_to_top_resetall'] && $data['scroll_page_to_top_resetall'] == "Reset All Options"){
                $data = $this->defail_settings;
            }
            $_scroll_to_top_settings['scroll_distance'] = $data['scroll_distance'];
            $_scroll_to_top_settings['scroll_speed'] = $data['scroll_speed'];
            $_scroll_to_top_settings['button_animation'] = $data['button_animation'];
            $_scroll_to_top_settings['button_position'] = $data['button_position'];
            $_scroll_to_top_settings['distance_from_left_right'] = $data['distance_from_left_right'];
            $_scroll_to_top_settings['distance_from_bottom'] = $data['distance_from_bottom'];
            $_scroll_to_top_settings['wkc_icon_image_url'] = $data['wkc_icon_image_url'];
            $_scroll_to_top_settings['wkc_icon_image_id'] = $data['wkc_icon_image_id'];
            $_scroll_to_top_settings['wkc_bga_color'] = $data['wkc_bga_color'];
            $_scroll_to_top_settings['wkc_hover_bga_color'] = $data['wkc_hover_bga_color'];

            update_option('_scroll_page_to_top_settings',serialize($_scroll_to_top_settings));
            return array('status'=>true,'msg'=>"Settings saved.");
        }
        return array('status'=>false,'msg'=>"Error occurred!");
    }
}

new SCROLL_TO_TOP_SETTINGS();