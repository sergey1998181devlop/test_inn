<?php

namespace App\Components;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use Illuminate\Support\Arr;

class ApiFns implements ApiCheckInnInterface
{
    const ACTION_CHECK_INN = '/api/v1/tracker/taxpayer_status';

    private $client;

    public $baseUrl = 'https://statusnpd.nalog.ru:443';
    public $timeout = 5;

    /**
     * @param string $inn
     * @param Carbon $date
     * @return bool
     * @throws \Exception
     */
    public function checkInnFromApi(string $inn, Carbon $date): bool
    {
        $options = [
            RequestOptions::JSON => [
                'inn' => $inn,
                'requestDate' => $date->format('Y-m-d'),
            ],
        ];

        $response = $this->send('post', self::ACTION_CHECK_INN, $options);


        return Arr::get($response, 'status', false);
    }

    /**
     * @param string $method
     * @param string $action
     * @param array $options
     * @return array
     * @throws ApiCheckInnException
     */
    private function send(string $method, string $action, array $options): array
    {
        try {
            $response = $this->getClient()->request($method, $action, $options);

            return Utils::jsonDecode($response->getBody(), true);
        } catch (BadResponseException $e) {
            $response = Utils::jsonDecode($e->getResponse()->getBody(), true);
            throw new ApiCheckInnException(
                Arr::get($response, 'message', ''),
                Arr::get($response, 'code', ''),
            );
        } catch (GuzzleException $e) {
            throw new ApiCheckInnException($e->getMessage(), 'internal error');
        }
    }

    private function getClient(): Client
    {
        if (!$this->client instanceof Client) {
            $this->client = new Client([
                'base_uri' => $this->baseUrl,
                'timeout' => $this->timeout,
            ]);
        }

        return $this->client;
    }

}
