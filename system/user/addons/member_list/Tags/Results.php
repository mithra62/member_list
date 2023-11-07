<?php

namespace Mithra62\MemberList\Tags;

class Results extends AbstractTag
{
    /**
     * @return string
     */
    public function process(): string
    {
        $limit = $this->param('limit', 20);
        $order_by = $this->param('order_by', 'member_id');
        $sort = $this->param('sort', 'desc');
        $role_id = $this->param('role_id');
        $prefix = $this->param('prefix', 'G');
        $url_segment = ee()->TMPL->fetch_param('url_segment', 2);
        $segment = ee()->uri->segment($url_segment);
        $offset = str_replace($prefix, '', $segment);
        if(!$offset) {
            $offset = 0;
        }

        $search_fields = $this->compileSearchableVars();
        if(!$this->shouldProcess($search_fields)) {
            return ee()->TMPL->no_results();
        }

        $members = ee('Model')
            ->get('Member')
            ->order($order_by, $sort);

        foreach($search_fields AS $key => $value) {
            if($value && $this->mapField($key)) {
                $field = $this->mapField($key);
                $members->filter($field, $value);
            }
        }

        if($role_id) {
            $roles = explode('|', $role_id);
            $role_ids = $this->getRoleMembers($roles);
            if($role_ids) {
                $members->filter('member_id', 'IN', $role_ids);
            }
        }

        $total_members = $members->count();
        if($members->count() == 0) {
            return ee()->TMPL->no_results();
        }

        $members->offset($offset)
            ->limit($limit);

        $data = [];
        $fields = $this->getMemberFields();
        if($fields) {
            foreach($members->all() AS $member) {
                $temp = $member->toArray();
                foreach($fields AS $key => $value) {
                    if(array_key_exists($key, $temp)) {
                        $temp[$value] = $temp[$key];
                    }
                }

                $temp['query_string'] = $_SERVER['QUERY_STRING'];
                $data[] = $temp;
            }
        }

        ee()->load->library('pagination');
        $pagination = ee()->pagination->create();

        ee()->TMPL->tagdata = $pagination->prepare(ee()->TMPL->tagdata);
        $pagination->prefix = $prefix;

        $total_items = $total_members;
        $per_page = $limit;
        $pagination->build($total_items, $per_page);
        $body = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $data);

        return $pagination->render($body);
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed|string
     */
    protected function param(string $key, $default = '')
    {
        $return = $default;
        if(ee()->input->get($key)) {
            $return = ee()->input->get($key);
        }

        if(ee()->TMPL->fetch_param($key)) {
            $return = ee()->TMPL->fetch_param($key);
        }

        return $return;
    }

    /**
     * @param array $search_fields
     * @return bool
     */
    protected function shouldProcess(array $search_fields): bool
    {
        foreach($search_fields AS $value) {
            if($value != '') {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $roles
     * @return array
     */
    protected function getRoleMembers(array $roles): array
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

    protected function getMemberFields(): array
    {
        $return = [];
        $query = ee()->db->select()->from('member_fields')->get();
        if($query->num_rows() >= 1) {
            foreach($query->result_array() AS $row) {
                $return['m_field_id_' . $row['m_field_id']] = $row['m_field_name'];
            }
        }

        return $return;
    }
}
