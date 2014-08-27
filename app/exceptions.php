<?php

/**
 * Display custom error messages for select errors
 */
App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);

        case 404:
            return Response::view('errors.404', array(), 404);

        // Else return null, allow Laravel to continue with default error handlers
        default:
            return null;
    }
});