<?php

namespace app\commands;

class Currencies
{
    public function unloadCurrencies()
    {
        $parser = new Parse();
        $mapper = new CurrencyMapper();

        $exchangeRates = $parser->getExchangeRates();
        foreach ($exchangeRates as $currencyCode => $rate) {
            $mapper->saveExchangeRate($currencyCode, $rate);
        }
    }
}