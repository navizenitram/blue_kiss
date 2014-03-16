<?php
/**
 * View images
 * Created: 2014-03-15
 * 
 * @author Iván Martínez <ivan.martinezca@gmail.com>
 */

include 'clases/cViewimage.php';
include 'config/config.php';

/**
 * Set METAS
 */
$oViewimage = new cViewimage($_GET['image'],UPLOAD_FOLDER);
$sTitle = $_GET['image'];
$url    = $oViewimage->getUrl();
/**
 * Display HTML
 */
if(empty($url)) {
    $aMetas['title'] = 'Image not found';
    header("HTTP/1.0 404 Not Found");
    include 'templates/t_error404.php';
} else {
    $aMetas['title'] = 'View Image';
    include 'templates/t_viewimage.php';
}
?>
