<?php

/**
 * Validates that the given value is the user's password.
 *
 * Uses the built in Hash::check function to validate that the hashed value
 * is the same as the stored password hash.
 */
Validator::extend('passcheck', function($field, $value, $params)
{
    if(Hash::check($value, Auth::user()->password))
        return true;
    else
        return false;
});
