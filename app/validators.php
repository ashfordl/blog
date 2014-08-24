<?php

/**
 * Validates that the given value, when hashed, is the same as the
 * current user's password hash.
 */

Validator::extend('passcheck', function($field, $value, $params)
{
    if(Hash::check($value, Auth::user()->password))
        return true;
    else
        return false;
});
