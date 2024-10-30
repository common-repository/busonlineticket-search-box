jQuery(document).ready(function ($) {
    $('#save_button_css').on('click', function () {
        var textareaValue = $('#code-editor').val();

        // AJAX request to save data
        $.ajax({
            type: 'POST',
            url: admin_url('admin-ajax.php'),
            data: {
                action: 'save_textarea_value',
                textarea_value: textareaValue,
            },
            success: function (response) {
            }
        });
    });
});
