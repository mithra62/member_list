<?php
namespace Mithra62\MemberList\Services;

class MemberService
{
    /**
     * @param array $roles
     * @return array
     */
    public function getRoleMembers(array $roles): array
    {
        $return = [];
        $query = ee()->db->select()->from('members_roles')
            ->where_in('role_id', $roles)
            ->get();

        if($query->num_rows() >= 1) {
            foreach( $query->result_array() AS $result) {
                $return[] = $result['member_id'];
            }
        }

        return $return;
    }

    /**
     * @return array
     */
    public function getMemberFields(): array
    {
        $return = [];
        $query = ee()->db->select()->from('member_fields')->where(['m_field_public' => 'y'])->get();
        if($query->num_rows() >= 1) {
            foreach($query->result_array() AS $row) {
                $return['m_field_id_' . $row['m_field_id']] = $row['m_field_name'];
            }
        }

        return $return;
    }
}