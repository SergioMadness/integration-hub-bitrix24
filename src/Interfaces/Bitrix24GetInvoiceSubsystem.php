<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

interface Bitrix24GetInvoiceSubsystem extends Subsystem
{
    public const BITRIX24_GET_INVOICE = 'bitrix-get-invoice';
}