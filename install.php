<?php
/* For license terms, see /license.txt */

require_once __DIR__.'/learningcoins_plugin.class.php';

if (!api_is_platform_admin()) {
    die('You must have admin permissions to install plugins');
}

LearningCoinsPlugin::create()->install();
