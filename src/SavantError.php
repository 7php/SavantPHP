<?php
namespace SavantPHP;

/**
 * Class SavantError
 * @package SavantPHP
 */
class SavantError 
{
    /**
     * The error code, typically a Savant 'ERR_*' string.
     *
     * @access public
     * @var string
     */
    public $code = null;

    /**
     * An array of error-specific information.
     *
     * @access public
     * @var array
     */
    public $info = array();

    /**
     * The error severity level.
     *
     * @access public
     * @var int
     */
    public $level = E_USER_ERROR;

    /**
     * A debug backtrace for the error, if any.
     *
     * @access public
     * @var array
     */
    public $trace = null;


    /**
     * Constructor.
     *
     * @access public
     * @param array $conf An associative array where the key is a
     * SavantError property and the value is the value for that
     * property.
     */
    public function __construct($conf = array())
    {
        // set public properties
        foreach ($conf as $key => $val) {
            $this->$key = $val;
        }
        // add a backtrace
        if ($conf['trace'] === true) {
            $this->trace = debug_backtrace();
        }
    }

    /**
     * Magic method for output dump.
     *
     * @access public
     * @return String
     */
    public function __toString()
    {
        ob_start();
        echo get_class($this) . ': ';
        print_r(get_object_vars($this));
        $content = ob_get_clean();

        return $content;
    }
}