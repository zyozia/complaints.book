<?php
/**
 * Object-oriented interface for specifying validation rules
 * 
 * @category Forms
 * 
 */
class ValidationRule_Base
{
    /**
     * The name of the field associated with this rule
     * 
     * @var string
     */
    private $_fieldname;
    
    /**
     * The error message to display if validation fails
     * 
     * @var string 
     */
    private $_message;
    
    /**
     * One of a predefined set of types of rule
     * 
     * @var string 
     */
    private $_ruletype;
    
    /**
     * Optional additional criteria to evaluate the rule (e.g. a min length)
     * 
     * @var mixed
     */
    private $_criteria = null;
    
    /**
     * Class constructor
     * @param   string  $fieldname
     * @param   string  $message
     * @param   string  $ruletype
     * @param   mixed   $criteria 
     */
    public function __construct($params)
    {
        if(is_array($params)){
            $this->_fieldname = $params[0];
            $this->_message = $params[1];
            $this->_ruletype = $params[2];
            $this->_criteria = $params[3];
        }else{
            $this->_fieldname = null;
            $this->_message = null;
            $this->_ruletype = null;
            $this->_criteria = null;
        }
    }
    
    /**
     * Magic method to get private properties, prepends an underscore
     * 
     * @param   string $property The requested property
     * @return  mixed
     */
    public function __get($property)
    {
        $name = '_' . $property;
        if (isset ($this->$name)) {
            return $this->$name;
        }
        return false;
    }
}