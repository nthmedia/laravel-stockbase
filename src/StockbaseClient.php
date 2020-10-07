<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase;

use Exception;
use Nthmedia\Stockbase\Contracts\StockbaseClientContract;
use Nthmedia\Stockbase\DivideIQ\DivideIQ;
use Nthmedia\Stockbase\Exceptions\StockbaseClientException;
use Webmozart\Assert\Assert;

/**
 * Stockbase API client.
 */
class StockbaseClient implements StockbaseClientContract
{
    public const STOCKBASE_STOCK_ENDPOINT = 'stockbase_stock';
    public const STOCKBASE_IMAGES_ENDPOINT = 'stockbase_images';
    public const STOCKBASE_ORDER_REQUEST_ENDPOINT = 'stockbase_orderrequest';

    /**
     * @var DivideIQ
     */
    private $divideIqClient;

    /**
     * StockbaseClient constructor.
     * @param DivideIQ $divideIqClient
     */
    public function __construct(DivideIQ $divideIqClient)
    {
        $this->divideIqClient = $divideIqClient;
    }

    /**
     * Gets current Stockbase stock state.
     *
     * @param \DateTime|null $since
     * @param \DateTime|null $until
     * @return array
     * @throws Exception
     */
    public function getStock(?\DateTime $since = null, ?\DateTime $until = null): array
    {
        $data = [];
        if ($since !== null) {
            $data['Since'] = $since->getTimestamp();
        }
        if ($until !== null) {
            $data['Until'] = $until->getTimestamp();
        }

        return $this->divideIqClient->request(self::STOCKBASE_STOCK_ENDPOINT, $data);
    }

    /**
     * Gets images for specified EANs.
     *
     * @param string[] $eans
     * @return array
     * @throws Exception
     */
    public function getImages(array $eans): array
    {
        Assert::allNumeric($eans);

        $data = [
            'ean' => implode(',', $eans),
        ];

        return $this->divideIqClient->request(self::STOCKBASE_IMAGES_ENDPOINT, $data);
    }

    /**
     * Downloads a file using current client configuration and saves it at the specified destination.
     *
     * @param string $uri File URI.
     * @param string $destination Destination where the file should be saved to.
     */
    public function downloadImage(string $uri, string $destination): void
    {
        $this->divideIqClient->download($uri, $destination);
    }

    /**
     * Creates an order on Stockbase from reserved items for specified Magento order.
     *
     * @param array $order
     * @return array
     * @throws Exception
     */
    public function createOrder(array $order): array
    {
        $response = $this->divideIqClient->request(self::STOCKBASE_ORDER_REQUEST_ENDPOINT, $order, 'POST');

        if ($response['StatusCode'] !== 1) {
            $message = '';
            if (isset($response['Items']) && is_array($response['Items'])) {
                foreach ($response['Items'] as $item) {
                    if ($item['StatusCode'] !== 1) {
                        $message .= ' ' . trim($item['ExceptionMessage']);
                    }
                }
            }
            throw new StockbaseClientException('Failed sending order to Stockbase.'.$message);
        }

        return $response;
    }
}
