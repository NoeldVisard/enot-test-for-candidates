<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\services\CurrencyConverterService;

class ConvertController
{
    public function converterPage()
    {
        $this->render('converter');
    }

    public function convert(Request $request)
    {
        $body = $request->getBody();
        $currencyConverterService = new CurrencyConverterService(new CurrencyMapper());
        $convertedAmount = $currencyConverterService->convert($body['amount'], $body['fromCurrency'], $body['toCurrency']);

        $this->render('converter');
    }
}