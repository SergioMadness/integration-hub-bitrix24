<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24ContactOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'ADDRESS'              => 'Адрес контакта',
            'ADDRESS_2'            => 'Вторая страница адреса',
            'ADDRESS_CITY'         => 'Город',
            'ADDRESS_COUNTRY'      => 'Страна',
            'ADDRESS_COUNTRY_CODE' => 'Код страны',
            'ADDRESS_POSTAL_CODE'  => 'Почтовый индекс',
            'ADDRESS_PROVINCE'     => 'Область',
            'ADDRESS_REGION'       => 'Район',
            'ASSIGNED_BY_ID'       => 'Связано с пользователем по ID',
            'BIRTHDATE'            => 'Дата рождения',
            'COMMENTS'             => 'Комментарии',
            'COMPANY_IDS'          => 'Привязка контакта к нескольким компаниям',
            'EMAIL'                => 'Адрес электронной почты',
            'EXPORT'               => 'Участвует ли контакт в экспорте. Eсли N, то выгрузить его невозможно.',
            'FACE_ID'              => 'Привязка к лицам из модуля',
            'HONORIFIC'            => 'Вид обращения',
            'IM'                   => 'Мессенджеры',
            'LAST_NAME'            => 'Фамилия',
            'NAME'                 => 'Имя',
            'OPENED'               => 'Доступен для всех',
            'ORIGINATOR_ID'        => 'Идентификатор источника данных',
            'ORIGIN_ID'            => 'Идентификатор элемента в источнике данных',
            'ORIGIN_VERSION'       => 'Оригинальная версия',
            'PHONE'                => 'Телефон контакта',
            'PHOTO'                => 'Фото контакта',
            'POST'                 => 'Должность',
            'SECOND_NAME'          => 'Отчество',
            'SOURCE_DESCRIPTION'   => 'Описание источника',
            'SOURCE_ID'            => 'Идентификатор источника',
            'TYPE_ID'              => 'Идентификатор типа',
            'UTM_CAMPAIGN'         => 'Обозначение рекламной кампании',
            'UTM_CONTENT'          => 'Содержание кампании',
            'UTM_MEDIUM'           => 'Тип трафика',
            'UTM_SOURSE'           => 'Рекламная система',
            'UTM_TERM'             => 'Условие поиска кампании',
            'WEB'                  => 'URL ресурсов контакта',
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
            'contact_id' => 'Id созданного контакта',
        ];
    }
}