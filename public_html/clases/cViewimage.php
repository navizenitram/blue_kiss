<?php
/**
 * Retrieve images from upload folder
 *
 * @author imartinez
 */
class cViewimage {
    
    private $sFileName;
    private $sPath;
    
    /**
     * Set Filename and parth
     * 
     * @param type $sFileName
     * @param type $sPath
     */
    public function __construct($sFileName,$sPath) {
        $this->sFileName = $sFileName;
        $this->sPath     = $sPath;
    }
    
    /**
     * Get the href value of the image
     * 
     * @return string
     * @todo improve for the same file name with different extensions
     */
    public function getUrl() {
        
        $aImages = $this->listDir($this->sPath);
        
        foreach ($aImages as $image) {
            $extension   = pathinfo($image, PATHINFO_EXTENSION);
            $sFileName   = basename($image, '.'.$extension); 
            
            if($sFileName == $this->sFileName){
                $sUrl = '.'.$this->sPath.$image;
                break;
            } else {
                $sUrl = '';
            }
        }
        
        return $sUrl;
    }
    
    /**
     * Return all the files from the given path
     * @param string $sPath
     * @return array
     */
    private function listDir($sPath) {
        $aImages = array();
        
        $dir = opendir($sPath);
        
        while ($item = readdir($dir)){
            
            if( $item != "." && $item != ".."){
               
                if (is_file($sPath.$item)) {
                  $aImages[] = $item;  
                }
            }
        }
        
        return $aImages;
    }
}

?>
