<?php
namespace Mithra62\MemberList\Tests\Tags;

use PHPUnit\Framework\TestCase;
use Mithra62\MemberList\Tags\AbstractTag;
use CI_DB_result;

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

    public function _mapField(string $field)
    {
        return $this->mapField($field);
    }

    public function _getFieldMap()
    {
        return $this->field_map;
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
     * @depends testCompileSearchVarsTotalItemsMatch
     * @param AbstractTag $obj
     * @return AbstractTag
     * @throws \Exception
     */
    public function testCompileSearchVarsAreValidSearchableFields(AbstractTag $obj): AbstractTag
    {
        $query = $this->getSearchableMemberFields();
        $vars = $obj->_compileSearchableVars();
        foreach($query->result_array() AS $key => $value) {
            $this->assertArrayHasKey($value['m_field_name'], $vars);
        }

        return $obj;
    }

    /**
     * @depends testCompileSearchVarsAreValidSearchableFields
     * @param AbstractTag $obj
     * @return AbstractTag
     */
    public function testCompileSearchVarsAreEmptyWithNoGet(AbstractTag $obj): AbstractTag
    {
        $vars = $obj->_compileSearchableVars();
        foreach($vars AS $key => $value) {
            $this->assertEmpty($value);
        }

        return $obj;
    }

    /**
     * @depends testCompileSearchVarsAreEmptyWithNoGet
     * @param AbstractTag $obj
     * @return AbstractTag
     * @throws \Exception
     */
    public function testCompileSearchVarsUseGetValues(AbstractTag $obj): AbstractTag
    {
        $query = $this->getSearchableMemberFields();
        $rand = rand(10,100);
        foreach($query->result_array() AS $key => $value) {
            $_GET[$value['m_field_name']] = $rand;
        }

        $vars = $obj->_compileSearchableVars();
        foreach($vars AS $key => $value) {
            $this->assertEquals($value, $rand);
        }

        return $obj;
    }

    /**
     * @return AbstractTag
     */
    public function testFieldMapIsArray()
    {
        $obj = new __abstract_tag_test_stub;
        $this->assertIsArray($obj->_getFieldMap());
        return $obj;
    }

    /**
     * @depends testFieldMapIsArray
     * @param AbstractTag $obj
     * @return AbstractTag
     */
    public function testFieldMapIsEmptyArrayByDefault(AbstractTag $obj): AbstractTag
    {
        $this->assertCount(0, $obj->_getFieldMap());
        return $obj;
    }

    /**
     * @depends testFieldMapIsEmptyArrayByDefault
     * @param AbstractTag $obj
     * @return AbstractTag
     */
    public function testFieldMapMatchesCompiledVarsCount(AbstractTag $obj): AbstractTag
    {
        $this->assertCount(count($obj->_compileSearchableVars()), $obj->_getFieldMap());
        return $obj;
    }

    /**
     * @return CI_DB_result
     * @throws \Exception
     */
    protected function getSearchableMemberFields(): CI_DB_result
    {
        $query = ee()->db->select()->from('member_fields')->where(['m_field_search' => 'y'])->get();
        if($query->num_rows() == 0) {
            throw new \Exception("There are no searchable member fields setup yet!");
        }

        return $query;
    }
}