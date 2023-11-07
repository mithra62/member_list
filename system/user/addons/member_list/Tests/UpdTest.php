<?php

namespace Mithra62\MemberList\Tests;

use PHPUnit\Framework\TestCase;
use Member_list_upd;

class UpdTest extends TestCase
{
    public function testUpdFileExists()
    {
        $file_name = realpath(PATH_THIRD.'/member_list/upd.member_list.php');
        $this->assertNotNull($file_name);
        require_once $file_name;
    }

    public function testUpdObjectExists(): void
    {
        $this->assertTrue(class_exists('\Member_list_upd'));
    }

    /**
     * @return Member_list_upd
     */
    public function testHasCpBackendPropertyExists(): Member_list_upd
    {
        $cp = new \Member_list_upd();
        $this->assertObjectHasAttribute('has_cp_backend', $cp);
        return $cp;
    }

    /**
     * @depends testHasCpBackendPropertyExists
     * @param Member_list_upd $cp
     * @return Member_list_upd
     */
    public function testCpBackendPropertyValue(Member_list_upd $cp): Member_list_upd
    {
        $this->assertEquals('n', $cp->has_cp_backend);
        return $cp;
    }

    /**
     * @depends testCpBackendPropertyValue
     * @return Member_list_upd
     */
    public function testPublishFieldsPropertyExists(Member_list_upd $cp): Member_list_upd
    {
        $this->assertObjectHasAttribute('has_publish_fields', $cp);
        return $cp;
    }

    /**
     * @depends testPublishFieldsPropertyExists
     * @param Member_list_upd $cp
     * @return Member_list_upd
     */
    public function testPublishFieldsPropertyValue(Member_list_upd $cp): Member_list_upd
    {
        $this->assertEquals('n', $cp->has_publish_fields);
        return $cp;
    }

    /**
     * @depends testPublishFieldsPropertyValue
     * @param Member_list_upd $cp
     * @return Member_list_upd
     */
    public function testInstance(Member_list_upd $cp): Member_list_upd
    {
        $this->assertInstanceOf('ExpressionEngine\Service\Addon\Installer', new Member_list_upd);
        return $cp;
    }

    /**
     * @depends testInstance
     * @param Member_list_upd $cp
     * @return Member_list_upd
     */
    public function testInstallMethodExists(Member_list_upd $cp): Member_list_upd
    {
        $this->assertTrue(method_exists($cp, 'install'));
        return $cp;
    }

    /**
     * @depends testInstallMethodExists
     * @param Member_list_upd $cp
     * @return Member_list_upd
     */
    public function testUninstallMethodExists(Member_list_upd $cp): Member_list_upd
    {
        $this->assertTrue(method_exists($cp, 'uninstall'));
        return $cp;
    }

    /**
     * @depends testUninstallMethodExists
     * @param Member_list_upd $cp
     * @return Member_list_upd
     */
    public function testUpdateMethodExists(Member_list_upd $cp): Member_list_upd
    {
        $this->assertTrue(method_exists($cp, 'update'));
        return $cp;
    }
}