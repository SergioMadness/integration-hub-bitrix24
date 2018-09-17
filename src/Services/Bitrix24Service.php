<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Bitrix24\Exceptions\Bitrix24Exception;
use Bitrix24\Exceptions\Bitrix24IoException;
use Bitrix24\Exceptions\Bitrix24ApiException;
use Bitrix24\Exceptions\Bitrix24SecurityException;
use Bitrix24\Exceptions\Bitrix24WrongClientException;
use Bitrix24\Exceptions\Bitrix24PortalDeletedException;
use Bitrix24\Exceptions\Bitrix24EmptyResponseException;
use Bitrix24\Exceptions\Bitrix24TokenIsExpiredException;
use Bitrix24\Exceptions\Bitrix24TokenIsInvalidException;
use Bitrix24\Exceptions\Bitrix24MethodNotFoundException;
use Bitrix24\Exceptions\Bitrix24PaymentRequiredException;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service as IBitrix24Service;

/**
 * Service to work with Bitrix24 API
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24Service implements IBitrix24Service
{
    public const TYPE_CRM_MULTIFIELD = 'crm_multifield';

    protected const MULTIFIELD_DEFAULT_TYPE = 'HOME';

    protected const METHOD_LEAD_FIELDS = 'crm.lead.fields';

    protected const METHOD_CONTACT_FIELDS = 'crm.contact.fields';

    protected const METHOD_ADD_LEAD = 'crm.lead.add';

    protected const METHOD_ADD_CONTACT = 'crm.contact.add';

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $scope = ['crm'];

    /**
     * @var Bitrix24
     */
    private $client;

    /**
     * @var array
     */
    private $messages;

    /**
     * @var bool
     */
    private $lastRequestSuccessful = false;

    /**
     * Hook
     *
     * @var string
     */
    private $hook;

    /**
     * @var array
     */
    private $rawSettings = [];

    public function __construct(string $url = '', array $scope = ['crm'])
    {
        $this->setUrl($url)->setScope($scope);
    }

    /**
     * @param array $data
     *
     * @return bool
     * @throws \Bitrix24\Exceptions\Bitrix24ApiException
     * @throws \Bitrix24\Exceptions\Bitrix24EmptyResponseException
     * @throws \Bitrix24\Exceptions\Bitrix24Exception
     * @throws \Bitrix24\Exceptions\Bitrix24IoException
     * @throws \Bitrix24\Exceptions\Bitrix24MethodNotFoundException
     * @throws \Bitrix24\Exceptions\Bitrix24PaymentRequiredException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalDeletedException
     * @throws \Bitrix24\Exceptions\Bitrix24SecurityException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsInvalidException
     * @throws \Bitrix24\Exceptions\Bitrix24WrongClientException
     * @throws \Exception
     */
    public function sendLead(array $data): bool
    {
        if (empty($fields = Cache::get('fields'))) {
            Cache::put('fields', $fields = $this->call(self::METHOD_LEAD_FIELDS), 60);
        }

        if (empty($fields)) {
            return $this->lastRequestSuccessful = false;
        }

        $data = $this->prepareData($data, $fields);

        $validator = ValidatorFacade::make($data, $this->prepareValidatorRules($fields));
        if ($validator->fails()) {
            $this->setMessages($validator->errors()->all());

            return $this->lastRequestSuccessful = false;
        }

        $this->call(self::METHOD_ADD_LEAD, [
            'fields' => $data,
        ]);

        return $this->lastRequestSuccessful;
    }

    /**
     * Send contact to CRM
     *
     * @param array $data
     *
     * @return bool
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
     * @throws Bitrix24Exception
     * @throws Bitrix24IoException
     * @throws Bitrix24MethodNotFoundException
     * @throws Bitrix24PaymentRequiredException
     * @throws Bitrix24PortalDeletedException
     * @throws Bitrix24SecurityException
     * @throws Bitrix24TokenIsInvalidException
     * @throws Bitrix24WrongClientException
     */
    public function sendContact(array $data): bool
    {
        if (empty($fields = Cache::get('contact-fields'))) {
            Cache::put('contact-fields', $fields = $this->call(self::METHOD_CONTACT_FIELDS), 60);
        }

        if (empty($fields)) {
            return $this->lastRequestSuccessful = false;
        }

        $data = $this->prepareData($data, $fields);

        $validator = ValidatorFacade::make($data, $this->prepareValidatorRules($fields));
        if ($validator->fails()) {
            $this->setMessages($validator->errors()->all());

            return $this->lastRequestSuccessful = false;
        }

        $this->call(self::METHOD_ADD_CONTACT, [
            'fields' => $data,
        ]);

        return $this->lastRequestSuccessful;
    }

    /**
     * Prepare data to send
     *
     * @param array $data
     * @param array $fieldInfo
     *
     * @return array
     */
    protected function prepareData(array $data, array $fieldInfo): array
    {
        foreach ($data as $key => $value) {
            $newKey = mb_strtoupper($key);
            if (isset($fieldInfo[$newKey])) {
                $data[$newKey] = isset($fieldInfo[$newKey]) ? $this->formatField($value, $fieldInfo[$newKey]) : $value;
                if ($key !== $newKey) {
                    unset($data[$key]);
                }
            }
        }

        return $data;
    }

    /**
     * @param mixed $data
     * @param array $fieldInfo
     *
     * @return mixed
     */
    protected function formatField($data, array $fieldInfo)
    {
        if ($fieldInfo['type'] === self::TYPE_CRM_MULTIFIELD) {
            $data = (array)$data;
            foreach ($data as $key => $value) {
                if (!\is_array($value)) {
                    $data[$key] = [
                        'VALUE'      => $value,
                        'VALUE_TYPE' => self::MULTIFIELD_DEFAULT_TYPE,
                    ];
                }
            }
        }

        return $data;
    }

    /**
     * Prepare rules for validator
     *
     * @param array $fieldsInfo
     *
     * @return array
     */
    protected function prepareValidatorRules(array $fieldsInfo): array
    {
        $rules = [];
        foreach ($fieldsInfo as $key => $fieldParams) {
            if ($fieldParams['isRequired']) {
                $rules[$key] = 'required';
            }
        }

        return $rules;
    }

    /**
     * @throws \Bitrix24\Exceptions\Bitrix24Exception
     */
    protected function getClient()
    {
        if ($this->client === null) {
            $this->client = new Bitrix24();
            $this->client->setApplicationId('fake');
            $this->client->setApplicationSecret('fake');
            $this->client->setDomain($this->getUrl());
            $this->client->setApplicationScope($this->getScope());
            $this->client->setRedirectUri('https://fake.crm.local');
        }

        return $this->client;
    }

    /**
     * Call to Api
     *
     * @param string $method
     * @param array  $params
     *
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
     * @throws Bitrix24Exception
     * @throws Bitrix24IoException
     * @throws Bitrix24MethodNotFoundException
     * @throws Bitrix24PaymentRequiredException
     * @throws Bitrix24PortalDeletedException
     * @throws Bitrix24SecurityException
     * @throws Bitrix24TokenIsInvalidException
     * @throws Bitrix24WrongClientException
     */
    protected function call(string $method, array $params = []): array
    {
        $response = null;
        try {
            $response = $this->getClient()->call($this->getHook() . $method, $params);
        } catch (Bitrix24TokenIsExpiredException $e) {
            $this->lastRequestSuccessful = false;
        }

        $result = [];
        $this->lastRequestSuccessful = true;
        if ($response && isset($response['error']) && !empty($response['error'])) {
            $this->setMessages((array)$response['error']);
            $this->lastRequestSuccessful = false;
            $result = (array)$response['error'];
        } elseif ($response && isset($response['result'])) {
            $this->setMessages((array)$response['result']);
            $result = (array)$response['result'];
        } else {
            $this->lastRequestSuccessful = false;
        }

        return $result;
    }

    /**
     * Check
     *
     * @param array  $data
     * @param string $entityType
     *
     * @return bool
     */
    protected function hasDuplicates(array $data, string $entityType = 'LEAD'): bool
    {
        $result = false;

        try {
            if (isset($data['EMAIL'])) {
                $checkResult = $this->call('crm.duplicate.findbycomm', [
                    'type'        => 'EMAIL',
                    'values'      => array_map(function ($item) {
                        return $item['VALUE'];
                    }, $data['EMAIL']),
                    'entity_type' => $entityType,
                ]);
                $result |= !empty($checkResult);
            }
            if (isset($data['PHONE'])) {
                $checkResult = $this->call('crm.duplicate.findbycomm', [
                    'type'        => 'PHONE',
                    'values'      => array_map(function ($item) {
                        return $item['VALUE'];
                    }, $data['PHONE']),
                    'entity_type' => $entityType,
                ]);
                $result |= !empty($checkResult);
            }
        } catch (\Exception $ex) {

        }

        return $result;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Bitrix24Service
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getScope(): array
    {
        return $this->scope;
    }

    /**
     * @param array $scope
     *
     * @return $this
     */
    public function setScope(array $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return (array)$this->messages;
    }

    /**
     * @param array $messages
     *
     * @return $this
     */
    public function setMessages(array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Check last request was successful
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->lastRequestSuccessful;
    }

    /**
     * Set service settings
     *
     * @param array $settings
     *
     * @return $this
     */
    public function setSettings(array $settings): CRMService
    {
        foreach ($settings as $key => $value) {
            $methodName = 'set' . camel_case($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }

        return $this;
    }

    /**
     * Get hook
     *
     * @return string
     */
    public function getHook(): ?string
    {
        return $this->hook;
    }

    /**
     * Set hook
     *
     * @param string $hook
     *
     * @return $this
     */
    public function setHook(string $hook): self
    {
        $this->hook = $hook;

        return $this;
    }

    /**
     * Get settings by key with dot notation
     *
     * @param string $key
     *
     * @param mixed  $default
     *
     * @return array
     */
    public function getSettings(string $key, $default = ''): array
    {
        return Arr::get($this->rawSettings, $key, $default);
    }
}