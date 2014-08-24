<?php

/**
 * Renders a category select dropdown
 * 
 * $name        string  The name for the <select> element
 * $default_id  integer The id for the default selected option
 * $attrs       array   An array of html attribute key/values for the <select> element
 */
Form::macro('selectCategory', function($name = null, $default_id = null, $attrs = array())
{
    // Echo select tag
    echo "<select";
    if (isset($name))
        echo " name=\"$name\"";
    foreach ($attrs as $attr => $val)
        echo " $attr=\"$val\"";
    echo ">";

    // Echo options

    // Echo no category option
    echo "<option value=\"0\" ";
    if (is_null($default_id))   // If no selected id, default to No Category
        echo "selected";
    echo ">No category</option>";

    // Echo category option
    foreach (Category::all() as $category)
    {
        echo "<option value=\"$category->id\"";

        // Set the selected option if the default_id matches
        if (isset($default_id) && $category->id == $default_id)
            echo " selected";
        echo ">$category->title</option>";
    }

    echo "</select>";
});