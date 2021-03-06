<?php
/**
 * This file is part of the PHPasap, a MVC framework
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, Perials Technologies
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	    PHPasap
 * @author	    Perials
 * @copyright	Copyright (c) 2016, Perials Technologies (https://perials.com/)
 * @license	    http://opensource.org/licenses/MIT	MIT License
 * @link	    https://phpasap.com
 */

namespace core\classes;

//Deny direct access
if( !defined('ROOT') ) exit('Cheatin\' huh');

class Validation_Handler {

    /*
     * @errors array
     */
    protected $errors = array();

    /*
     * the validation rules array
     */
    protected $validation_rules = array();
    
    protected $caller_obj = false;
     
    /*
     * the source 
     */
    private $source = array();
    
    public function validate($source, $rules_array, $caller_obj=false) {
        $this->add_source($source);
        $this->add_rules($rules_array);
        $this->caller_obj = $caller_obj;
        $this->run();
        if( $this->has_errors() )
            return false;
        else
            return true;
    }
    
    public function has_errors() {
        if( empty($this->errors) )
            return false;
        else
            return true;
    }
    
    public function errors() {
        return $this->errors;
    }
    
    public function set_error($field_name, $error_msg) {
        $this->errors[$field_name] = $error_msg;
    }

    /*
     * add source
     * @param array $source
     */
    public function add_source($source, $trim=false) {
        $this->source = $source;
    }


    /*
     * the validation rules
     */
    public function run() {
        
        foreach( $this->validation_rules as $var=>$opt) {
            
            /*
            $default_opt = [
                            'min' => false,
                            'max' => false,
                            'required' => false,
                            ];
            $opt = array_merge($default_opt,$opt);
            */
                        
            //if compulsary field is not set then no point validating further
            if(isset($opt['set']) && !$this->is_set($var)) {
                continue;
            }            
            
            /* Trim whitespace from beginning and end of variable */
            if( array_key_exists('trim', $opt) ) {
                $this->source[$var] = trim( $this->source[$var] );
            }
            
            //if required field is empty then no point validating further
            if( isset($opt['required']) && !$this->not_empty($var) ) {
                continue;
            }
            
            if( isset($opt['required']) )
            unset($opt['required']);
            
            if( isset($opt['set']) )
            unset($opt['set']);
            
            if( isset($opt['trim']) )
            unset($opt['trim']);
            
            foreach( $opt as $rule_type=>$rule_val ) {
                if( method_exists($this, 'validate_'.$rule_type) ) {
                    call_user_func_array([$this, 'validate_'.$rule_type], [$var, $rule_val]);
                }
                elseif( method_exists($this->caller_obj, $rule_type) ) {
                    call_user_func_array([$this->caller_obj, $rule_type], [$this, $this->source[$var], $rule_val]);
                }
                elseif( function_exists($rule_type) ) {
                    call_user_func_array($rule_type, [$this, $this->source[$var], $rule_val]);
                }
            }
        }
    }

    /**
     * Add multiple rules to the validation rules array
     *
     * @param array $rules_array The array of rules to add
     */
    public function add_rules(array $var_rules_array) {
        
        $rules_array = [];
        foreach( $var_rules_array as $var=>$rules_string ) {
            
            $rules_array[$var] = [];
            
            $t_rules_array = explode('|', $rules_string);
            foreach( $t_rules_array as $rule ) {                
                $rule = explode(':', $rule);
                $rules_array[$var][$rule[0]] = isset($rule[1]) ? $rule[1] : true;
            }
        }
        $this->validation_rules = $rules_array;
    }

    /**
     * Checks if variable is set
     *
     * @param string $var The HTTP variable to check
     *
     */
    private function not_empty($var) {
        if(empty($this->source[$var]))
        {
            $this->errors[$var] = $var . ' is required';
            return false;
        }
        else
            return true;
    }

    /**
     * Checks if variable is set
     *
     * @param string $var The HTTP variable to check
     *
     */
    private function is_set($var) {
        if(!isset($this->source[$var])) {
            $this->errors[$var] = $var . ' is not set';
            return false;
        }
        else
            return true;
    }

    /**
     *
     * @validate an ipv4 IP address
     *
     * @access private
     *
     * @param string $var The variable name
     *
     * @param bool $required
     *
     */
    private function validate_ip_v4($var)
    {
        if(filter_var($this->source[$var], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === FALSE) {
            $this->errors[$var] = $var . ' is not a valid IPv4';
        }
    }

    /**
     *
     * @validate an ipv6 IP address
     *
     * @access private
     *
     * @param string $var The variable name
     *
     * @param bool $required
     *
     */
    public function validate_ip_v6($var)
    {
        if(filter_var($this->source[$var], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === FALSE) {
            $this->errors[$var] = $var . ' is not a valid IPv6';
        }
    }

    /**
     *
     * @validate a floating point number
     *
     * @access private
     *
     * @param $var The variable name
     *
     * @param bool $required
     */
    private function validate_float($var)
    {
        if(filter_var($this->source[$var], FILTER_VALIDATE_FLOAT) === false) {
            $this->errors[$var] = $var . ' is an invalid float';
        }
    }
    
    private function validate_max($var, $max) {
        if( strlen($this->source[$var]) > $max) {
            $this->errors[$var] = $var . ' is too long';
        }
    }
    
    private function validate_min($var, $min) {
        if( strlen($this->source[$var]) < $min) {
            $this->errors[$var] = $var . ' is too short';
        }
    }

    /**
     *
     * @validate a string
     *
     * @access private
     *
     * @param string $var The variable name
     *
     * @param int $min the minimum string length
     *
     * @param int $max The maximum string length
     *
     * @param bool $required
     *
     */
    private function validate_string($var)
    {
        if(!is_string($this->source[$var])) {
                $this->errors[$var] = $var . ' is invalid';
        }
    }

    private function validate_natural($var) {
        if( filter_var( $this->source[$var], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === FALSE) {
            $this->errors[$var] = $var . ' is an invalid number';
        }
    }
    
    private function validate_numeric($var) {
        if( !is_numeric( $this->source[$var] )) {
            $this->errors[$var] = $var . ' is an invalid number';
        }
    }

    /**
     *
     * @validate a url
     *
     * @access private
     *
      * @param string $var The variable name
     *
     * @param bool $required
     *
     */
    private function validate_url($var)
    {
        if(filter_var($this->source[$var], FILTER_VALIDATE_URL) === FALSE) {
            $this->errors[$var] = $var . ' is not a valid URL';
        }
    }


    /*
     * validate an email address
     */
    private function validate_email($var) {
        if(filter_var($this->source[$var], FILTER_VALIDATE_EMAIL) === FALSE) {
            $this->errors[$var] = $var . ' is not a valid email address';
        }
    }


    /**
     * @validate a boolean 
     *
     * @access private
     *
     * @param string $var the variable name
     *
     * @param bool $required
     *
     */
    private function validate_bool($var) {
        if( filter_var($this->source[$var], FILTER_VALIDATE_BOOLEAN) === FALSE) {
            $this->errors[$var] = $var . ' is Invalid';
        }
    }

}