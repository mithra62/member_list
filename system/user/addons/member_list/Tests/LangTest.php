<?php
namespace Mithra62\MemberList\Tests;

use PHPUnit\Framework\TestCase;

class LangTest extends TestCase
{
    public function testLangFileExists(): void
    {
        $file_name = realpath(PATH_THIRD.'/member_list/language/english/member_list_lang.php');
        $this->assertNotNull($file_name);
    }

    public function testLangFormat(): void
    {
        $file_name = realpath(PATH_THIRD.'/member_list/language/english/member_list_lang.php');
        include $file_name;
        $this->assertTrue(isset($lang));
    }

    public function testNameKeyExists(): array
    {
        $file_name = realpath(PATH_THIRD.'/member_list/language/english/member_list_lang.php');
        $lang = [];
        include $file_name;
        $this->assertArrayHasKey('member_list_module_name', $lang);
        return $lang;
    }

    /**
     * @depends testNameKeyExists
     * @param array $lang
     * @return array
     */
    public function testDescKeyExists(array $lang): array
    {
        $this->assertArrayHasKey('member_list_module_description', $lang);
        return $lang;
    }
}