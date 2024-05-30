<?php


function head($headName)
{
    echo '
        <!DOCTYPE>
        <html lang="zxx">
            <head>
                <meta charset="utf-8" /><title>' . $headName . '</title>
                <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
                <link rel="stylesheet" type="text/css" href="/style.css">
            </head>
        <body> 
        <a href="/"><div class="fonLink"></div></a>
        ';
}

?>