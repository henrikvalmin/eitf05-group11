<?php

function csrf_token()
{
    return hash('sha256', session_id());
}

function check_token($token)
{
    return $token == csrf_token();
}

function csrf_input_field()
{
    return "<input type='hidden' name='csrf_token' value='" . csrf_token() . "'>";
}
