<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24DealOptions extends Bitrix24LeadOptions
{
    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'ADDITIONAL_INFO'   => 'Дополнительная информация',
            'ASSIGNED_BY_ID'    => 'Связано с пользователем по ID',
            'BEGINDATE'         => 'Дата начала',
            'CATEGORY_ID'       => 'Идентификатор направления',
            'CLOSED'            => 'Завершена',
            'CLOSEDATE'         => 'Дата завершения',
            'COMMENTS'          => 'Коментарии',
            'COMPANY_ID'        => 'Идентификатор привязанной компании',
            'CONTACT_IDS'       => 'Идентификатор привязанного контакта',
            'CURRENCY_ID'       => 'Идентификатор валюты сделки',
            'IS_NEW'            => 'Флаг новой сделки (т. е. сделка в первой стадии)',
            'LOCATION'          => 'Местоположение клиента',
            'OPENED'            => 'Доступен для всех',
            'OPPORTUNITY'       => 'Сумма',
            'ORIGINATOR_ID'     => 'Идентификатор источника данных',
            'ORIGIN_ID'         => 'Идентификатор элемента в источнике данных',
            'PROBABILITY'       => 'Вероятность',
            'STAGE_ID'          => 'Идентификатор стадии',
            'STAGE_SEMANTIC_ID' => 'Имя',
            'TAX_VALUE'         => 'Ставка налога',
            'TITLE'             => 'Название',
            'TYPE_ID'           => 'Тип сделки',
            'UTM_CAMPAIGN'      => 'Обозначение рекламной кампании',
            'UTM_CONTENT'       => 'Содержание кампании',
            'UTM_MEDIUM'        => 'Тип трафика',
            'UTM_SOURCE'        => 'Рекламная система',
            'UTM_TERM'          => 'Условие поиска кампании',
            'PRODUCTS'          => 'PRODUCTS',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [
            'deal_id' => 'ID',
        ];
    }
}