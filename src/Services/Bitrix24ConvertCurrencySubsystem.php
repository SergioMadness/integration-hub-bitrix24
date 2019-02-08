<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24ConvertCurrencyOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ConvertCurrencySubsystem as IBitrix24ConvertCurrencySubsystem;

/**
 * Subsystem to convert amount to base currency
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24ConvertCurrencySubsystem extends Bitrix24LeadSubsystem implements IBitrix24ConvertCurrencySubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24ConvertCurrencyOptions();
    }

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     */
    public function process(EventData $eventData): EventData
    {
        $data = $eventData->getData();
        $data['base_amount'] = $fromCurrency = strtoupper($data['from_currency'] ?? '');
        $toCurrency = strtoupper($data['to_currency'] ?? '');
        if (!empty($fromCurrency) && !empty($toCurrency)) {
            $currencies = $this->getBitrix24Service()
                ->setSettings($this->getProcessOptions()->getOptions())
                ->getCurrencies();
            $newAmount = (float)($data['amount'] ?? 0);
            $fromCurrencyValue = 0;
            $toCurrencyValue = 0;
            foreach ($currencies as $currency) {
                if (strtoupper($currency['CURRENCY']) === $fromCurrency) {
                    $fromCurrencyValue = (float)$currency['AMOUNT'] / (float)$currency['AMOUNT_CNT'];
                }
                if (strtoupper($currency['CURRENCY']) === $toCurrency) {
                    $toCurrencyValue = (float)$currency['AMOUNT'] / (float)$currency['AMOUNT_CNT'];
                }
            }
            $data['base_amount'] = $newAmount * $toCurrencyValue / $fromCurrencyValue;
            $eventData->setData($data);
        }

        return $eventData;
    }
}