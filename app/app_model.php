<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model {

    /**
     * to validate a field and make sure the value is same with it's confirmation field
     * @param mixed $check
     * @param string $confirmation_field
     * @return boolean
     */
    function isConfirmed($check, $confirmation_field) {
        $value = array_shift($check);
        return $value == $this->data[$this->name][$confirmation_field];
    }

    /**
     * Validate that a number is in specified range(inclusive).
     * if $lower and $upper are not set, will return true if
     * $check is a legal finite on this platform
     *
     * @param string $check Value to check
     * @param integer $lower Lower limit
     * @param integer $upper Upper limit
     * @return boolean Success
     * @access public
     */
	function minmax($check, $lower = null, $upper = null) {
        $value = array_shift($check);
		if (!is_numeric($value)) {
			return false;
		}
		if (isset($lower) && isset($upper)) {
			return ($value >= $lower AND $value <= $upper);
		}
		return is_finite($value);
	}

}
