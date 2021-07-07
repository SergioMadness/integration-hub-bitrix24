<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

interface Bitrix24Service
{
    public const DOCUMENT_TYPE_LEAD = 'lead';

    public const DOCUMENT_TYPE_CONTACT = 'contact';

    public const DOCUMENT_TYPE_COMPANY = 'company';

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
     * Get lead info by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getLead(int $id): array;

    /**
     * Update lead
     *
     * @param int   $id
     * @param array $data
     */
    public function updateLead(int $id, array $data): void;

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
     * Update deal
     *
     * @param int   $id
     * @param array $data
     *
     * @return int
     */
    public function updateDeal(int $id, array $data): bool;

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

    /**
     * Filter users by status (active/not active)
     *
     * @param array $userIds
     *
     * @return array
     */
    public function filterOnline(array $userIds): array;

    /**
     * Search for leads
     *
     * @param array $conditions
     *
     * @return array
     */
    public function findLeads(array $conditions): array;

    /**
     * Search for contacts
     *
     * @param array $conditions
     *
     * @return array
     */
    public function findContacts(array $conditions): array;

    /**
     * Get contact by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getContact(int $id): array;

    /**
     * Get deal list by conditions
     *
     * @param array $conditions
     *
     * @return array
     */
    public function findDeals(array $conditions): array;

    /**
     * Get product by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getProduct(int $id): array;
}