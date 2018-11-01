<?php namespace professionalweb\IntegrationHub\Bitrix24\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24Service;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24InvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24GetInvoiceSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Filter;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24CheckDuplicatesSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ConvertCurrencySubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadDistributionSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Algorithms\RoundRobin;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Services\DistributionService;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadSubsystem as IBitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ContactSubsystem as IBitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24InvoiceSubsystem as IBitrix24InvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24WorkflowSubsystem as IBitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetInvoiceSubsystem as IBitrix24GetInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24CheckDuplicatesSubsystem as IBitrix24CheckDuplicatesSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ConvertCurrencySubsystem as IBitrix24ConvertCurrencySubsystem;
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
            return (new DistributionService())
                ->setFilter(app(Filter::class))
                ->setAlgorithm(new RoundRobin());
        });

        $this->app->bind(IBitrix24Service::class, Bitrix24Service::class);
        $this->app->bind(IBitrix24LeadSubsystem::class, Bitrix24LeadSubsystem::class);
        $this->app->bind(IBitrix24InvoiceSubsystem::class, Bitrix24InvoiceSubsystem::class);
        $this->app->bind(IBitrix24ContactSubsystem::class, Bitrix24ContactSubsystem::class);
        $this->app->bind(IBitrix24WorkflowSubsystem::class, Bitrix24WorkflowSubsystem::class);
        $this->app->bind(IBitrix24GetInvoiceSubsystem::class, Bitrix24GetInvoiceSubsystem::class);
        $this->app->bind(IBitrix24ConvertCurrencySubsystem::class, Bitrix24ConvertCurrencySubsystem::class);
        $this->app->bind(IBitrix24CheckDuplicatesSubsystem::class, Bitrix24CheckDuplicatesSubsystem::class);
        $this->app->bind(IBitrix24LeadDistributionSubsystem::class, Bitrix24LeadDistributionSubsystem::class);
    }
}