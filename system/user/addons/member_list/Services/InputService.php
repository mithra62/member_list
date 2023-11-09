<?php
namespace Mithra62\MemberList\Services;

class InputService
{
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed|string
     */
    public function param(string $key, $default = '')
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
    public function shouldProcess(array $search_fields): bool
    {
        foreach($search_fields AS $value) {
            if($value != '') {
                return true;
            }
        }

        return false;
    }
}