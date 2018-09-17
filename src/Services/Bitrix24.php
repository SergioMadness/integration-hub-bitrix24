<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use Psr\Log\LoggerInterface;

class Bitrix24 extends \Bitrix24\Bitrix24
{
    public function __construct($isSaveRawResponse = false, LoggerInterface $obLogger = null)
    {
        parent::__construct($isSaveRawResponse, $obLogger);

        $this->accessToken = '';
        $this->refreshToken = '';
    }
}