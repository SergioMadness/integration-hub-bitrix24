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
        $fromCurrency = strtoupper($data['from_currency'] ?? '');
        if (!empty($fromCurrency)) {
            $currencies = $this->getBitrix24Service()
                ->setSettings($this->getProcessOptions()->getOptions())
                ->getCurrencies();
            $newAmount = (float)($data['amount'] ?? 0);
            foreach ($currencies as $currency) {
                if (strtoupper($currency['CURRENCY']) === $fromCurrency) {
                    $newAmount *= (float)$currency['AMOUNT'];
                    break;
                }
            }
            $data['base_amount'] = $newAmount;
            $eventData->setData($data);
        }

        return $eventData;
    }
}