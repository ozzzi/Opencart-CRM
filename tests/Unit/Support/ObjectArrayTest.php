<?php

namespace Tests\Unit\Support;

use App\Support\Traits\ObjectArray;
use Illuminate\Contracts\Support\Arrayable;
use PHPUnit\Framework\TestCase;

class ObjectArrayTest extends TestCase
{
    public function test_snake_case(): void
    {
        $object = new class () {
            use ObjectArray;

            public int $id = 5;

            public string $firstName = 'Pikka';
        };

        $resultArray = $object->toArray();

        $this->assertEquals(['id' => 5, 'first_name' => 'Pikka'], $resultArray);
    }

    public function test_nested_objects(): void
    {
        $object = new class () implements Arrayable {
            use ObjectArray;

            public array $products;

            public function __construct()
            {
                $this->products = [
                    new class () implements Arrayable {
                        use ObjectArray;

                        public float $price = 5;
                    },
                    new class () implements Arrayable {
                        use ObjectArray;

                        public float $price = 10;
                    }
                ];
            }
        };

        $resultArray = $object->toArray();

        $this->assertEquals(['products' => [['price' => 5], ['price' => 10]]], $resultArray);
    }
}