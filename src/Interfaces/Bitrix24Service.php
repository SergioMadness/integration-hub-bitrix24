<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

interface Bitrix24Service
{
    public const DOCUMENT_TYPE_LEAD = 'lead';

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

    /**
     * Create invoice in CRM
     *
     * @param array $data
     *
     * @return int
     */
    public function sendInvoice(array $data): int;

    /**
     * Get invoice by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getInvoice(int $id): array;

    /**
     * Create deal
     *
     * @param array $data
     *
     * @return array
     */
    public function sendDeal(array $data): int;

    /**
     * Get deal
     *
     * @param int $id
     *
     * @return array
     */
    public function getDeal(int $id): array;

    /**
     * Update invoice
     *
     * @param int   $id
     * @param array $data
     *
     * @return bool
     */
    public function updateInvoice(int $id, array $data): bool;

    /**
     * Get currency list
     *
     * @return array
     */
    public function getCurrencies(): array;

    /**
     * Start workflow for document
     *
     * @param        $templateId
     * @param        $documentId
     * @param string $documentType
     *
     * @return Bitrix24Service
     */
    public function startWorkflow($templateId, $documentId, $documentType = self::DOCUMENT_TYPE_LEAD): self;

    /**
     * Check entity has duplicates
     *
     * @param string $contact
     * @param string $entityType
     *
     * @return bool
     */
    public function hasDuplicates(string $contact, string $entityType = self::DOCUMENT_TYPE_LEAD): bool;

    /**
     * Check user is online
     *
     * @param int $userId
     *
     * @return bool
     */
    public function isUserOnline(int $userId): bool;
}