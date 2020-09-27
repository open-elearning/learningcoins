<?php
/* For licensing terms, see /license.txt */

require_once __DIR__.'/../../main/inc/global.inc.php';
require_once __DIR__.'/learningcoins_plugin.class.php';

$language = 'en';
$platformLanguage = api_get_interface_language();
$iso = api_get_language_isocode($platformLanguage);

if (!api_is_anonymous()) {
    $user = api_get_user_info();
} else {
    header('Location: '.api_get_path(WEB_PATH));
    exit;
}

//$logInfo = [
    //'tool' => 'learningcoins',
//];
//Event::registerLog($logInfo);

$plugin = LearningCoinsPlugin::create();
$tool_name = $plugin->get_lang('plugin_title');
$tpl = new Template($tool_name);

$userId = $user['id'];
$version = 7;
$content = '';

$action = isset($_GET['action']) ? Security::remove_XSS($_GET['action']) : '';

$urlId = api_get_current_access_url_id();
$UrlWhere = '';
if ((api_is_platform_admin() || api_is_session_admin()) && api_get_multiple_access_url()) {
    $UrlWhere = " AND url_id = $urlId ";
}

$sql = "SELECT SUM(value_coin) as total FROM ".$plugin->table.
    " WHERE user_id = $userId AND (used = 0 OR used IS NULL ) $UrlWhere";

$totalCoins = 0;
$result = Database::query($sql);
while ($row = Database::fetch_array($result)){        
    $totalCoins = $row["total"];
}

include( __DIR__.'/resources/body/body-a.php');

$content = $tpl->fetch('learningcoins/view/template.tpl');

$tpl = new Template('LearningCoins');

$tpl->assign('content', $bodyLearningCoins);

$tpl->display_one_col_template();
