<?php namespace professionalweb\IntegrationHub\Bitrix24\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24Service;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24DealOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24LeadOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24ContactOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetDealOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetLeadOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24InvoiceOptions;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24DealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetContactOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetInvoiceOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetProductOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SearchDealOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SearchLeadOptions;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24InvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24IsUserOnlineOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SearchContactOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24StartWorkflowOptions;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetProductSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SearchDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SearchLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24UpdateLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24UpdateDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24CheckDuplicatesOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24ConvertCurrencyOptions;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24IsUserOnlineSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24LeadDistributionOptions;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SetInvoiceStatusOptions;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24UpdateInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SearchContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24CheckDuplicatesSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ConvertCurrencySubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadDistributionSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SetInvoiceStatusSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\SubsystemPool;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Algorithms\RoundRobin;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Services\DistributionService;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24DealSubsystem as IBitrix24DealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadSubsystem as IBitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetLeadSubsystem as IBitrix24GetLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetDealSubsystem as IBitrix24GetDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ContactSubsystem as IBitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24InvoiceSubsystem as IBitrix24InvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24WorkflowSubsystem as IBitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetInvoiceSubsystem as IBitrix24GetInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SearchLeadSubsystem as IBitrix24SearchLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetContactSubsystem as IBitrix24GetContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetProductSubsystem as IBitrix24GetProductSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SearchDealSubsystem as IBitrix24SearchDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateLeadSubsystem as IBitrix24UpdateLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateDealSubsystem as IBitrix24UpdateDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24IsUserOnlineSubsystem as IBitrix24IsUserOnlineSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateInvoiceSubsystem as IBitrix24UpdateInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SearchContactSubsystem as IBitrix24SearchContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24CheckDuplicatesSubsystem as IBitrix24CheckDuplicatesSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ConvertCurrencySubsystem as IBitrix24ConvertCurrencySubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SetInvoiceStatusSubsystem as IBitrix24SetInvoiceStatusSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadDistributionSubsystem as IBitrix24LeadDistributionSubsystem;

