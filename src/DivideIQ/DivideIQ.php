<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\DivideIQ;

use Exception;
use Nthmedia\TransformToArray\TransformToArray;

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
        return TransformToArray::convert(parent::request($serviceName, $payload, $method));
    }
}
