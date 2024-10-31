<?php
/*
Plugin Name: Scroll Back To Top Button
Plugin URI: https://wordpress.org/plugins/scroll-back-to-top-button/
Description: Scroll Back To Top Button is a lightweight plugin that helps to add "Scroll to top / Back to top / Scroll page to top" feature in your WordPres site.
Author: Web Design Cochin
Version: 1.0
Author URI: http://www.webdesigncochin.in/
Text Domain: scroll-back-to-top-button
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function scroll_page_to_top_scripts(){
    wp_enqueue_script( 'scroll_page_to_top_js',  plugin_dir_url(__FILE__).'js/jquery.scrollUp.min.js', array('jquery'), '2.4.1', true );
}
add_action('wp_enqueue_scripts','scroll_page_to_top_scripts');

require_once plugin_dir_path( __FILE__ ) .'inc/settings.class.php';

add_action('wp_head','scroll_page_to_top_styles');
function scroll_page_to_top_styles(){
    $ScrollSettings = unserialize(get_option('_scroll_page_to_top_settings'));
    ?>
    <style type="text/css">
        #wkc_scroll_page_to_top {
            width:25px;
            height:25px;
            text-align:center;
            border-radius:100px;
            background-color:<?php echo $ScrollSettings['wkc_bga_color']?>;
            padding:1px;
        }
        #wkc_scroll_page_to_top:hover{
            background-color:<?php echo $ScrollSettings['wkc_hover_bga_color']?>;
        }
        <?php
        switch ($ScrollSettings['button_position']){
            case 'bottom_right' :{
                echo '#wkc_scroll_page_to_top {bottom: 20px;right: 20px;}';
                break;
            }
            case 'bottom_left' :{
                echo '#wkc_scroll_page_to_top {bottom: 20px;left: 20px;}';
                break;
            }
        }
        ?>
        #wkc_scroll_page_to_top{
        <?php
            if($ScrollSettings['button_position'] == 'bottom_right'){
                echo "right: {$ScrollSettings['distance_from_left_right']}px;";
                echo "bottom: {$ScrollSettings['distance_from_bottom']}px;";
            }else if($ScrollSettings['button_position'] == 'bottom_left'){
                echo "left: {$ScrollSettings['distance_from_left_right']}px;";
                echo "bottom: {$ScrollSettings['distance_from_bottom']}px;";
            }
        ?>
        }
    </style>
    <?php
}

function scroll_page_to_top_apply(){ ?>
    <script type="text/javascript">
        <?php $ScrollSettings = unserialize(get_option('_scroll_page_to_top_settings')); ?>
        jQuery(document).ready(function($) {
            $.scrollUp({
                scrollName: 'wkc_scroll_page_to_top',// Element ID
                scrollDistance: <?php echo $ScrollSettings['scroll_distance']; ?>,
                scrollFrom: 'top',           // 'top' or 'bottom'
                scrollSpeed: <?php echo $ScrollSettings['scroll_distance']; ?>,
                easingType: 'linear',// Scroll to top easing (see http://easings.net/)
                animation: '<?php echo $ScrollSettings['button_animation']; ?>',// Fade, slide, none
                animationSpeed: <?php echo $ScrollSettings['scroll_speed']; ?>,
                scrollTrigger: false,
                scrollTarget: false,
                scrollText: "<?php
                        if($ScrollSettings['wkc_icon_image_url'] && !empty($ScrollSettings['wkc_icon_image_url'])){
                            echo "<img src='".$ScrollSettings['wkc_icon_image_url']."' alt=''/>";
                        }
                        else echo "<img src='". esc_url( plugins_url( 'img/top-arrow.png', __FILE__ ) ) ."' alt=''/>";
                    ?>", // Text for element, can contain HTML
                scrollTitle: false,          // Set a custom <a> title if required.
                scrollImg: false,            // Set true to use image
                activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
                zIndex: 2147483647           // Z-Index for the overlay
            });
        });
    </script>
<?php }
add_action('wp_footer','scroll_page_to_top_apply');