class Bitrix24Provider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'IntegrationHubBitrix24');

        $this->app->booted(static function () {
            /** @var SubsystemPool $pool */
            $pool = app(SubsystemPool::class);
            $pool->register(trans('IntegrationHubBitrix24::common.check-duplicates'), Bitrix24CheckDuplicatesSubsystem::BITRIX24_CHECK_DUPLICATES, new Bitrix24CheckDuplicatesOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.contact'), Bitrix24ContactSubsystem::BITRIX24_CONTACT, new Bitrix24ContactOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.convert-currency'), Bitrix24ConvertCurrencySubsystem::BITRIX24_CONVERT_CURRENCY, new Bitrix24ConvertCurrencyOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.deal'), Bitrix24DealSubsystem::BITRIX24_CREATE_DEAL, new Bitrix24DealOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.get-contact'), Bitrix24GetContactSubsystem::BITRIX24_GET_CONTACT, new Bitrix24GetContactOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.get-deal'), Bitrix24GetDealSubsystem::BITRIX24_GET_DEAL, new Bitrix24GetDealOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.get-invoice'), Bitrix24GetInvoiceSubsystem::BITRIX24_GET_INVOICE, new Bitrix24GetInvoiceOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.get-lead'), Bitrix24GetLeadSubsystem::BITRIX24_GET_LEAD, new Bitrix24GetLeadOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.get-product'), Bitrix24GetProductSubsystem::BITRIX24_GET_CONTACT, new Bitrix24GetProductOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.invoice'), Bitrix24InvoiceSubsystem::BITRIX24_INVOICE, new Bitrix24InvoiceOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.is-user-online'), Bitrix24IsUserOnlineSubsystem::BITRIX24_GET_EMPLOYEE_STATUS, new Bitrix24IsUserOnlineOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.lead-distribution'), Bitrix24LeadDistributionSubsystem::BITRIX24_LEAD_DISTRIBUTION, new Bitrix24LeadDistributionOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.lead'), Bitrix24LeadSubsystem::BITRIX24_LEAD, new Bitrix24LeadOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.search-contact'), Bitrix24SearchContactSubsystem::BITRIX24_SEARCH_CONTACT, new Bitrix24SearchContactOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.search-deal'), Bitrix24SearchDealSubsystem::BITRIX24_SEARCH_DEAL, new Bitrix24SearchDealOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.search-lead'), Bitrix24SearchLeadSubsystem::BITRIX24_SEARCH_LEAD, new Bitrix24SearchLeadOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.set-invoice-status'), Bitrix24SetInvoiceStatusSubsystem::BITRIX24_SET_INVOICE_STATUS, new Bitrix24SetInvoiceStatusOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.update-deal'), Bitrix24UpdateDealSubsystem::BITRIX24_UPDATE_DEAL, new Bitrix24DealOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.update-invoice'), Bitrix24UpdateInvoiceSubsystem::BITRIX24_UPDATE_INVOICE, new Bitrix24InvoiceOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.update-lead'), Bitrix24UpdateLeadSubsystem::BITRIX24_UPDATE_LEAD, new Bitrix24LeadOptions());
            $pool->register(trans('IntegrationHubBitrix24::common.start-workflow'), Bitrix24WorkflowSubsystem::BITRIX24_WORKFLOW, new Bitrix24StartWorkflowOptions());
        });
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->singleton(IDistributionService::class, function () {
            return (new DistributionService())->setAlgorithm(new RoundRobin());
        });

        $this->app->bind(IBitrix24Service::class, Bitrix24Service::class);
        $this->app->bind(IBitrix24DealSubsystem::class, Bitrix24DealSubsystem::class);
        $this->app->bind(IBitrix24LeadSubsystem::class, Bitrix24LeadSubsystem::class);
        $this->app->bind(IBitrix24GetLeadSubsystem::class, Bitrix24GetLeadSubsystem::class);
        $this->app->bind(IBitrix24InvoiceSubsystem::class, Bitrix24InvoiceSubsystem::class);
        $this->app->bind(IBitrix24ContactSubsystem::class, Bitrix24ContactSubsystem::class);
        $this->app->bind(IBitrix24GetDealSubsystem::class, Bitrix24GetDealSubsystem::class);
        $this->app->bind(IBitrix24WorkflowSubsystem::class, Bitrix24WorkflowSubsystem::class);
        $this->app->bind(IBitrix24UpdateLeadSubsystem::class, Bitrix24UpdateLeadSubsystem::class);
        $this->app->bind(IBitrix24GetProductSubsystem::class, Bitrix24GetProductSubsystem::class);
        $this->app->bind(IBitrix24SearchDealSubsystem::class, Bitrix24SearchDealSubsystem::class);
        $this->app->bind(IBitrix24GetContactSubsystem::class, Bitrix24GetContactSubsystem::class);
        $this->app->bind(IBitrix24SearchLeadSubsystem::class, Bitrix24SearchLeadSubsystem::class);
        $this->app->bind(IBitrix24GetInvoiceSubsystem::class, Bitrix24GetInvoiceSubsystem::class);
        $this->app->bind(IBitrix24UpdateDealSubsystem::class, Bitrix24UpdateDealSubsystem::class);
        $this->app->bind(IBitrix24IsUserOnlineSubsystem::class, Bitrix24IsUserOnlineSubsystem::class);
        $this->app->bind(IBitrix24UpdateInvoiceSubsystem::class, Bitrix24UpdateInvoiceSubsystem::class);
        $this->app->bind(IBitrix24SearchContactSubsystem::class, Bitrix24SearchContactSubsystem::class);
        $this->app->bind(IBitrix24ConvertCurrencySubsystem::class, Bitrix24ConvertCurrencySubsystem::class);
        $this->app->bind(IBitrix24CheckDuplicatesSubsystem::class, Bitrix24CheckDuplicatesSubsystem::class);
        $this->app->bind(IBitrix24LeadDistributionSubsystem::class, Bitrix24LeadDistributionSubsystem::class);
        $this->app->bind(IBitrix24SetInvoiceStatusSubsystem::class, Bitrix24SetInvoiceStatusSubsystem::class);
    }
}