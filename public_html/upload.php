<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
/**
 * Home page
 * Created: 2014-03-15
 * 
 * @author Iván Martínez <ivan.martinezca@gmail.com>
 */
include 'config/config.php';
include 'clases/cUpload.php';
include 'clases/cValidate.php';

/*
 * Set METAS
 */
$aMetas['title'] = 'Blue test Upload';
/**
 * Set BreadCrumb
 */
$aBreadcrumb = array(array('href'=>'index.php','value'=>'Home'));
/**
 * Main
 */
$aErrors = array();
$bError  = false;

if(!empty($_POST)){

    $oValidate =  new cValidate();
    
    $sPostFileName = $_POST['name'];
    $oValidate -> setField('name', $sPostFileName);
    
    
    if($oValidate->isValid()) {
        
        $oUpload   = new cUpload($_FILES['image']);
        $bUploaded = $oUpload->getError();
    
        if(!$bUploaded) {
            
            if($oUpload->saveFile($sPostFileName, UPLOAD_FOLDER)) {

                $bChanged   = $oUpload->isChange();
                $sFileName  = $oUpload->getFileName();
                $sUrl       = '../img/'.$sFileName;
                
             } else {

                $aErrors['image'] = true;
            }
        } else {
            
            
            $aErrors['image'] = true;
        }
    
        
    } else {
        
        $aErrors = $oValidate->getErrors();
        
    }
    
}
/**
 * Display HTML
 */
include 'templates/t_upload.php';
