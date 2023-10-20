<?php

namespace RozetkaPay\Helper;

use DateTime;
use InvalidArgumentException;

class Validation {
    
    public static function validateRequiredParams($params, $required, $dateFormat = 'Y-m-d') {

        foreach ($required as $key => $param) {

            if (is_array($param))
                self::validateRequiredParams($params[$key], $param);
            if (!array_key_exists($key, $params)) {
                throw new InvalidArgumentException(sprintf('Required param "%s" is missing', $key));
            }
            if (array_key_exists($key, $required) && empty($param)) {
                throw new InvalidArgumentException(sprintf('Required param "%s" is empty', $key));
            }
            switch ($param) {
                case 'int':
                    self::validateInteger($params[$key], $key);
                    break;
                    break;
                case 'string':
                    self::validateString($params[$key], $key);
                    break;
                case 'date':
                    self::validateDate($params[$key], $key, $dateFormat);
                    break;
                case 'ccnumber':
                    self::validateCCard($params[$key]);
                    break;
            }
        }

        return true;
    }

    
    public static function validateURL($url) {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException(sprintf("%s is not a fully qualified URL", $url));
        }
    }

    
    public static function validateDate($date, $key, $format) {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) == $date) {
            return true;
        } else {
            throw new InvalidArgumentException(sprintf('Date %s is incorrect! Accepted format is: %s', $key, $format));
        }
    }

    
    public static function validateInteger($param, $key = '') {
        
        if (trim($param) != null && !is_numeric($param)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid numeric', $key));
        }
    }

    
    public static function validateString($param, $key = '') {
        if ($key !== 'external_id' && $param != null && !is_string($param)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid string', $key));
        }
        if ($key === 'external_id' && $param == null) {
            throw new InvalidArgumentException(sprintf('%s is not a valid string', $key));
        }
    }

}
