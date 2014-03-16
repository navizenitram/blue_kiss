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
$aMetas['title'] = 'View Image';


$oViewimage = new cViewimage($_GET['image'],UPLOAD_FOLDER);
$sTitle = $_GET['image'];
$url    = $oViewimage->getUrl();

/**
 * Display HTML
 */
include 'templates/t_viewimage.php';
?>
