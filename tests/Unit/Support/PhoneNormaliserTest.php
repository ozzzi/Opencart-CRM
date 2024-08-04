<?php

namespace Tests\Unit\Support;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PhoneNormaliserTest extends TestCase
{
    public function test_full_number(): void
    {
        $phone = '380911234567';

        $this->assertEquals($phone, phoneNormalise($phone));
    }

    public function test_clearing(): void
    {
        $phone = '38 (091) 123-45-67';

        $this->assertEquals('380911234567', phoneNormalise($phone));
    }

    public function test_short_number(): void
    {
        $phone = '091 123-45-67';

        $this->assertEquals('380911234567', phoneNormalise($phone));
    }

    public function test_too_shot_number(): void
    {
        $phone = '123-45-67';

        $this->expectException(InvalidArgumentException::class);

        phoneNormalise($phone);
    }

    public function test_foreign_number(): void
    {
        $phone = '+42 091 123-45-67';

        $this->expectException(InvalidArgumentException::class);

        phoneNormalise($phone);
    }
}
