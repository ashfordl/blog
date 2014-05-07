<?php

Validator::extend('passcheck', function($field, $value, $params)
{
    if(Hash::check($value, Auth::user()->password))
        return true;
    else
        return false;
});
