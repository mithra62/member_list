<?php

namespace Mithra\MemberList\Tags;

class MemberListForm extends AbstractTag
{
    // Example tag: {exp:member_list:member_list_form}
    public function process()
    {
        $vars = [
            'first_name' => ee()->input->get('first_name'),
            'city' => ee()->input->get('city'),
            'last_name' => ee()->input->get('last_name'),
            'state' => ee()->input->get('state'),
            'country' => ee()->input->get('country'),
        ];

        if($vars['country'] == '') {
            //$vars['country'] = 'USA';
        }

        $return = ee()->TMPL->fetch_param('return');
        if(!$return) {
            $return = ee()->uri->uri_string;
        }

        $form_data = [
            'action' => ee()->functions->create_url($return),
            'secure' => false
        ];

        $form_data['class'] = ee()->TMPL->fetch_param('class');

        $output = ee()->functions->form_declaration($form_data);
        $output = str_replace('<form method="post"', '<form method="get"', $output);
        $output .= ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $vars);

        return $output . '</form>';
    }
}
