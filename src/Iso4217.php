<?php

namespace Enesdayanc\Iso4217;

use Data;
use Enesdayanc\Iso4217\Model\Country;
use Enesdayanc\Iso4217\Model\Currency;

class Iso4217
{
    /**
     * @api
     *
     * @param string $code
     *
     * @throws \OutOfBoundsException
     *
     * @return Currency
     */
    public function getByCode($code)
    {
        foreach (Data::$currencies as $currency) {
            if (0 === strcasecmp($code, $currency['alpha3']) ||
                0 === strcasecmp($code, $currency['numeric'])) {
                return $this->getObjectFromArray($currency);
            }
        }
        throw new \OutOfBoundsException('ISO 4217 does not contain: ' . $code);
    }

    /**
     * @api
     *
     * @uses ::getByCode()
     *
     * @param string $alpha3
     *
     * @throws \DomainException
     *
     * @return Currency
     */
    public function getByAlpha3($alpha3)
    {
        if (!preg_match('/^[a-zA-Z]{3}$/', $alpha3)) {
            throw new \DomainException('Not a valid alpha3: ' . $alpha3);
        }
        return $this->getByCode($alpha3);
    }

    /**
     * @api
     *
     * @uses ::getByCode()
     *
     * @param string $numeric
     *
     * @throws \DomainException
     *
     * @return Currency
     */
    public function getByNumeric($numeric)
    {
        if (!preg_match('/^[0-9]{3}$/', $numeric)) {
            throw new \DomainException('Not a valid numeric: ' . $numeric);
        }
        return $this->getByCode($numeric);
    }

    /**
     * @api
     *
     * @uses ::$currencies
     *
     * @return Currency[]
     */
    public function getAll()
    {
        $result = array();

        foreach (Data::$currencies as $currency) {
            $result[] = $this->getObjectFromArray($currency);
        }

        return $result;
    }


    /**
     * @param $resultArray
     * @return Currency
     */
    private function getObjectFromArray($resultArray)
    {
        $result = new Currency();

        $result->setName($resultArray['name']);
        $result->setAlpha3($resultArray['alpha3']);
        $result->setNumeric($resultArray['numeric']);
        $result->setExp($resultArray['exp']);

        if (is_array($resultArray['country'])) {
            foreach ($resultArray['country'] as $countryName) {
                $isoCountry = new Country();
                $isoCountry->setName($countryName);
                $result->addCountry($isoCountry);
            }
        } else {
            $isoCountry = new Country();
            $isoCountry->setName($resultArray['country']);
            $result->addCountry($isoCountry);
        }

        return $result;
    }
}