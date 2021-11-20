<?php

namespace App\Service;

use DateTime;

/**
 * Class Validator
 * @package App\Service
 */
class Validator
{
    /**
     * Validate request
     *
     * @param array $params
     * @return bool|string
     */
    public function isValid(array $params)
    {
        if (!isset($params['hotel']) || intval($params['hotel']) == 0) {
            return 'A valid hotel value is required.';
        } elseif (empty($params['fromDate'])
            || $params['fromDate'] === null
            || $params['fromDate'] == 0
            || !$this->validateDate($params['fromDate'])) {
            return 'A valid fromDate is required.';
        } elseif (
            empty($params['toDate'])
            || is_null($params['toDate'])
            || $params['toDate'] == 0
            || !$this->validateDate($params['toDate'])) {
            return 'A valid toDate is required.';
        }

        return true;
    }

    /**
     * Check request date is valid
     *
     * @param $date
     * @param string $format
     * @return bool
     */
    private function validateDate($date, $format = 'Y-m-d'): bool
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }
}
