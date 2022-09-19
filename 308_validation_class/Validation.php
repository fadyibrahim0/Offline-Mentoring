<?php

class  Validation 
{
    public $validationRules = [];
    public $errors          = [];

    /**
     * Start rules for validations 
     */

    // String Rules
    const F_REQUIRED    = "required";
    const F_EMAIL       = "email";
    const F_STRING      = "string";
    const F_NUMBER      = "number";

    const F_MOBILE_EG   = "mobile_eg";

    // Array Rules
    const F_MIN         = "min";
    const F_MAX         = "max";
    const F_IN          = "in";
    const F_SAME        = "same";

    /**
     * End rules for validations 
     */

    
    // Constructor
    public function __construct(Array $validationRules)
    {
        $this->validationRules = $validationRules;
    }


    /**
     * 
     * split errors to (string rules and array rules)
     * if error ocurred , loop will break 
     * added errors to error property if 
     */
    public function validate()
    {
        // Loop on every name
        foreach ($this->validationRules as $name => $rules) {
            // Loop on every rule for current name
            foreach($rules as $rule)
            {
                $arrRule = explode(":",$rule);
                if(!strpos($rule,":"))
                {
                    $this->validStringField($name,$rule);
                }
                if(count($arrRule) > 1 )
                {
                    $this->validArrayField($name,$arrRule);
                }
            }

            // break from loop if error ocurred
            // if(count($this->errors))
            // {
            //     break;
            // }
        }
        return $this;
    }

    
    // Match String Rule
    private function validStringField($name,$rule)
    {
        switch ($rule) {
            case self::F_REQUIRED:
                $this->requiredFiled($name);
                break;
            case self::F_EMAIL:
                $this->emailFiled($name);
                break;
            case self::F_STRING:
                $this->stringFiled($name);
                break;
            case self::F_NUMBER:
                $this->numberFiled($name);
                break;
        }
    }



    // Match Array Rule
    private function validArrayField($name,$rule)
    {
        switch ($rule[0]) {
            case self::F_MIN:
                $this->minFiled($name,$rule);
                break;
            case self::F_MAX:
                $this->maxFiled($name,$rule);
                break;
            case self::F_SAME:
                $this->sameFiled($name,$rule);
                break;
            case self::F_IN:
                $this->inArrayFiled($name,$rule);
                break;
        }
    }


    // check if field is required or not 
    private function requiredFiled($name)
    {
        if(!empty($this->sanitizeField($name)))
        {
            return true;
        }
        else 
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} is required ";
        }
    }


    // check if value is email or not 
    private function emailFiled($name)
    {
        if(!filter_var($this->sanitizeField($name),FILTER_VALIDATE_EMAIL))
        {
            $this->errors[] = "{$name} must be a valid email";
        }
    }


    // check if value is string or not 
    private function stringFiled($name)
    {
        if(!preg_match('/^[a-zA-Z0-9 .]*$/',$this->sanitizeField($name)))
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} must be a string";
        }

    }


    // check if value is number or not 
    private function numberFiled($name)
    {
        if(!preg_match('/^[0-9]+$/',$this->sanitizeField($name)))
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} must be a number";
        }
    }




    /**
     * Start Array Rules Functions
     */


    //  check  minimum of value
    private function minFiled($name,$rule)
    {
        if(strlen($this->sanitizeField($name)) < $rule[1])
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} must be greater than  {$rule[1]}";
        }
    } 

    // check maximum of value
    private function maxFiled($name,$rule)
    {
        if(strlen($this->sanitizeField($name)) > $rule[1])
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} must be less than  {$rule[1]}";
        }
    } 

    // check if value is equal to another value 
    private function sameFiled($name,$rule)
    {
        if($this->sanitizeField($name) !== $this->sanitizeField($rule[1]))
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} must be equal  {$rule[1]}";
        }
    } 

    // check value exist in array
    private function inArrayFiled($name,$rule)
    {
        $array = explode(',',str_replace(["'", " "], "", $rule[1]));
        if(! in_array($this->sanitizeField($name),$array) )
        {
            $name= str_replace('_',' ', $name);
            $this->errors[] = "{$name} not valid";
        }
    }

    /**
     * End Array Rules Functions
     */



    
    /**
     * Start Helper Functions
     */

    
    // sanitize any value for field
    private function sanitizeField($name)
    {
        return htmlspecialchars(htmlentities(trim($_REQUEST[$name])));
    }

    // return true  if errors not exists 
    public function check()
    {
        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }


    /**
     * End Helper Functions
     */


    


}

function dd($data){
    echo "<pre>";
        print_r($data);
    echo "</pre>";
    exit;
    die;
}