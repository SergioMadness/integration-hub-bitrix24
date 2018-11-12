<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24UpdateInvoiceOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'ID'               => 'ID',
            'ACCOUNT_NUMBER'   => 'Номер',
            'COMMENTS'         => 'Комментарий менеджера',
            'DATE_BILL'        => 'Дата выставления',
            'DATE_INSERT'      => 'Дата создания',
            'DATE_MARKED'      => 'Дата отклонения',
            'DATE_PAY_BEFORE'  => 'Срок оплаты',
            'DATE_PAYED'       => 'Дата перевода',
            'XML_ID'           => 'Внешний код',
            'ORDER_TOPIC'      => 'Тема',
            'PAY_SYSTEM_ID'    => 'Идентификатор печатной формы',
            'PAY_VOUCHER_DATE' => 'Дата оплаты',
            'PAY_VOUCHER_NUM'  => 'Номер документа оплаты',
            'PERSON_TYPE_ID'   => 'Идентификатор типа плательщика',
            'REASON_MARKED'    => 'Комментарий статуса',
            'RESPONSIBLE_ID'   => 'Идентификатор ответственного',
            'STATUS_ID'        => 'Идентификатор статуса',
            'UF_COMPANY_ID'    => 'Идентификатор компании',
            'UF_CONTACT_ID'    => 'Идентификатор контакта',
            'UF_MYCOMPANY_ID'  => 'Идентификатор своей компании',
            'UF_DEAL_ID'       => 'Идентификатор связанной сделки',
            'USER_DESCRIPTION' => 'Комментарий',
            'PR_LOCATION'      => 'Идентификатор местоположения',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }
}