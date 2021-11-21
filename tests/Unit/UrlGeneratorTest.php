<?php

namespace Tests\Unit;

use Tests\TestCase;

class UrlGeneratorTest extends TestCase
{
    /** @test */
    public function it_appends_query_parameters_to_the_url(): void
    {
        $this->assertEquals(
            url()->full() . '/?to=here', 
            url()->append(['to' => 'here'])
        );
    }
}
