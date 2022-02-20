<?php
function sendHeaders($file, $type = NULL, $name=NULL)
{
    if (empty($name))
    {
        $name = basename($file);
    }

    if (empty($type))
    {
        $type = "application/octet-stream";
    }
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Transfer-Encoding: binary');
    header('Content-Disposition: attachment; filename="'.$name.'";');
    header('Content-Type: ' . $type);
    header('Content-Length: ' . filesize($file));
}

// die(var_dump($_REQUEST));

$file = $_REQUEST['file'];

if (is_file($file))
{
    sendHeaders($file, mime_content_type($file));
    $chunkSize = 1024 * 1024;
    $handle = fopen($file, 'rb');
    while (!feof($handle))
    {
        $buffer = fread($handle, $chunkSize);
        echo $buffer;
        ob_flush();
        flush();
    }
    fclose($handle);
    exit;
}

echo $file;
echo 'Uploading file not found';

?>