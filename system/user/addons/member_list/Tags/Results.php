<?php

namespace Mithra62\MemberList\Tags;

class Results extends AbstractTag
{
    /**
     * @return string
     */
    public function process(): string
    {
        $limit = ee('member_list:InputService')->param('limit', 20);
        $order_by = ee('member_list:InputService')->param('order_by', 'member_id');
        $sort = ee('member_list:InputService')->param('sort', 'desc');
        $role_id = ee('member_list:InputService')->param('role_id');
        $prefix = ee('member_list:InputService')->param('prefix', 'M');
        $url_segment = ee()->TMPL->fetch_param('url_segment', 2);
        $segment = ee()->uri->segment($url_segment);
        $offset = str_replace($prefix, '', $segment);
        if(!$offset) {
            $offset = 0;
        }

        $search_fields = $this->compileSearchableVars();
        if(!ee('member_list:InputService')->shouldProcess($search_fields)) {
            return ee()->TMPL->no_results();
        }

        $members = ee('Model')
            ->get('Member');

        if($order_by) {
            $order_by = $this->mapField($order_by);
        }

        if(!$order_by) {
            $order_by = 'member_id';
        }

        foreach($search_fields AS $key => $value) {
            if($value && $this->mapField($key)) {
                $field = $this->mapField($key);
                $members->filter($field, $value);
            }
        }

        if($role_id) {
            $roles = explode('|', $role_id);
            $role_ids = ee('member_list:MemberService')->getRoleMembers($roles);
            if($role_ids) {
                $members->filter('member_id', 'IN', $role_ids);
            }
        }

        $total_members = $members->count();
        if($members->count() == 0) {
            return ee()->TMPL->no_results();
        }

        $members->order($order_by, $sort)
            ->offset($offset)
            ->limit($limit);

        $data = [];
        $fields = ee('member_list:MemberService')->getMemberFields();
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

        $pagination->build($total_members, $limit);
        $body = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $data);

        return $pagination->render($body);
    }
}
