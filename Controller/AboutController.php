<?php
function About_Page($conn)
{
    $authors = get_all_authors($conn);
    require_once PATH_VIEW_CLIENT . 'about.php';
}
