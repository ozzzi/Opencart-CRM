<?php

declare(strict_types=1);

namespace Unit\Support\Hydrator;

use App\Enums\Store;
use App\Support\Hydrator\Hydrator;
use DateTime;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\Support\FixtureDateTimeProp;
use Tests\Fixtures\Support\FixtureEnumProp;
use Tests\Fixtures\Support\FixtureSimple;

class HydratorTest extends TestCase
{
    public function test_simple_object(): void
    {
        $hydrator = new Hydrator();

        $data = [
            'name' => 'Bob',
            'full_name' => 'Bob Marley',
            'no_prop' => 'demo',
        ];

        $model = $hydrator->hydrate($data, FixtureSimple::class);

        $this->assertEquals('Bob', $model->name);
        $this->assertEquals('Bob Marley', $model->fullName);
    }

    public function test_datetime_unixtime_property(): void
    {
        $hydrator = new Hydrator();

        $data = ['created_at' => 1709279028];

        $model = $hydrator->hydrate($data, FixtureDateTimeProp::class);

        $this->assertEquals(new DateTime('@1709279028'), $model->createdAt);
    }

    public function test_enum_property(): void
    {
        $hydrator = new Hydrator();

        $data = ['store' => 'wildbear'];

        $model = $hydrator->hydrate($data, FixtureEnumProp::class);

        $this->assertEquals(Store::Wildbear, $model->store);
    }

    public function test_different_props_name(): void
    {
        $hydrator = new Hydrator([
            'user_name' => 'name',
        ]);

        $data = [
            'user_name' => 'Bob',
            'full_name' => 'Bob Marley',
        ];

        $model = $hydrator->hydrate($data, FixtureSimple::class);

        $this->assertEquals('Bob', $model->name);
    }
}
