<?php
namespace Mithra62\MemberList\Tags;

use ExpressionEngine\Service\Addon\Controllers\Tag\AbstractRoute;

abstract class AbstractTag extends AbstractRoute
{
    /**
     * @var array
     */
    protected array $field_map = [];

    /**
     * @return array
     */
    protected function compileSearchableVars(): array
    {
        $vars = [];
        $query = ee()->db->select()->from('member_fields')->where(['m_field_search' => 'y'])->get();
        if($query->num_rows() >= 1) {
            foreach($query->result_array() AS $row) {
                $vars[$row['m_field_name']] = 'm_field_id_' . $row['m_field_id'];
            }
        }

        $this->field_map = $vars;
        $return = [];
        foreach($vars AS $key => $value) {
            $return[$key] = ee()->input->get($key);
        }

        return $return;
    }

    /**
     * @param string $field
     * @return string
     */
    protected function mapField(string $field): string
    {
        return $this->field_map[$field] ?? '';
    }
}