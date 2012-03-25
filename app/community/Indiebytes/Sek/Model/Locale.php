<?php
class Indiebytes_Sek_Model_Locale extends Mage_Core_Model_Locale {
    /**
     * Create Zend_Currency object for current locale
     *
     * @param   string $currency
     * @return  Zend_Currency
     */
    public function currency($currency)
    {
        Varien_Profiler::start('locale/currency');
        if (!isset(self::$_currencyCache[$this->getLocaleCode()][$currency])) {
            try {
                $currencyObject = new Zend_Currency($currency, $this->getLocale());
            } catch (Exception $e) {
                $currencyObject = new Zend_Currency($this->getCurrency(), $this->getLocale());
                $options = array(
                        'name'      => $currency,
                        'currency'  => $currency,
                        'symbol'    => $currency
                );
                $currencyObject->setFormat($options);
            }

            if ($currency == 'SEK') {
                $currencyObject->setFormat(
                    array(
                        'position'  => $currencyObject::RIGHT,
                        'locale'    => 'sv_SE',
                        'display'   => $currencyObject::USE_SHORTNAME
                    )
                );
            }

            self::$_currencyCache[$this->getLocaleCode()][$currency] = $currencyObject;
        }
        Varien_Profiler::stop('locale/currency');
        return self::$_currencyCache[$this->getLocaleCode()][$currency];
    }
}