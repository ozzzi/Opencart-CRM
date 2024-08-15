<?php

declare(strict_types=1);

namespace Modules\Shipment\Novaposhta\Data;

class ResultData
{
    public function __construct(
        public readonly array $data,
        public readonly array $info
    ) {
    }
}
