<?php
namespace Mithra62\MemberList\Tests\Tags;

use PHPUnit\Framework\TestCase;
use Mithra62\MemberList\Tags\QueryString;

class QueryStringTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Mithra62\MemberList\Tags\QueryString'));
    }

    public function testInstanceOfAbstractTag()
    {
        $this->assertInstanceOf('Mithra62\MemberList\Tags\AbstractTag', new QueryString);
    }

    public function testProcessMethodExists()
    {
        $this->assertTrue(class_exists('Mithra62\MemberList\Tags\QueryString', 'process'));;
    }
}