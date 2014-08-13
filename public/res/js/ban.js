function getLength() {
    var length;
    do {
        length = prompt('Enter extension (days)\n-1 will force a perma-ban');
    } while(isNaN(length) || length < -1);

    return length;
}

$(document).ready(function() {
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
            $('#ban-form').empty().append(response);

            // Alert the user
            alert('Ban cancelled successfully');
        });
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
            $('#banned-message').append(response);

            // Alert the user
            alert('Ban extended successfully');
        });
    });
});