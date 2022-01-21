<?php

function listFoldersFiles($dir)
{
    $files = array();

    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file !== '.' && $file !== '..') {
                    if (is_dir($dir . $file)) {
                        $files = array_merge($files, listFoldersFiles($dir . $file . '/'));
                    } else {
                        $files[] = $dir . $file;
                    }
                }
            }
            closedir($dh);
        }
    }

    return $files;
}


$files = listFoldersFiles('../');

foreach ($files as $file) {
    echo $file ;
    echo '<a href="/app1/download.php?file='.$file.'" target="_blank">baixar</a>';
    echo  '<br>';
}