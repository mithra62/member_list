<?php
namespace Mithra62\MemberList\Tests\Tags;

use PHPUnit\Framework\TestCase;
use Mithra62\MemberList\Tags\AbstractTag;

class __abstract_tag_test_stub extends AbstractTag
{
    public function process()
    {
        // TODO: Implement process() method.
    }

    public function _compileSearchableVars(): array
    {
        return $this->compileSearchableVars();
    }
}

class AbstractTagTest extends TestCase
{
    public function testProcessMethodExists(): AbstractTag
    {
        $obj = new __abstract_tag_test_stub;
        $this->assertTrue(method_exists($obj, 'compileSearchableVars'));
        return $obj;
    }

    /**
     * @depends testProcessMethodExists
     * @param AbstractTag $obj
     * @return AbstractTag
     */
    public function testFieldMapPropertyExists(AbstractTag $obj): AbstractTag
    {
        $this->assertObjectHasAttribute('field_map', $obj);
        return $obj;
    }

    /**
     * @depends testFieldMapPropertyExists
     * @param AbstractTag $obj
     * @return AbstractTag
     */
    public function testCompileSearchVarsTotalItemsMatch(AbstractTag $obj): AbstractTag
    {
        $query = $this->getSearchableMemberFields();
        $this->assertCount($query->num_rows(), $obj->_compileSearchableVars());
        return $obj;
    }

    /**
     * @return mixed
     */
    protected function getSearchableMemberFields()
    {
        return ee()->db->select()->from('member_fields')->where(['m_field_search' => 'y'])->get();
    }
}