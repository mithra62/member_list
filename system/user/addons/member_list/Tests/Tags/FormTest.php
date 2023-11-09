<?php
namespace Mithra62\MemberList\Tests\Tags;

use PHPUnit\Framework\TestCase;
use Mithra62\MemberList\Tags\Form;

class FormTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Mithra62\MemberList\Tags\Form'));
    }

    public function testInstanceOfAbstractTag()
    {
        $this->assertInstanceOf('Mithra62\MemberList\Tags\AbstractTag', new Form);
    }

    public function testProcessMethodExists()
    {
        $this->assertTrue(class_exists('Mithra62\MemberList\Tags\Form', 'process'));;
    }
}