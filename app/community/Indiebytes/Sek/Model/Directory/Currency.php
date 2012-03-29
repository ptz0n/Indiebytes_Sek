<?php
/**
 * Indiebytes_Sek_Model_Directory_Currency
 * 
 * Extends Mage_Directory_Model_Currency and overrides the format method to
 * force the decimal precision to 0.
 * 
 * @category  Indiebytes
 * @package   Indiebytes_Sek
 * @author    Andreas Karlsson <andreas.karlsson@indiebytes.se>
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 * @copyright Copyright (c) 2012 Indiebytes
 * @link      https://github.com/indiebytes/Indiebytes_Sek
 * @see       Mage_Directory_Model_Currency
 */
class Indiebytes_Sek_Model_Directory_Currency extends Mage_Directory_Model_Currency {

    /**
     * Format price to currency format
     *
     * @param   double $price
     * @param   bool $includeContainer
     * @return  string
     */
    public function format($price, $options=array(), $includeContainer = true, $addBrackets = false) {
        // Set decimal precision to 0 instead of 2
        return $this->formatPrecision($price, 0, $options, $includeContainer, $addBrackets);
    }

}