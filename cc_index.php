<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';

// Изменения:
if (!empty($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localdomain') === FALSE) {
    // Parse the json file with ADDONS credentials
    $string = file_get_contents($_ENV['CRED_FILE'], false);

    if ($string == false) {
        die('FATAL: Could not read credentials file');
    }

    $creds = json_decode($string, true);

    // Now getenv('APPLICATION_ENV') should work:
    $entryScript = $creds['CONFIG']['CONFIG_VARS']['APPLICATION_ENV'];

} else {
    $entryScript = 'development';
}

$config = dirname(__FILE__) . '/protected/config/' . $entryScript . '.php';
// $config=dirname(__FILE__).'/protected/config/main.php'; // изменения

// remove the following lines when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true); // уберем для продакшена
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
