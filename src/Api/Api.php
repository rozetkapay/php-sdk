<?php

namespace RozetkaPay\Api;

use RozetkaPay\Configuration;
use RozetkaPay\Exception\ApiException;
use RozetkaPay\Helper;

class Api {

    protected $url = '';
    protected $client;
    protected $version;
    protected $login;
    protected $password;

    public function __construct() {
        $this->client = Configuration::getHttpClient();
    }

    public function Request($method, $url, $headers = [], $params = []) {

        $result = [];

        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Basic ' . Configuration::getBasicAuth();

        if (isset($params->callback_url) && empty($params->callback_url)) {
            $params->callback_url = Configuration::getCallbackUrl();
        }

        if (isset($params->result_url) && empty($params->result_url)) {
            $params->result_url = Configuration::getResultUrl();
        }

        $params = $this->toJSON($params);

        $url = $this->createUrl($url);

        $response = $this->client->request($method, $url, $headers, $params);

        if (!$response) {
            throw new ApiException('Unknown error.');
        }

        $result = $this->jsonToArray($response);

        $error = false;
        if (isset($result['code'])) {
            $error = new \RozetkaPay\Model\ResponsesError($result);
            $result = false;
        }

        return [$result, $error];
    }

    /**
     * 
     * @return string
     */
    public function getHeaderSignature() {
        $headers = array_change_key_case(getallheaders(), CASE_UPPER);
        return isset($headers["X-ROZETKAPAY-SIGNATURE"]) ? $headers["X-ROZETKAPAY-SIGNATURE"] : "";
    }

    protected function createUrl($url) {
        return Configuration::getApiUrl() . $this->url . Configuration::getApiVersionUrl() . $url;
    }
    
    /**
     * 
     * @param string $data
     * @return string
     */
    public function getSignature($data) {
        
        if(gettype($data) !== "string"){            
            $data = $this->toJSON($data);            
        }
        
        return strtr(base64_encode(sha1(Configuration::getPassword() . strtr(base64_encode($data), '+/', '-_') . Configuration::getPassword(), true)), '+/', '-_');
    }

    public function toJSON($data) {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function jsonToArray($data) {
        return json_decode($data, TRUE);
    }

    protected function validate($params, $required, $dateFormat = '') {
        Helper\Validation::validateRequiredParams((array) $params, $required, $dateFormat);
    }

    protected function prepareParams($params) {

        $prepared_params = (array) $params;

        if (isset($prepared_params['merchant_data']) && is_array($prepared_params['merchant_data'])) {
            $prepared_params['merchant_data'] = Helper\ApiHelper::toJSON($prepared_params['merchant_data']);
        }

        if (isset($prepared_params['recurring_data']) && $this->version === '1.0')
            throw new \InvalidArgumentException('Reccuring_data allowed only for api version \'2.0\'');

        if (isset($prepared_params['reservation_data']) && is_array($prepared_params['reservation_data'])) {
            $prepared_params['reservation_data'] = base64_encode(Helper\ApiHelper::toJSON($prepared_params['reservation_data']));
        }

        return $prepared_params;
    }

    protected function externalIdToStr($external_id) {
        return "" . $external_id . "";
    }
}
