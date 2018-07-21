<?php
/**
 * Created by PhpStorm.
 * User: abderrahimelimame
 * Date: 8/20/16
 * Time: 08:10
 */
if (!file_exists('core/db_config.php')) {
    header('Location: install/index.php');
    exit;
}else{
    header('Location: /admin/index.php');
    exit;
}