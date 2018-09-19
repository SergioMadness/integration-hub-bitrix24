<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

interface Bitrix24Service
{
    /**
     * Set service settings
     *
     * @param array $settings
     *
     * @return Bitrix24Service
     */
    public function setSettings(array $settings): self;

    /**
     * Send lead to CRM
     *
     * @param array $data
     *
     * @return int
     */
    public function sendLead(array $data): int;

    /**
     * Send contact to CRM
     *
     * @param array $data
     *
     * @return int
     */
    public function sendContact(array $data): int;
}