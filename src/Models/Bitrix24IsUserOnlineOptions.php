<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24IsUserOnlineOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        return [
            'user_id' => 'User id',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     */
    public function getAvailableOutFields(): array
    {
        return [
            'is_user_online' => 'Пользователь авторизован',
        ];
    }
}