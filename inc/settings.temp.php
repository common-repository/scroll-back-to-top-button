<?php
$defaultSettings = $this->defail_settings;

$action = $_REQUEST['frm-action'];
if($action && $action == 'SCROLL_PAGE_TO_TOP_SETTINGS'){
    $response = $this->applyActions($_REQUEST['frm-action'],$_REQUEST);
}
$savedSettings = unserialize(get_option('_scroll_page_to_top_settings'));
?>
<div class="wrap">
    <?php if($response) { ?>
        <?php $_cls = ($response['status'] !== false)?'notice-success':'notice-error error'; ?>
        <div id="message" class="updated notice <?php echo $_cls;?> is-dismissible">
            <p><?php echo $response['msg']?></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
        </div>
    <?php } ?>
    <h1>Basic Settings</h1>

    <form method="post" action="">
        <input type="hidden" name="frm-action" value="SCROLL_PAGE_TO_TOP_SETTINGS" />
        <?php wp_nonce_field('SCROLL_PAGE_TO_TOP_SETTINGS'); ?>
        <table class="form-table">

            <tbody>
            <tr>
                <th scope="row"><label for="scroll_distance">Scroll Distance</label></th>
                <td>
                    <input name="scroll_distance" type="text" id="scroll_distance" value="<?php echo $savedSettings['scroll_distance']?>" class="regular-text"/>
                    <span>px</span>
                    <p class="description" id="scroll_distance_description">Distance from top/bottom before showing element (px).</p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="scroll_speed">Scroll Speed</label></th>
                <td>
                    <input name="scroll_speed" type="text" id="scroll_speed" value="<?php echo $savedSettings['scroll_speed']?>" class="regular-text"/>
                    <span>px</span>
                    <p class="description" id="scroll_speed_description">Speed back to top (ms).</p>
                </td>
            </tr>

            <tr>
                <th scope="row">Button Animation</th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span>Button Animation</span></legend>
                        <label>
                            <input type="radio" name="button_animation" value="fade" <?php if($savedSettings['button_animation']=='fade'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Fade</span>
                        </label><br>
                        <label>
                            <input type="radio" name="button_animation" value="slide" <?php if($savedSettings['button_animation']=='slide'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Slide</span>
                        </label><br>
                        <label>
                            <input type="radio" name="button_animation" value="none" <?php if($savedSettings['button_animation']=='none'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">None</span>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row">Button Position<br/><small>Select Scroll to up button position</small></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span>Button Position</span></legend>
                        <label>
                            <input type="radio" name="button_position" value="bottom_right" <?php if($savedSettings['button_position']=='bottom_right'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Bottom right</span>
                        </label><br>
                        <label>
                            <input type="radio" name="button_position" value="bottom_left" <?php if($savedSettings['button_position']=='bottom_left'){?> checked="checked"<?php }?>/>
                            <span class="date-time-text format-i18n">Bottom left</span>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="distance_from_left_right">Distance from left/right</label></th>
                <td>
                    <input name="distance_from_left_right" type="text" id="distance_from_left_right" value="<?php echo $savedSettings['distance_from_left_right']?>" class="regular-text"/>
                    <span>px</span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="distance_from_bottom">Distance from bottom</label></th>
                <td>
                    <input name="distance_from_bottom" type="text" id="distance_from_bottom" value="<?php echo $savedSettings['distance_from_bottom']?>" class="regular-text"/>
                    <span>px</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="wkc_icon_image_url">Icon Image URL</label></th>
                <td>
                    <input type="text" name="wkc_icon_image_url" id="wkc_icon_image_url" value="<?php echo $savedSettings['wkc_icon_image_url']?>" class="regular-text">
                    <input type="hidden" name="wkc_icon_image_id" id="wkc_icon_image_id" value="<?php echo $savedSettings['wkc_icon_image_id']?>" class="regular-text">
                    <a href="#" class="button csf-button" id="wkc_icon_image_uploader">Upload Image</a>
                    <p><img src="<?php echo $savedSettings['wkc_icon_image_url']?>" id="wkc_icon_image_preview" style="width: 25px;height: 25px;display: <?php echo (!empty($savedSettings['wkc_icon_image_url'])?'block':'none')?>;margin-top: 10px;"/></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="wkc_bga_color">Background Color</label></th>
                <td>
                    <input type="text" name="wkc_bga_color" id="wkc_bga_color" value="<?php echo $savedSettings['wkc_bga_color']?>" class="wkc-color-picker" >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="wkc_hover_bga_color">Hover Background Color</label></th>
                <td>
                    <input type="text" name="wkc_hover_bga_color" id="wkc_hover_bga_color" value="<?php echo $savedSettings['wkc_hover_bga_color']?>" class="wkc-color-picker" >
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            <input type="submit" name="scroll_page_to_top_resetall" id="scroll_page_to_top_resetall" class="button button-primary" value="Reset All Options" onclick="return confirm('Are you sure you would like to reset all options?');"/>
            <style type="text/css">
                .wp-core-ui .button-primary#scroll_page_to_top_resetall {
                    background: #e14d43!important;
                    color: #fff;
                    border-color: #d02c21 #ba281e #ba281e!important;
                    box-shadow: 0 1px 0 #e14d43!important;
                    color: #fff;
                    text-decoration: none;
                    text-shadow: 0 -1px 1px #e14d43, 1px 0 1px #e14d43, 0 1px 1px #e14d43, -1px 0 1px #e14d43;
                }
            </style>
        </p>
    </form>
    <script>
        jQuery(document).ready(function() {
            $( '.wkc-color-picker' ).wpColorPicker();

            var custom_file_frame;
            jQuery(document).on("click", "#wkc_icon_image_uploader", function(event) {
                event.preventDefault();
                if (typeof(custom_file_frame)!=="undefined") {
                    custom_file_frame.close();
                }

                //Create WP media frame.
                custom_file_frame = wp.media.frames.customHeader = wp.media({
                    //Title of media manager frame
                    title: "Media Uploader",
                    library: {
                        type: "image"
                    },
                    button: {
                        //Button text
                        text: "Select"
                    },
                    //Do not allow multiple files, if you want multiple, set true
                    multiple: false
                });

                //callback for selected image
                custom_file_frame.on("select", function() {
                    var attachment = custom_file_frame.state().get("selection").first().toJSON();
                    //do something with attachment variable, for example attachment.filename
                    //console.log(attachment);
                    if(attachment.id && attachment.url){
                        $('#wkc_icon_image_id').val(attachment.id);
                        $('#wkc_icon_image_url').val(attachment.url);
                        $('#wkc_icon_image_preview').attr('src',attachment.url).fadeIn(400);
                    }
                });
                //Open modal
                custom_file_frame.open();
            });
        });
    </script>
</div>