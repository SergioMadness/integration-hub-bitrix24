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
     * Get settings by key with dot notation
     *
     * @param string $key
     *
     * @param mixed  $default
     *
     * @return array
     */
    public function getSettings(string $key, $default = ''): array;

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

    /**
     * Get response messages/errors
     *
     * @return array
     */
    public function getMessages(): array;

    /**
     * Check last request was successful
     *
     * @return bool
     */
    public function isSuccess(): bool;
}