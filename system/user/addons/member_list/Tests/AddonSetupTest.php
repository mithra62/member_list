<?php
namespace Mithra62\MemberList\Tests;

use ExpressionEngine\Core\Provider;
use PHPUnit\Framework\TestCase;

class AddonSetupTest extends TestCase
{
    /**
     * @return void
     */
    public function testFileExists(): void
    {
        $file_name = realpath(PATH_THIRD.'/member_list/addon.setup.php');
        $this->assertNotNull($file_name);
    }

    /**
     * @return Provider
     */
    public function testAuthorValue(): Provider
    {
        $addon = ee('App')->get('member_list');
        $this->assertEquals('mithra62', $addon->getAuthor());
        return $addon;
    }

    /**
     * @depends testAuthorValue
     * @param Provider $addon
     * @return Provider
     */
    public function testNameValue(Provider $addon): Provider
    {
        $this->assertEquals('Member List', $addon->getName());
        return $addon;
    }

    /**
     * @depends testNameValue
     * @param Provider $addon
     * @return Provider
     */
    public function testNamespaceValue(Provider $addon): Provider
    {
        $this->assertEquals('Mithra62\MemberList', $addon->getNamespace());
        return $addon;
    }

    /**
     * @depends testNamespaceValue
     * @param Provider $addon
     * @return Provider
     */
    public function testSettingsValue(Provider $addon): Provider
    {
        $this->assertFalse($addon->get('settings_exist'));
        return $addon;
    }

    /**
     * @depends testSettingsValue
     * @param Provider $addon
     * @return Provider
     */
    public function testVersionConstDefined(Provider $addon): Provider
    {
        $this->assertTrue(defined('MEMBER_LIST_VERSION'));
        return $addon;
    }

    /**
     * @depends testVersionConstDefined
     * @param Provider $addon
     * @return Provider
     */
    public function testVersionValue(Provider $addon): Provider
    {
        $this->assertTrue($addon->get('version') == MEMBER_LIST_VERSION);
        return $addon;
    }
}