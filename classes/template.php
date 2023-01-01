<?php

class Template {
    var $vars; // Holds all the template variables
    private $file; // Dynamic file template 

    /*
     * Constructor
     *
     * @param $file string the file name you want to load
     */
    function __construct($file = null) {
        $this->file = $file;
    }

    /*
     * Set a template variable.
     */
    function set($name, $value) {
        $this->vars[$name] = is_object($value) ? $value->fetch() : $value;
    }

    /*
     * Open, parse, and return the template file.
     *
     * @param $file string the template file name
     */
    function fetch($file = null) {
        if(!$file) $file = $this->file;

        if ($this->vars)
        extract($this->vars);          // Extract the vars to local namespace
        ob_start();                    // Start output buffering
        include($file);                // Include the file
        $contents = ob_get_contents(); // Get the contents of the buffer
        ob_end_clean();                // End buffering and discard
        return $contents;              // Return the contents
    }
}

$tmpl = new Template;

?>
