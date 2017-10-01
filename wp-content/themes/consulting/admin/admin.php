<?php

$includes = get_template_directory() . '/admin/includes/';
define('STM_ITEM_NAME', 'Consulting');

/*Connect Envato market plugin.*/
if(!class_exists('Envato_Market')) {
	require_once($includes . '/envato-market/envato-market.php');
}

require_once $includes . 'theme.php';
require_once $includes . 'admin_screens.php';

$tr = get_site_transient('update_themes');