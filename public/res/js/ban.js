$(document).ready(function() {
    function getLength() {
        var length;
        do {
            length = prompt('Enter extension (days)\n-1 will force a perma-ban');
        } while(isNaN(length) || length < -1);

        return length;
    }

    function displayError() {
        alert('An error occured and the request failed.');
    }

    function updateBanTable(ban) {
        var id = $('td.hidden').filter(function() {
            return $(this).text() == ban.id;
        });

        if (ban.valid)
            id.siblings('.ban-valid').text('Valid');
        else
            id.siblings('.ban-valid').text('Invalid');

        console.log(ban.end);

        if (ban.end)
            id.siblings('.ban-end').text(ban.end.date);
        else
            id.siblings('.ban-end').text('Permanent');
    }

    $('#cancel-ban').click(function() {
        // POST data to invalidate the current ban
        var data = {
            '_token':   csrf,       // CSRF Filter
            'action':   'cancel',
            'user_id':  userId
        };

        var ajax = $.post(postUrl, data);
        ajax.done(function(response) {
            // Request successful
            // Remove ban panel
            $('#banned-panel').remove();

            // Display ban form
            $('#ban-form').empty().append(response.html);

            // Update the table
            updateBanTable(response.ban);

            // Alert the user
            alert('Ban cancelled successfully');
        });
        ajax.fail(displayError);
    });

    $('#extend-ban').click(function() {
        var length = getLength();   // Retrieve and validate extension length
        if (!length) return;        // If 0 (no extension), or null (cancelled prompt), abort

        // POST data to invalidate the current ban
        var data = {
            '_token':   csrf,       // CSRF Filter
            'action':   'extend',
            'length':   length,
            'user_id':  userId
        };

        var ajax = $.post(postUrl, data);
        ajax.done(function(response) {
            // Request successful
            // Remove existing message
            $('#banned-message').empty();

            // Display new message
            $('#banned-message').append(response.html);

            // Update the table
            updateBanTable(response.ban);

            // Alert the user
            alert('Ban extended successfully');
        });
        ajax.fail(displayError);
    });
});