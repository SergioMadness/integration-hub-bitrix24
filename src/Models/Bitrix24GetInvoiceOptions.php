<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24GetInvoiceOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'ID' => 'ID',
        ];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        $result = parent::getOptions();

        $result['need_fields'] = [
            'name' => 'Получить параметры',
            'type' => 'list',
        ];

        return $result;
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
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
            'CONTACT_ID'        => 'Идентификатор привязанного контакта',
            'CONTACT_IDS'       => 'Идентификатор привязанного контакта',
            'CREATED_BY_ID'     => 'Создано пользователем',
            'CURRENCY_ID'       => 'Идентификатор валюты сделки',
            'DATE_CREATE'       => 'Дата создания',
            'DATE_MODIFY'       => 'Дата изменения',
            'ID'                => 'Идентификатор сделки',
            'IS_NEW'            => 'Флаг новой сделки (т. е. сделка в первой стадии)',
            'LEAD_ID'           => 'Идентификатор привязанного лида',
            'LOCATION'          => 'Местоположение клиента',
            'MODIFY_BY_ID'      => 'Идентификатор автора последнего изменения',
            'OPENED'            => 'Доступен для всех',
            'OPPORTUNITY'       => 'Сумма',
            'ORIGINATOR_ID'     => 'Идентификатор источника данных',
            'ORIGIN_ID'         => 'Идентификатор элемента в источнике данных',
            'PROBABILITY'       => 'Вероятность',
            'QUOTE_ID'          => 'Идентификатор квоты',
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
        ];
    }
}