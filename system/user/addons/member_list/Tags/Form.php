<?php

namespace Mithra\MemberList\Tags;

class Form extends AbstractTag
{
    public function process()
    {
        $vars = $this->compileSearchableVars();
        $return = ee()->TMPL->fetch_param('return');
        if(!$return) {
            $return = ee()->uri->uri_string;
        }

        $form_data = [
            'action' => ee()->functions->create_url($return),
            'secure' => false,
            'class' => ee()->TMPL->fetch_param('class')
        ];

        $output = ee()->functions->form_declaration($form_data);
        $output = str_replace('<form method="post"', '<form method="get"', $output);
        $output .= ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $vars);

        return $output . '</form>';
    }
}
