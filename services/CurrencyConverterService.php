<?php

namespace app\services;

class CurrencyConverterService
{
    private $currencyMapper;

    public function __construct(CurrencyMapper $currencyMapper)
    {
        $this->currencyMapper = $currencyMapper;
    }

    public function convert(int $amount, string $fromCurrency, string $toCurrency)
    {
        $fromExchangeRate = $this->currencyMapper->getExchangeRate($fromCurrency);
        $toExchangeRate = $this->currencyMapper->getExchangeRate($toCurrency);

        $convertedAmount = ($amount / $fromExchangeRate) * $toExchangeRate;

        return $convertedAmount;
    }

}