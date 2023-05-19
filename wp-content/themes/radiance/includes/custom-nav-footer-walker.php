<?php
class Radiance_Nav_Footer_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '<ul class="dropdown-menu dropdown-menu-right">';
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);
        if ($item->is_dropdown && $depth === 0) {
            $item_html = str_replace('<a', '<i class="bi bi-chevron-right"></i><a class="nav-link dropdown-toggle" data-toggle="dropdown"', $item_html);
            $item_html = str_replace('</a>', '<b class="caret"></b></a>', $item_html);
        } elseif ($depth === 0) {
            $item_html = str_replace('<a', '<i class="bi bi-chevron-right"></i><a class="nav-link scrollto"', $item_html);
        } elseif ($depth === 1) {
            $item_html = str_replace('<a', '<i class="bi bi-chevron-right"></i><a class="dropdown-item"', $item_html);
        }
        $output .= $item_html;
    }

    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if ($element->current) {
            $element->classes[] = 'active';
        }

        $element->is_dropdown = !empty($children_elements[$element->ID]);
        if ($element->is_dropdown) {
            if ($depth === 0) {
                $element->classes[] = 'nav-item dropdown';
            } elseif ($depth === 1) {
                $element->classes[] = 'dropdown-submenu';
            }
        } else {
            if ($depth === 0) {
                $element->classes[] = 'nav-item';
            }
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    public function end_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $output .= '</li>';
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= '</ul>';
    }
}