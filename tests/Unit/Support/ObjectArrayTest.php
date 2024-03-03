<?php

namespace Tests\Unit\Support;

use App\Support\Traits\ObjectArray;
use PHPUnit\Framework\TestCase;

class ObjectArrayTest extends TestCase
{
    public function test_to_array(): void
    {
       $object = new class {
           use ObjectArray;

           public int $id = 5;

           public string $firstName = 'Pikka';
       };

       $resultArray = $object->toArray();

       $this->assertEquals(['id' => 5, 'first_name' => 'Pikka'], $resultArray);
    }
}
