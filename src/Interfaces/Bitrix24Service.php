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
}