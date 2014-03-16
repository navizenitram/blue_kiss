<?php
/**
 * Manage file uploads
 *
 * @author Ivan Martínez <ivan.martinezca@gmail.com>
 */
class cUpload {
    
    /**
     * The temporay name of the uploaded file
     * @var string
     */
    private $sFile;
    
    /**
     * If upload fails it's set to true
     * @var type 
     */
    private $bError;
    
    /**
     * The mime type of the uploaded file
     * @var string 
     */
    private $sMime;
    
    
    /**
     * Content allowed mime types.
     * @var array 
     */
    private $aMimeTypesAllowed = array('jpg'  => 'image/jpeg',
                                       'jpeg' => 'image/jpeg',
                                       'jpe'  => 'image/jpeg',
                                       'gif'  => 'image/gif',
                                       'png'  => 'image/png',
                                       'bmp'  => 'image/bmp');
    /**
     * Content file extensions
     * @var array
     */
    private $aFileExtension    = array('image/jpeg'=>'.jpg',
                                       'image/jpeg'=>'.jpg',
                                       'image/jpeg'=>'.jpg',
                                       'image/gif' =>'.gif',
                                       'image/png' =>'.png',
                                       'image/bmp' =>'.bmp');
    
    /**
     * Contents the exception message
     * @var string 
     */
    private $exception;
    
    /**
     * If previously the file exists is set to true
     * @var type 
     */
    private $bChanged;
    
    /**
     * File name
     * @var string
     */
    private $sFileName;
    
  
    /**
     * Set image from upload form
     * @param array $aFile
     */
    public function __construct($aFile) {
        
        try {
             
             if(!isset($aFile['error']) || is_array($aFile['error'])) {
                
                 throw new Exception('Invalid data');
             }
             
             switch ($aFile['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file sent');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception('Exceeded filesize limit');
                default:
                    throw new Exception('Unknown errors');
            }
            
            if(!$this->isImage($aFile['tmp_name'])) {
                throw new Exception('No image file');
            }
            
            $this->sFile   = $aFile['tmp_name'];
            $this->bError  = false;
            
            
        } catch (Exception $exception) {

            $this->exception = $exception;
            $this->bError = true;

        }
    }
    
     
    /**
     * Save a upload file
     * 
     * @param string $sFileName
     * @param string $sPath
     * @return boolean
     * @throws Exception
     */
    public function saveFile($sFileName,$sPath) {
         
        try {
             
                if(!$this->bError) {

                        $sFileName = trim($sFileName);
                        if(empty($sFileName)) {

                            throw new Exception('Invalid Name'); 
                        }
                        
                        $this->sFileName = $this->cleanNewFileName($sFileName);
                        
                        $sFileName = $this->sFileName . $this->aFileExtension[$this->sMime]; 

                        if(is_file($sPath.$sFileName)) {


                            $this->bChanged = true;
                        } else {

                            $this->bChanged = false;
                        }
                      
                       if(!$this->move_uploaded_file($this->sFile, $sPath.$sFileName)) {
                           throw new Exception('Move Upload Error'); 
                       } 
                       
                       
                } else {

                   throw new Exception('No image file'); 
                }

                return true;
             
          } catch (Exception $exception) {

            $this->exception = $exception;
            return false;
          }
    }
    
    
    /**
     * Clean the new file name
     * @param string $sFileName
     * @return string
     * 
     */
    private function cleanNewFileName($sFileName) {
        
        $extension   = pathinfo($sFileName, PATHINFO_EXTENSION);
        $sFileName   = basename($sFileName, '.'.$extension);  
        
        $pattern     = array( "([^a-zA-Z0-9-.])", "(-{2,})" );
        $replacement = array("", "");
        
        $sFileName   = preg_replace($pattern, $replacement, $sFileName);
        
        return $sFileName;
        
    }
   
    /**
     * Return true if the file have a mime type allowed
     * @param string $sFile
     * @return boolean
     * @see cUpload::aMimeTypesAllowed
     */
    private function isImage($sFile) {
        
        
        $oFinfo = new finfo(FILEINFO_MIME);
        $type  = $oFinfo->file($sFile);
        
        if($type) {
           
            $aType = explode(';', $type);
            $sMime = $aType[0];
        
        
            if(in_array($sMime, $this->aMimeTypesAllowed)) {
                
                $this->sMime = $sMime;
                return true;

            } else {

                return false;
            }
        
        } else {
            
            return false;
        }
        
    }
     
    /**
     * Return false is the file upload is correct
     * @return bool
     */
    public function getError() {
       
        return $this->bError;
    }
    
    /**
     * Give information about de save process
     * @return bool
     */
    public function isChange() {
        
        return $this->bChanged;
    }
    
    /**
     * Returns the name of the file saved without extension
     * @return string
     * @todo add return extension option
     */
    public function getFileName() {
        
        return $this->sFileName;
    }
    
    /**
     * Return the given exception message
     * @return string
     */
    public function getException() {
        return $this->exception;
    }
    /**
     * In order to work fine with TDD the function is rewrite to be overriden in test
     * 
     * @param string $filename The filename of the uploaded file.
     * @param strin $destination The destination of the moved file.
     * @return bool
     */
    function move_uploaded_file($filename, $destination)
    {
        return move_uploaded_file($filename, $destination);
    }
            
}


