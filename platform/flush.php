<?php
function flush_buffers()
{
    ob_end_flush();
    ob_flush();
    flush();
    ob_start();
} 
?>