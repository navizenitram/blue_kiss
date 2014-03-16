<?php
/**
 * Validate form data
 * 
 * @author Ivan Martínez <ivan.martinezca@gmail.com>
 * 
 * @todo add more checks
 */
class cValidate {
    
    /**
     * Data to be validate
     * @var array
     */
    private $aFields = array();
    
    /**
     * Array with error fields
     * @var array
     */
    private $aErrors = array();
    
    /**
     * Set field to be validate
     * 
     * @param string $name
     * @param string $value
     * @param string $type default text
     * @param bool   $request default true
     */
    public function setField($name,$value,$type = 'text',$request = true) {
        $this->aFields[] = array('name'=>$name,
                           'value'=>trim($value),
                           'type'=>$type,
                           'request'=>$request);
    }
    
    /**
     * Return true if all fields are ok
     * @return boolean
     */
    public function isValid() {
        foreach ($this->aFields as $field) {
            switch ($field['type']) {
                case 'text':
                    $this->check_text($field);
                    break;
            }
        }
        
        if(empty($this->aErrors)) {
            return true;
        } else {
            return false;
        }
        
    }
    
    /**
     * Check text fields
     * @param array $aField
     */
    private function check_text($aField) {
        
        if(empty($aField['value']) && $aField['request']) {
            $this->aErrors[$aField['name']] = 'error';
        }
        
    }
    
    /**
     * Return array with errors
     * @return array
     */
    public function getErrors() {
        return $this->aErrors;
    }
}

?>
