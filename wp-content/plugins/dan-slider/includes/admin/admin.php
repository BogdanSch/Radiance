<?php
// create custom plugin settings menu
// add_action('admin_menu', 'kc_create_menu');
function kc_create_menu()
{
    //create new top-level menu
    add_menu_page('Dan Slider Plugin Settings', 'Dan Slider', 'administrator', __FILE__, 'kc_settings_page', plugins_url('/images/icon.png', __FILE__));
    //call register settings function
    add_action('admin_init', 'register_mysettings');
}
function register_mysettings()
{
    //register our settings
    register_setting('kc-settings-group', 'kc_post_type');
    register_setting('kc-settings-group', 'kc_category_name');
    register_setting('kc-settings-group', 'kc_bg_color');
    register_setting('kc-settings-group', 'image_attachment_id');
    register_setting('kc-settings-group', 'kc_background_type');
    register_setting('kc-settings-group', 'kc_default_background_type');
    register_setting('kc-settings-group', 'kc_text_color');
    register_setting('kc-settings-group', 'kc_tag');
    register_setting('kc-settings-group', 'kc_count');

    add_settings_section('bg_settings', 'Background settings', '', 'bg_settings_page');
    add_settings_field('kc_background_type', 'Background type', 'kc_background_type', 'bg_settings_page', 'bg_settings');
    add_settings_field('kc_default_background_type', 'Default background type', 'kc_default_background_type', 'bg_settings_page', 'bg_settings');
    add_settings_field('custom_img_field', 'Background custom image', 'kc_bg_custom_img', 'bg_settings_page', 'bg_settings');
    add_settings_field('custom_color_field', 'Background custom color', 'kc_bg_custom_color', 'bg_settings_page', 'bg_settings');

    add_settings_section('other_settings', 'Other settings', '', 'other_settings_page');
    add_settings_field('post_type_field', 'Post type', 'kc_post_type', 'other_settings_page', 'other_settings');
    add_settings_field('category_name_field', 'Categoty name', 'kc_catergory_name', 'other_settings_page', 'other_settings');
    add_settings_field('text_color_field', 'Text color', 'kc_text_color', 'other_settings_page', 'other_settings');
    add_settings_field('posts_tag_field', 'Posts tag', 'kc_tag', 'other_settings_page', 'other_settings');
    add_settings_field('posts_count_field', 'Posts count', 'kc_count', 'other_settings_page', 'other_settings');
?>
<?php
}
function kc_background_type()
{
?>
    <select name="kc_background_type">
        <?php
        echo '<option value="post_image" ' . selected(get_option('kc_background_type'), 'post_image') . '>Post image</option>';
        echo '<option value="custom_image" ' . selected(get_option('kc_background_type'), 'custom_image') . '>Custom image</option>';
        echo '<option value="custom_color" ' . selected(get_option('kc_background_type'), 'custom_color') . '>Custom color</option>';
        ?>
    </select>
<?php
}

function kc_default_background_type()
{
?>
    <select name="kc_default_background_type">
        <?php
        echo '<option value="default_image" ' . selected(get_option('kc_default_background_type'), 'default_image') . '>Default image</option>';
        echo '<option value="default_color" ' . selected(get_option('kc_default_background_type'), 'default_color') . '>Default color</option>';
        ?>
    </select>
<?php
}
function kc_bg_custom_color()
{
?>
    <input id="custom_color" type="color" name="kc_bg_color" value="<?php echo get_option('kc_bg_color'); ?>" />
<?php
}
function kc_bg_custom_img()
{
?>
    <input id="image_attachment_id" name="image_attachment_id" value="<?php echo get_option('image_attachment_id'); ?>" type="hidden" />
    <div id="IMAGE_PLACEHOLDER_ID">
        <?php echo wp_get_attachment_image(get_option('image_attachment_id'), 'thumbnail', false, array('class' => 'custom_image')); ?>

    </div>
    <p>
        <button class="custom_image button button-secondary YOUR_OPEN_MEDIA_LIBRARY_BUTTON_CLASS" type="button" aria-label="<?php _e('Select'); ?>"><?php _e('Select'); ?></button>
        <button id="delete-link" class="custom_image button button-link button-link-delete YOUR_DELETE_BUTTON_CLASS" type="button" aria-label="<?php _e('Remove'); ?>"><?php _e('Remove'); ?></button>
    </p>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('YOUR_OPEN_MEDIA_LIBRARY_BUTTON_CLASS')) {
                const uploader = wp.media({
                        multiple: false
                    })
                    .on('select', function() {
                        const attachment = uploader.state().get('selection').first().toJSON();

                        document.getElementById('image_attachment_id').value = attachment.id;
                        document.getElementById('IMAGE_PLACEHOLDER_ID').innerHTML = '<img src="' + attachment.url + '" />';
                    })
                    .open(event.target);
            }

            if (event.target.classList.contains('YOUR_DELETE_BUTTON_CLASS')) {
                document.getElementById('image_attachment_id').value = 0;
                document.getElementById('IMAGE_PLACEHOLDER_ID').innerHTML = '';
            }
        }, false);
    </script>
<?php
}

function kc_post_type()
{
    $kc_post_types = get_post_types(['public' => true]);
    unset($kc_post_types['attachment']);
?>
    <select name="kc_post_type" id="kc_post_type">
        <?php foreach ($kc_post_types as $kc_post_type) {
            echo '<option value="' . $kc_post_type . '" ' . selected(get_option('kc_post_type'), $kc_post_type) . '>' . $kc_post_type . '</option>';
        }
        ?>
    </select>
<?php
}
function kc_catergory_name()
{
    $kc_categories = get_categories([
        'taxonomy' => 'category'
    ]);
?>
    <select name="kc_category_name" id="kc_category_name">
        <?php
        foreach ($kc_categories as $kc_category) {
            echo '<option value="' . $kc_category->name . '" ' . selected(get_option('kc_category_name'), $kc_category->name) . '>' . ($kc_category->name ? $kc_category->name : "none") . '</option>';
        }
        ?>
    </select>
<?php
}
function kc_text_color()
{
?>
    <input type="color" name="kc_text_color" value="<?php echo get_option('kc_text_color'); ?>" />
<?php
}
function kc_tag()
{
?>
    <input type="text" name="kc_tag" value="<?php echo get_option('kc_tag'); ?>" />
<?php
}
function kc_count()
{
?>
    <input type="number" name="kc_count" value="<?php echo get_option('kc_count'); ?>" min="1" max="12" />
<?php
}
function kc_settings_page()
{
?>
    <div class="wrap">
        <h2>Dan slider</h2>
        <form enctype="multipart/form-data" method="post" action="options.php">
            <?php
            wp_nonce_field('name_of_my_action', 'name_of_nonce_field');
            settings_fields('kc-settings-group');
            do_settings_sections('bg_settings_page');
            do_settings_sections('other_settings_page');
            submit_button();
            ?>
        </form>
    </div>
<?php
    if (isset($_POST['submit'])) {
        if (empty($_POST) || !wp_verify_nonce($_POST['name_of_nonce_field'], 'name_of_my_action')) {
            print 'Sorry, the verification data does not match.';
            exit;
        }
    }
}
?>