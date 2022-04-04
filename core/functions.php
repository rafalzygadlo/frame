<?php


function _404()
{
    $view = new \Lib\View("404", null, true);
    $view->Render();
    
}

function error($msg)
{
    print "<h3>".$msg."</h3>";
    exit;
}
