<?php

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
    if (is_null($default_id))
        echo "<option value=\"\" disabled selected>Select a category</option>";
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