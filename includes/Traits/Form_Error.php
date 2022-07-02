<?php
namespace Wecoder\Academy\Traits;

/**
 * Erorr handler trait
 */
trait Form_Error
{
    /**
     * Default error property
     */
    public $errors = [];
    /**
     * Check if the form eror
     *
     * @param [string] $key
     * @return boolean
     */
    public function has_error($key)
    {
        return isset($this->errors[$key]) ? true : false;
    }
/**
 * Get the error
 *
 * @param [string] $key
 * @return string | false
 */
    public function get_error($key)
    {
        return isset($this->errors[$key]) ? $this->errors[$key] : false;
    }
}
