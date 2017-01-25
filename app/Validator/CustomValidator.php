<?php
namespace App\Validator;
 
class CustomValidator extends \Illuminate\Validation\Validator
{
    //alpha
    public function validateAlphaCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }
    
    //alpha_num
    public function validateAlphaNumCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z\d]+$/', $value);
    }

    //alpha_dash 
    public function validateAlphaDashCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z\d_-]+$/', $value);
    }
}