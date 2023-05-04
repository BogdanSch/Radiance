<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_image_source = get_option('wpaicg_image_source','');
$wpaicg_featured_image_source = get_option('wpaicg_featured_image_source','');
?>
<div id="tabs-5">
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('Image Source','gpt3-ai-content-generator')?>:</label>
        <select class="regular-text" id="label_img_size" name="wpaicg_image_source" >
            <option value=""><?php echo esc_html__('None','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_image_source == 'dalle' ? ' selected':''?> value="dalle"><?php echo esc_html__('DALL-E','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_image_source == 'pexels' ? ' selected':''?> value="pexels"><?php echo esc_html__('Pexels','gpt3-ai-content-generator')?></option>
        </select>
    </div>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('Featured Image Source','gpt3-ai-content-generator')?>:</label>
        <select class="regular-text" id="label_img_size" name="wpaicg_featured_image_source" >
            <option value=""><?php echo esc_html__('None','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_featured_image_source == 'dalle' ? ' selected':''?> value="dalle"><?php echo esc_html__('DALL-E','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_featured_image_source == 'pexels' ? ' selected':''?> value="pexels"><?php echo esc_html__('Pexels','gpt3-ai-content-generator')?></option>
        </select>
    </div>
    <hr>
    <div class="wpcgai_form_row">
        <p><b><?php echo esc_html__('DALL-E','gpt3-ai-content-generator')?></b></p>
        <label class="wpcgai_label"><?php echo esc_html__('Image Size','gpt3-ai-content-generator')?>:</label>
        <select class="regular-text" id="label_img_size" name="wpaicg_settings[img_size]" >
            <option value="256x256" <?php
            echo  ( esc_html($existingValue['img_size']) == '256x256' ? 'selected' : '' ) ;
            ?>><?php echo esc_html__('Small (256x256)','gpt3-ai-content-generator')?></option>
            <option value="512x512" <?php
            echo  ( esc_html( $existingValue['img_size'] ) == '512x512' ? 'selected' : '' ) ;
            ?>><?php echo esc_html__('Medium (512x512)','gpt3-ai-content-generator')?></option>
            <option value="1024x1024" <?php
            echo  ( esc_html( $existingValue['img_size'] ) == '1024x1024' ? 'selected' : '' ) ;
            ?>><?php echo esc_html__('Big (1024x1024)','gpt3-ai-content-generator')?></option>
        </select>
        <a class="wpcgai_help_link" href="https://aipower.org/dall-e-image-size/" target="_blank">?</a>
    </div>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('Style','gpt3-ai-content-generator')?>:</label>
        <?php
        $_wpaicg_image_style = get_option( '_wpaicg_image_style', '' );
        ?>
        <select class="regular-text" id="label_img_style" name="_wpaicg_image_style" >
            <option value=""><?php echo esc_html__('None','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'abstract' ? ' selected' : '' ) ;
            ?> value="abstract"><?php echo esc_html__('Abstract','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'modern' ? ' selected' : '' ) ;
            ?> value="modern"><?php echo esc_html__('Modern','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'impressionist' ? ' selected' : '' ) ;
            ?> value="impressionist"><?php echo esc_html__('Impressionist','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'popart' ? ' selected' : '' ) ;
            ?> value="popart"><?php echo esc_html__('Pop Art','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'cubism' ? ' selected' : '' ) ;
            ?> value="cubism"><?php echo esc_html__('Cubism','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'surrealism' ? ' selected' : '' ) ;
            ?> value="surrealism"><?php echo esc_html__('Surrealism','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'contemporary' ? ' selected' : '' ) ;
            ?> value="contemporary"><?php echo esc_html__('Contemporary','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'cantasy' ? ' selected' : '' ) ;
            ?> value="cantasy"><?php echo esc_html__('Fantasy','gpt3-ai-content-generator')?></option>
            <option<?php
            echo  ( esc_html( $_wpaicg_image_style ) == 'graffiti' ? ' selected' : '' ) ;
            ?> value="graffiti"><?php echo esc_html__('Graffiti','gpt3-ai-content-generator')?></option>
        </select>
        <a class="wpcgai_help_link" href="https://aipower.org/customizing-dall-e-generated-images-with-the-art-style-feature/" target="_blank">?</a>
    </div>
    <?php
    $wpaicg_art_file = WPAICG_PLUGIN_DIR . 'admin/data/art.json';

    $wpaicg_painter_data = file_get_contents($wpaicg_art_file);
    $wpaicg_painter_data = json_decode($wpaicg_painter_data, true);

    $wpaicg_style_data = file_get_contents($wpaicg_art_file);
    $wpaicg_style_data = json_decode($wpaicg_style_data, true);

    $wpaicg_photo_file = WPAICG_PLUGIN_DIR . 'admin/data/photo.json';

    $wpaicg_photo_data = file_get_contents($wpaicg_photo_file);
    $wpaicg_photo_data = json_decode($wpaicg_photo_data, true);
    $wpaicg_custom_image_settings = get_option('wpaicg_custom_image_settings',[]);
    ?>
    <div class="wpaicg_more_image_settings" style="display: none">
        <div class="wpcgai_form_row">
            <label for="artist" class="wpcgai_label"><?php echo esc_html__('Artist','gpt3-ai-content-generator')?>:</label>
            <select class="regular-text" name="wpaicg_custom_image_settings[artist]" id="artist">
                <?php
                foreach ($wpaicg_painter_data['painters'] as $key => $value) {
                    echo '<option'.((isset($wpaicg_custom_image_settings['artist']) && $wpaicg_custom_image_settings['artist'] == $value) || (!isset($wpaicg_custom_image_settings['artist']) && $value) == 'None' ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="wpcgai_form_row">
            <label for="photography_style" class="wpcgai_label"><?php echo esc_html__('Photography','gpt3-ai-content-generator')?>:</label>
            <select class="regular-text" name="wpaicg_custom_image_settings[photography_style]" id="photography_style">
            <?php
            foreach ($wpaicg_photo_data['photography_style'] as $key => $value) {
                echo '<option'.((isset($wpaicg_custom_image_settings['photography_style']) && $wpaicg_custom_image_settings['photography_style'] == $value) || (!isset($wpaicg_custom_image_settings['photography_style']) && $value == 'Landscape') ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            ?>
            </select>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="lighting" class="wpcgai_label">'.esc_html__('Lighting','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[lighting]" id="lighting">'."\n";
            foreach ($wpaicg_photo_data['lighting'] as $key => $value) {
                echo '<option'.(isset($wpaicg_custom_image_settings['lighting']) && $wpaicg_custom_image_settings['lighting'] == $value ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="subject" class="wpcgai_label">'.esc_html__('Subject','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[subject]" id="subject">'."\n";
            foreach ($wpaicg_photo_data['subject'] as $key => $value) {
                echo '<option'.((isset($wpaicg_custom_image_settings['subject']) && $wpaicg_custom_image_settings['subject'] == $value) || (!isset($wpaicg_custom_image_settings['subject']) && $value == 'None') ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="camera_settings" class="wpcgai_label">'.esc_html__('Camera','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[camera_settings]" id="camera_settings">'."\n";
            foreach ($wpaicg_photo_data['camera_settings'] as $key => $value) {
                echo '<option'.(isset($wpaicg_custom_image_settings['camera_settings']) && $wpaicg_custom_image_settings['camera_settings'] == $value ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="composition" class="wpcgai_label">'.esc_html__('Composition','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[composition]" id="composition">'."\n";
            foreach ($wpaicg_photo_data['composition'] as $key => $value) {
                echo '<option'.(isset($wpaicg_custom_image_settings['composition']) && $wpaicg_custom_image_settings['composition'] == $value ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="resolution" class="wpcgai_label">'.esc_html__('Resolution','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[resolution]" id="resolution">'."\n";
            foreach ($wpaicg_photo_data['resolution'] as $key => $value) {
                echo '<option'.(isset($wpaicg_custom_image_settings['resolution']) && $wpaicg_custom_image_settings['resolution'] == $value ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="color" class="wpcgai_label">'.esc_html__('Color','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[color]" id="color">'."\n";
            foreach ($wpaicg_photo_data['color'] as $key => $value) {
                echo '<option'.(isset($wpaicg_custom_image_settings['color']) && $wpaicg_custom_image_settings['color'] == $value ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="wpcgai_form_row">
            <?php
            echo '<label for="special_effects" class="wpcgai_label">'.esc_html__('Special Effects','gpt3-ai-content-generator').':</label>'."\n";
            echo '<select class="regular-text" name="wpaicg_custom_image_settings[special_effects]" id="special_effects">."\n"';
            foreach ($wpaicg_photo_data['special_effects'] as $key => $value) {
                echo '<option'.(isset($wpaicg_custom_image_settings['special_effects']) && $wpaicg_custom_image_settings['special_effects'] == $value ? ' selected':'').' value="' . esc_html($value) . '">' . esc_html($value) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
    </div>
    <div class="mb-5">
        <a href="javascript:void(0)" class="wpaicg_show_image_settings">[<?php echo esc_html__('+ More Settings','gpt3-ai-content-generator')?>]</a>
    </div>
    <script>
        jQuery(document).ready(function ($){
            $('.wpaicg_show_image_settings').click(function (){
                $(this).toggleClass('wpaig_opened');
                $('.wpaicg_more_image_settings').slideToggle();
                if($(this).hasClass('wpaig_opened')){
                    $(this).html('[<?php echo esc_html__('- Hide Settings','gpt3-ai-content-generator')?>]');
                }
                else{
                    $(this).html('[<?php echo esc_html__('+ More Settings','gpt3-ai-content-generator')?>]');
                }
            })
        })
    </script>
    <?php
    $wpaicg_sd_api_key = get_option('wpaicg_sd_api_key','');
    ?>
    <hr>
    <p><b><?php echo esc_html__('Stable Diffusion','gpt3-ai-content-generator')?> 🚀🚀🚀</b></p>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('API Key','gpt3-ai-content-generator')?>:</label>
        <input value="<?php echo esc_html($wpaicg_sd_api_key)?>" type="text" class="regular-text" name="wpaicg_sd_api_key">
        <a class="wpcgai_help_link" href="https://replicate.com/account" target="_blank"><?php echo esc_html__('Get API Key','gpt3-ai-content-generator')?></a>
    </div>
    <?php
    $wpaicg_sd_api_version = get_option('wpaicg_sd_api_version','');
    ?>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('Version','gpt3-ai-content-generator')?>:</label>
        <input value="<?php echo esc_html($wpaicg_sd_api_version)?>" type="text" class="regular-text" name="wpaicg_sd_api_version" placeholder="<?php echo esc_html__('Leave blank for default','gpt3-ai-content-generator')?>">
    </div>
    <hr>
    <p><b><?php echo esc_html__('Pexels','gpt3-ai-content-generator')?></b></p>
    <?php
    $wpaicg_pexels_api = get_option('wpaicg_pexels_api','');
    $wpaicg_pexels_orientation = get_option('wpaicg_pexels_orientation','');
    $wpaicg_pexels_size = get_option('wpaicg_pexels_size','');
    ?>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('API Key','gpt3-ai-content-generator')?>:</label>
        <input value="<?php echo esc_html($wpaicg_pexels_api)?>" type="text" class="regular-text" name="wpaicg_pexels_api">
        <a class="wpcgai_help_link" href="https://www.pexels.com/api/new/" target="_blank"><?php echo esc_html__('Get API Key','gpt3-ai-content-generator')?></a>
    </div>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('Orientation','gpt3-ai-content-generator')?>:</label>
        <select class="regular-text" id="label_img_size" name="wpaicg_pexels_orientation" >
            <option value=""><?php echo esc_html__('None','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_pexels_orientation == 'landscape' ? ' selected':''?> value="landscape"><?php echo esc_html__('Landscape','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_pexels_orientation == 'portrait' ? ' selected':''?> value="portrait"><?php echo esc_html__('Portrait','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_pexels_orientation == 'square' ? ' selected':''?> value="square"><?php echo esc_html__('Square','gpt3-ai-content-generator')?></option>
        </select>
    </div>
    <div class="wpcgai_form_row">
        <label class="wpcgai_label"><?php echo esc_html__('Size','gpt3-ai-content-generator')?>:</label>
        <select class="regular-text" id="label_img_size" name="wpaicg_pexels_size" >
            <option value=""><?php echo esc_html__('None','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_pexels_size == 'large' ? ' selected':''?> value="large"><?php echo esc_html__('Large','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_pexels_size == 'medium' ? ' selected':''?> value="medium"><?php echo esc_html__('Medium','gpt3-ai-content-generator')?></option>
            <option<?php echo $wpaicg_pexels_size == 'small' ? ' selected':''?> value="small"><?php echo esc_html__('Small','gpt3-ai-content-generator')?></option>
        </select>
    </div>
    <div class="wpcgai_form_row">
        <hr>
        <p><b><?php echo esc_html__('Shortcodes','gpt3-ai-content-generator')?></b></p>
        <p><?php echo esc_html__('Copy and paste the following shortcode into your post or page to display the image generator','gpt3-ai-content-generator')?>.</p>
        <p><?php echo sprintf(esc_html__('If you want to display both DALL-E and Stable Diffusion, use: %s','gpt3-ai-content-generator'),'<code>[wpcgai_img]</code>')?></p>
        <p><?php echo sprintf(esc_html__('If you want to display only DALL-E, use: %s','gpt3-ai-content-generator'),'<code>[wpcgai_img dalle=yes]</code>')?></p>
        <p><?php echo sprintf(esc_html__('If you want to display only Stable Diffusion, use: %s','gpt3-ai-content-generator'),'<code>[wpcgai_img sd=yes]</code>')?></p>
        <p><?php echo sprintf(esc_html__('If you want to display the settings, use: %s or %s or %s','gpt3-ai-content-generator'),'<code>[wpcgai_img settings=yes]</code>','<code>[wpcgai_img dalle=yes settings=yes]</code>','<code>[wpcgai_img sd=yes settings=yes]</code>')?></p>
    </div>
</div>
