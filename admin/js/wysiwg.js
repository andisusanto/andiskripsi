    $(document).ready(function() {
        if ($('#wysiwg_editor').length) {
            CKEDITOR.replace('wysiwg_editor', {
                toolbar: 'Standard'
            });
        }
    });