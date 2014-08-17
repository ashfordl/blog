$(document).ready(function() {
    // When a normal field is clicked
    $('tr').on('click', '.editable:not(.editing)', function(e) {
        var elm = $(this);

        // Add editing class
        elm.addClass('editing');

        // Retrieve the current text
        var val = elm.text();

        // Declare the form
        var form = [
            '<form class="form-inline">'
                ,'<input type="hidden" class="form-control" value="'+val+'">'
                ,'<textarea class="form-control">'+val+'</textarea>'
                ,'<button class="btn btn-primary update-cat" type="button"><span class="glyphicon glyphicon-ok"></span></button>'
                ,'<button class="btn btn-warning cancel-update-cat" type="button"><span class="glyphicon glyphicon-remove"></span></button>'
            ,'</form>'
        ].join('\n');

        // Display the form
        elm.empty();
        elm.append(form);
    });

    // When submit button pressed
    $('tr').on('click', 'form button.update-cat', function(e) {
        var btn = $(this);
        var td = btn.parent().parent();

        // Disable the text area
        btn.siblings('textarea').attr("disabled", "disabled");

        // Retrieve the value and escape string delimeters
        var val = btn.siblings('textarea').val().replace('"', '\"').replace("'", "\'");

        // AJAX data
        var data = {
            "_token": csrf,
            "id": td.siblings(':first').text()
        }

        // Find the header text of the cell's column
        // Use this as a key in the JSON data, and set the input val as the value
        data[btn.closest('table').find('tr > th').eq(td.index()).html().toLowerCase()] = val;

        // Make the AJAX call to the server
        var ajax = $.post(postUrl, data);
        ajax.done(function() {
            var par = btn.parent().parent();
            par.empty();
            par.text(val);

            alert("success");

            par.removeClass('editing');

        });
        ajax.fail(function() {
            alert("An error occured.")

            btn.siblings('textarea').attr("disabled", null);
        });
    });

    // When cancel button pressed
    $('tr').on('click', 'form button.cancel-update-cat', function(e) {
        var val = $(this).siblings('input[type=hidden]').val();
        
        var par = $(this).parent().parent();
        par.empty();
        par.text(val);

        par.removeClass('editing');
    });
});