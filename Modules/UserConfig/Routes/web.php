<?php

// supaya rapi

$dir   = base_path('Modules\UserConfig\Routes\web');

#Scan File To Dir
$files = scandir($dir);
$dirs = [];
foreach ($files as $k => $file) {
    if (!in_array($file, array('index.php')) && strpos($file, '.php') !== false) {
        require $dir . '/' . $file;
    }
    if (!in_array($file, array('.', '..')) && strpos($file, '.php') === false) {
        array_push($dirs, $file);
    }
};
if ($dirs != []) {
    readSubDir($dir, $dirs);
}
