<?php

function add_nav_menus()
{
    $args = array(
        'primary' => __('Primary Menu', 'FundraiserByNorts'),
        'secondary' => __('Secondary Menu', 'FundraiserByNorts'),
        'footer' => __('Footer Menu', 'FundraiserByNorts')
    );
    register_nav_menus($args);
}
add_action('init', 'add_nav_menus');
