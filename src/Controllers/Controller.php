<?php
namespace Project\Controllers;
use Project\Validator;

/**Class Controller */
abstract class Controller {
    /**
     * The controller's manager
     */
    protected Object $manager;
    /**
     * Validator
     */
    protected Validator $validator;

    /**
     * Instantiate the validator
     */
    public function __construct() {
        $this->validator = new Validator();
    }
}