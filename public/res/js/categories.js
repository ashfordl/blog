$(document).ready(function() {
    // When a normal field is clicked
    $('tr').on('click', '.editable:not(.editing)', function(e) {
        var elm = $(this);

        // Add editing class
        elm.addClass('editing');

        var val = elm.text();

        var form = [
            '<form class="form-inline">'
                ,'<input type="hidden" class="form-control" value="'+val+'">'
                ,'<input type="text" class="form-control" value="'+val+'">'
                ,'<button class="btn btn-primary update-cat" type="button"><span class="glyphicon glyphicon-ok"></span></button>'
                ,'<button class="btn btn-warning cancel-update-cat" type="button"><span class="glyphicon glyphicon-remove"></span></button>'
            ,'</form>'
        ].join('\n');

        elm.empty();
        elm.append(form);
    });

    // When submit button pressed
    $('tr').on('click', 'form button.update-cat', function(e) {
        var btn = $(this);
        var td = btn.parent().parent();

        btn.siblings('input[type=text]').attr("disabled", "disabled");

        var val = btn.siblings('input[type=text]').val().replace('"', '\"').replace("'", "\'");
        
        // AJAX
        var data = {
            "_token": csrf,
            "id": td.siblings(':first').text()
        }

        // Find the header text of the cell's column
        // Use this as a key in the JSON data, and set the input val as the value
        data[btn.closest('table').find('tr > th').eq(td.index()).html().toLowerCase()] = val;

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

            btn.siblings('input[type=text]').attr("disabled", null);
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