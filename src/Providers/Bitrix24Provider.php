<?php namespace professionalweb\IntegrationHub\Bitrix24\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24Service;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24DealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24InvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetProductSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SearchDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SearchLeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24IsUserOnlineSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24UpdateInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SearchContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24CheckDuplicatesSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ConvertCurrencySubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadDistributionSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24SetInvoiceStatusSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;
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
        $this->app->bind(IBitrix24GetProductSubsystem::class, Bitrix24GetProductSubsystem::class);
        $this->app->bind(IBitrix24SearchDealSubsystem::class, Bitrix24SearchDealSubsystem::class);
        $this->app->bind(IBitrix24GetContactSubsystem::class, Bitrix24GetContactSubsystem::class);
        $this->app->bind(IBitrix24SearchLeadSubsystem::class, Bitrix24SearchLeadSubsystem::class);
        $this->app->bind(IBitrix24GetInvoiceSubsystem::class, Bitrix24GetInvoiceSubsystem::class);
        $this->app->bind(IBitrix24IsUserOnlineSubsystem::class, Bitrix24IsUserOnlineSubsystem::class);
        $this->app->bind(IBitrix24UpdateInvoiceSubsystem::class, Bitrix24UpdateInvoiceSubsystem::class);
        $this->app->bind(IBitrix24SearchContactSubsystem::class, Bitrix24SearchContactSubsystem::class);
        $this->app->bind(IBitrix24ConvertCurrencySubsystem::class, Bitrix24ConvertCurrencySubsystem::class);
        $this->app->bind(IBitrix24CheckDuplicatesSubsystem::class, Bitrix24CheckDuplicatesSubsystem::class);
        $this->app->bind(IBitrix24LeadDistributionSubsystem::class, Bitrix24LeadDistributionSubsystem::class);
        $this->app->bind(IBitrix24SetInvoiceStatusSubsystem::class, Bitrix24SetInvoiceStatusSubsystem::class);
    }
}