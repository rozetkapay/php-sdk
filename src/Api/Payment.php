<?php

namespace RozetkaPay\Api;

use RozetkaPay\Model\ResponsesError;
use RozetkaPay\Model\Payment\Responses;
use RozetkaPay\Model\Payment\ResponsesInfo;

class Payment extends \RozetkaPay\Api\Api {

    protected $url = '/payments';

    public function info($external_id) {

        $requiredParams = [
            'external_id' => 'string',
        ];

        $external_id = $this->externalIdToStr($external_id);

        list($result, $error) = $this->Request('GET', "/info?external_id=" . $external_id, [], ['external_id' => $external_id], false);

        if ($result !== false) {
            $result = new ResponsesInfo($result);
        }

        return [$result, $error];
    }

    /**
     * 
     * @param \RozetkaPay\Model\RequestCreatePay $params
     * @return \RozetkaPay\Model\Payment\Responses array[0] 
     */
    public function create($params) {

        $requiredParams = [
            'amount' => 'int',
            'currency' => 'string',
            'external_id' => 'string',
            'mode' => 'string',
        ];

        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);

        return $this->Request('POST', "/new", [], $params);
    }

    /**
     * 
     * @param \RozetkaPay\Model\Payment\Request $params
     * @return array [\RozetkaPay\Model\Payment\Responses,\RozetkaPay\Model\ResponsesError]
     */
    public function confirm($params) {

        $requiredParams = [
            'external_id' => 'string',
        ];

        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);

        return $this->Request('POST', "/confirm", [], $params);
    }

    /**
     * 
     * @param \RozetkaPay\Model\Request $params
     * @return array [\RozetkaPay\Model\Payment\Responses,\RozetkaPay\Model\ResponsesError]
     */
    public function cancel($params) {

        $requiredParams = [
            'external_id' => 'string',
        ];

        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);

        return $this->Request('POST', "/cancel", [], $params);
    }

    /**
     * 
     * @param \RozetkaPay\Model\Payment\RequestRefund $params
     * @return array [\RozetkaPay\Model\Payment\Responses,\RozetkaPay\Model\ResponsesError]
     */
    public function refund($params) {

        $requiredParams = [
            'external_id' => 'string',
        ];

        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);

        return $this->Request('POST', "/refund", [], $params);
    }

    /**
     * 
     * @return \RozetkaPay\Model\Payment\Responses array(0)
     */
    public function callbacks() {

        $result = $this->jsonToArray(file_get_contents('php://input'));
        
        if (empty($result)) {
            return [false, false];
        }
        
        if($this->getSignature(file_get_contents('php://input')) !== $this->getHeaderSignature()){
            return [false, false];
        }

        if (isset($result['code']) || empty($result)) {
            return [false, new \RozetkaPay\Model\ResponsesError($result)];
        } else {
            return [new Responses($result), false];
        }
    }

    public function Request($method, $url, $headers = [], $params = [], $isConvertResponses = true) {

        list($result, $error) = parent::Request($method, $url, $headers, $params);

        if ($isConvertResponses && $result !== false) {
            $result = new Responses($result);
        }

        return [$result, $error];
    }
}
