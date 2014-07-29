<?php

App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);

        case 404:
            return Response::view('errors.404', array(), 404);

        // case 500:
        //     return Response::view('errors.500', array(), 500);

        default:
            return null;
    }
});