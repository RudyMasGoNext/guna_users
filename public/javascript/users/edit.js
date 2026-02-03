document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById('submit');
    const form = document.getElementById('form');

    if (submitButton && form) {
        submitButton.addEventListener('click', function () {
            form.submit();
        });
    }

    $('#post_oauth_provider').on('change', function () {
        const value = $(this).val();

        $('#local_div').toggle(value === 'local');
        $('#smartschool_div').toggle(value === 'smartschool');
    }).trigger('change');
});
