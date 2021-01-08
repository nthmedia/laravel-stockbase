<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\DivideIQ;

use Exception;

class DivideIQ extends \DivideBV\PHPDivideIQ\DivideIQ
{
    /**
     * The DivideIQ request does json_encode into an object. We don't
     * need that object but an array.
     *
     * @param string $serviceName
     * @param array $payload
     * @param string $method
     * @return array
     * @throws Exception
     */
    public function request($serviceName, $payload = [], $method = 'GET'): array
    {
        return $this->toArray(parent::request($serviceName, $payload, $method));
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function toArray($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            return array_map([$this, __FUNCTION__], $data);
        }

        return $data;
    }
}
