<?php

declare(strict_types=1);

namespace Modules\Request\Services;

use Modules\Request\Data\RequestData;
use Modules\Request\Model\Request;
use Modules\Request\Repositories\RequestRepository;

class RequestCreateService
{
    public function __construct(private readonly RequestRepository $requestRepository)
    {
    }

    public function __invoke(RequestData $data): Request
    {
        return $this->requestRepository->store($data->toArray());
    }
}
