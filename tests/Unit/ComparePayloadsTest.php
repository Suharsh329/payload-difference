<?php

namespace Tests\Unit;

use Tests\TestCase;

class ComparePayloadsTest extends TestCase
{

    /**
     * Test with both payloads empty
     */
    public function test_two_empty_payloads(): void
    {
        //Arrange
        $firstPayload = json_decode('{}', true);
        $secondPayload = json_decode('{}', true);

        //Act
        $actual = comparePayloads($firstPayload, $secondPayload);

        //Assert
        $this->assertEmpty($actual);
    }

    /**
     * Test function with first payload empty
     */
    public function test_first_payload_empty(): void
    {
        //Arrange
        $expected = json_decode('{"name":"me","age":"40"}', true);
        $firstPayload = json_decode('{}', true);
        $secondPayload = json_decode('{"name":"me","age":"40"}', true);

        //Act
        $actual = comparePayloads($firstPayload, $secondPayload);

        //Assert
        $this->assertNotEmpty($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test function with second payload empty
     */
    public function test_second_payload_empty(): void
    {
        //Arrange
        $expected = json_decode('{"name":"me","age":"40"}', true);
        $firstPayload = json_decode('{"name":"me","age":"40"}', true);
        $secondPayload = json_decode('{}', true);

        //Act
        $actual = comparePayloads($firstPayload, $secondPayload);

        //Assert
        $this->assertNotEmpty($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that two same payloads will have no difference i.e. empty result
     */
    public function test_same_payloads(): void
    {
        //Arrange
        $firstPayload = json_decode('{"name":"me","age":"40"}', true);
        $secondPayload = json_decode('{"name":"me","age":"40"}', true);

        //Act
        $actual = comparePayloads($firstPayload, $secondPayload);

        //Assert
        $this->assertEmpty($actual);
    }

    /**
     * Test payloads with different keys
     * Will return first payload
     */
    public function test_completely_different_payloads(): void
    {
        //Arrange
        $expected = json_decode('{"dance":"art", "physics":"science"}', true);
        $firstPayload = json_decode('{"dance":"art", "physics":"science"}', true);
        $secondPayload = json_decode('{"calamity":"earthquake", "scale":"4"}', true);

        //Act
        $actual = comparePayloads($firstPayload, $secondPayload);

        //Assert
        $this->assertEquals($expected, $actual);
    }
}
