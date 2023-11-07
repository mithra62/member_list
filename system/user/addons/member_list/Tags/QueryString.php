<?php

namespace Mithra\MemberList\Tags;

class QueryString extends AbstractTag
{
    public function process()
    {
        return $_SERVER['QUERY_STRING'];
    }
}
