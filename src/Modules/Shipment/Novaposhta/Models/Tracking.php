<?php

declare(strict_types=1);

namespace Modules\Shipment\Novaposhta\Models;

use Modules\Shipment\Novaposhta\NovaPoshta;

class Tracking extends NovaPoshta
{
    protected string $model = 'TrackingDocument';

    public function status(string $number, int $phone): self
    {
        $this->method = 'getStatusDocuments';

        $this->data = [
            [
                'DocumentNumber' => $number,
                'Phone' => $phone,
            ],
        ];

        return $this;
    }
}
