<?php
/**
 * Indiebytes_Sek_Model_Core_Locale
 * 
 * Extends Mage_Core_Model_Locale and overrides the currency method to
 * force certain formatting of prices when the currency is set to SEK.
 * 
 * @category  Indiebytes
 * @package   Indiebytes_Sek
 * @author    Andreas Karlsson <andreas.karlsson@indiebytes.se>
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 * @copyright Copyright (c) 2012 Indiebytes
 * @link      https://github.com/indiebytes/Indiebytes_Sek
 * @see       Mage_Core_Model_Locale
 */
class Indiebytes_Sek_Model_Core_Locale extends Mage_Core_Model_Locale {

    /**
     * Create Zend_Currency object for current locale
     *
     * @param   string $currency
     * @return  Zend_Currency
     */
    public function currency($currency) {
        Varien_Profiler::start('locale/currency');
        if (!isset(self::$_currencyCache[$this->getLocaleCode()][$currency])) {
            try {
                $currencyObject = new Zend_Currency($currency, $this->getLocale());
            } catch (Exception $e) {
                $currencyObject = new Zend_Currency($this->getCurrency(), $this->getLocale());
                $options = array(
                    'name' => $currency,
                    'currency' => $currency,
                    'symbol' => $currency
                );
                $currencyObject->setFormat($options);
            }

            if ($currency == 'SEK') {
                $currencyObject->setFormat(
                        array(
                            'position' => $currencyObject::RIGHT,
                            'locale' => 'sv_SE',
                            'display' => $currencyObject::USE_SHORTNAME
                        )
                );
            }

            self::$_currencyCache[$this->getLocaleCode()][$currency] = $currencyObject;
        }
        Varien_Profiler::stop('locale/currency');
        return self::$_currencyCache[$this->getLocaleCode()][$currency];
    }

}