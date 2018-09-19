<?php namespace professionalweb\IntegrationHub\Bitrix24\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24Service;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24ContactSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Filter;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24LeadDistributionSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Algorithms\RoundRobin;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Services\DistributionService;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadSubsystem as IBitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ContactSubsystem as IBitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;
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
        $this->app->bind(IBitrix24ContactSubsystem::class, Bitrix24ContactSubsystem::class);
        $this->app->bind(IBitrix24LeadDistributionSubsystem::class, Bitrix24LeadDistributionSubsystem::class);
    }
}