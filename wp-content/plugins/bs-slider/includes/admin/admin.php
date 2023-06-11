<?php
function bs_create_menu()
{
    add_menu_page('Boot Slider Plugin Settings', 'Boot Slider Settings', 'administrator', __FILE__, 'bs_settings_page', plugins_url('/images/icon.png', __FILE__));
    add_action('admin_init', 'register_settings');
}
function register_settings()
{
    register_setting('bs-settings-group', 'bs_post_type');
    register_setting('bs-settings-group', 'bs_category_name');
    register_setting('bs-settings-group', 'bs_tag');
    register_setting('bs-settings-group', 'bs_count');
}
function bs_settings_page()
{
    $bs_post_types = get_post_types(['public' => true]);
    unset($bs_post_types['attachment']);
    $bs_categories = get_categories([
        'taxonomy' => 'category'
    ]);
    $bs_categories["empty"]["name"] = "";
    ?>
    <div class="wrap">
        <h2>Boot Slider</h2>
        <form method="post" action="options.php">
            <?php settings_fields('bs-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Post Type</th>
                    <td>
                        <select name="bs_post_type" id="bs_post_type">
                            <?php foreach ($bs_post_types as $bs_post_type) {
                                echo '<option value="' . $bs_post_type . '" ' . selected(get_option('bs_post_type'), $bs_post_type) . '>' . $bs_post_type . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Category Name</th>
                    <td>
                        <select name="bs_category_name" id="bs_category_name">
                            <?php foreach ($bs_categories as $bs_category) {
                                echo '<option value="' . $bs_category->name . '" ' . selected(get_option('bs_category_name'), $bs_category->name) . '>' . ($bs_category->name ? $bs_category->name : "none") . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tags</th>
                    <td><input type="text" name="bs_tag" value="<?php echo get_option('bs_tag'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Count</th>
                    <td><input type="number" name="bs_count" value="<?php echo get_option('bs_count'); ?>" min="1"
                            max="12" /></td>
                </tr>

            </table>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>
<?php } ?>