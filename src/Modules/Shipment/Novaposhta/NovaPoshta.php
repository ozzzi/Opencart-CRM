<?php

declare(strict_types=1);

namespace Modules\Shipment\Novaposhta;

use Illuminate\Support\Facades\Http;
use Modules\Shipment\Novaposhta\Data\ResultData;
use Modules\Shipment\Novaposhta\Exceptions\NovaPoshtaException;

class NovaPoshta
{
    private const URL = 'https://api.novaposhta.ua/v2.0/json/';

    protected string $model;

    protected string $method;

    protected ?array $data = null;

    private string $token;

    public function __construct()
    {
        $this->token = config('services.novaposhta.token');
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @throws NovaPoshtaException
     */
    public function get(?string $model = null, ?string $method = null, array $data = []): ResultData
    {
        if ($model && $method) {
            $this->model = $model;
            $this->method = $method;
            $this->data = $data;
        }

        $response = $this->request();

        return new ResultData(
            data: $response['data'],
            info: $response['info']
        );
    }

    /**
     * @throws NovaPoshtaException
     */
    private function request(): array
    {
        $body = [
            'apiKey' => $this->token,
            'modelName' => $this->model,
            'calledMethod' => $this->method,
            'methodProperties' => $this->data,
        ];

        try {
            $response = Http::timeout(3)
                ->retry(2, 500)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post(self::URL, $body)
                ->json();
        } catch (\Throwable $e) {
            throw new NovaPoshtaException($e->getMessage());
        }

        if (!$response['success']) {
            $errorMessage = $response['errors'][0] ?? $response['warnings'][0];

            throw new NovaPoshtaException($errorMessage);
        }

        return $response;
    }
}
