<?php

namespace Mithra62\MemberList\Tags;

class QueryString extends AbstractTag
{
    public function process()
    {
        return $_SERVER['QUERY_STRING'];
    }
}
