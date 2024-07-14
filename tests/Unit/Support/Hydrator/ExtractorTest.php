<?php

declare(strict_types=1);

namespace Unit\Support\Hydrator;

use App\Support\Hydrator\Extractor;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\Support\FixtureSimple;

class ExtractorTest extends TestCase
{
    public function test_extract(): void
    {
        $model = new FixtureSimple('Bob', 'Bob Marley');

        $extractor = new Extractor();
        $data = $extractor->extract($model);

        $this->assertEquals(['name' => 'Bob', 'full_name' => 'Bob Marley'], $data);
    }
}
