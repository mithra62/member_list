<?php
namespace Mithra62\MemberList\Tests\Tags;

use PHPUnit\Framework\TestCase;
use Mithra62\MemberList\Tags\Results;

class ResultsTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Mithra62\MemberList\Tags\Results'));
    }

    public function testInstanceOfAbstractTag()
    {
        $this->assertInstanceOf('Mithra62\MemberList\Tags\AbstractTag', new Results);
    }

    public function testProcessMethodExists()
    {
        $this->assertTrue(class_exists('Mithra62\MemberList\Tags\Results', 'process'));;
    }
}