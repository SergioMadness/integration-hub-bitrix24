<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

interface Bitrix24Service
{
    public const DOCUMENT_TYPE_LEAD = 'lead';

    public const DOCUMENT_TYPE_CONTACT = 'contact';

    public const DOCUMENT_TYPE_COMPANY = 'company';

    /**
     * Set service settings
     *
     * @return Bitrix24Service
     */
    public function setSettings(array $settings): self;

    /**
     * Send lead to CRM
     */
    public function sendLead(array $data): int;

    /**
     * Get lead info by id
     */
    public function getLead(int $id): array;

    /**
     * Update lead
     */
    public function updateLead(int $id, array $data): void;

    /**
     * Send contact to CRM
     */
    public function sendContact(array $data): int;

    /**
     * Create invoice in CRM
     */
    public function sendInvoice(array $data): int;

    /**
     * Get invoice by id
     */
    public function getInvoice(int $id): array;

    /**
     * Create deal
     *
     * @return array
     */
    public function sendDeal(array $data): int;

    /**
     * Get deal
     */
    public function getDeal(int $id): array;

    /**
     * Update deal
     *
     * @return int
     */
    public function updateDeal(int $id, array $data): bool;

    /**
     * Update invoice
     */
    public function updateInvoice(int $id, array $data): bool;

    /**
     * Get currency list
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
     */
    public function hasDuplicates(string $contact, string $entityType = self::DOCUMENT_TYPE_LEAD): bool;

    /**
     * Check user is online
     */
    public function isUserOnline(int $userId): bool;

    /**
     * Filter users by status (active/not active)
     */
    public function filterOnline(array $userIds): array;

    /**
     * Search for leads
     */
    public function findLeads(array $conditions): array;

    /**
     * Search for contacts
     */
    public function findContacts(array $conditions): array;

    /**
     * Get contact by id
     */
    public function getContact(int $id): array;

    /**
     * Get deal list by conditions
     */
    public function findDeals(array $conditions): array;

    /**
     * Get product by id
     */
    public function getProduct(int $id): array;
}