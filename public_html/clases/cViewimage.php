<?php
/**
 * Description of cViewimage
 *
 * @author imartinez
 */
class cViewimage {
    
    private $sFileName;
    private $sPath;
    
    
    public function __construct($sFileName,$sPath) {
        $this->sFileName = $sFileName;
        $this->sPath     = $sPath;
    }
    
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
