<?php
/*
Plugin Name: Breadcrumbs
Plugin URI: https://example.com/
Description: Breadcrumbs, navigation scheme
Version: 1.0
Author: Bohdan Shcherbak
Author URI: https://example.com/
License: GPL2
*/
if (!function_exists('add_action')) {
    echo "Hi there! I'm just a plugin, no much I can do when called directly.";
    exit;
}
function breadcrumbs()
{
    if (!is_front_page()) {
        echo '<section class="breadcrumbs">
        <div class="container"><ol>';
        echo '<li class=""><a href="';
        echo get_option('home');
        echo '">' . __("Home") . '</a></li>';
        if (is_category() || is_single()) {
            ?>
            <li>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php echo get_the_title(get_option('page_for_posts', true)); ?></a>
            </li>
            <?php if (is_category()) {
                $category = get_queried_object();
                if ($category instanceof WP_Term) {
                    $category_name = $category->name;
                    _e("<li>$category_name</li>");
                }
            } ?>
            <?php
            if (is_single()) {
                echo '<li class="active">';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            echo '<li class="active">';
            echo the_title();
            echo '</li>';
        } elseif (is_home()) {
            ?>
            <li>
                <?php echo get_the_title(get_option('page_for_posts', true)); ?>
            </li>
            <?php
        }
        echo '</ol></div></section>';
    }
}
add_action('wp_head', 'breadcrumbs');