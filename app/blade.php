<?php

/**
 * Renders a category select dropdown
 *
 * @param string    $name           The name for the <select> element
 * @param int       $default_id     The id for the default selected option
 * @param array     $attrs          An array of html attribute key/values for the <select> element
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

/**
 * Parses the custom BBCode used for user-generated content
 *
 * @param $view The view to parse
 * @param $compiler The Blade compiler
 *
 * @return string
 */
Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('bbcode');

    return preg_replace($pattern, '$1<p><?php echo '.
            'str_replace(array("[b]"), "<b>", '.    // Match [b] and [/b]
            'str_replace(array("[/b]"), "</b>", '.
            'str_replace(array("\n","\r\n", "\n\n", "\r\n\r\n"), "</p><p>", '.  // Replace new lines with <p>
        'e($2) ))); ?></p>', $view);
});