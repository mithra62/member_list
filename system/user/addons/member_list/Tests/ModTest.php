<?php

namespace Mithra62\MemberList\Tests;

use PHPUnit\Framework\TestCase;
use \Member_list;

class ModTest extends TestCase
{
    public function testModuleFileExists()
    {
        $file_name = realpath(PATH_THIRD.'/member_list/mod.member_list.php');
        $this->assertNotNull($file_name);
        require_once $file_name;
    }

    public function testModuleObjectExists()
    {
        $this->assertTrue(class_exists('\Member_list'));
    }

    public function testModInstance()
    {
        $this->assertInstanceOf('ExpressionEngine\Service\Addon\Module', new Member_list);
    }
}