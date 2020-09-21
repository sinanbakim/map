<?php
spl_autoload_register(function($className) {
    $file = __DIR__. '\\..\\src\\' . $className . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
//    echo $file;
//    print_r([__LINE__,
//        __FILE__,
//        __DIR__,
//        __FUNCTION__,
//        __CLASS__,
//        __TRAIT__,
//        __METHOD__,
//        __NAMESPACE__]);
    if (file_exists($file)) {
        include_once $file;
    }
});
?>