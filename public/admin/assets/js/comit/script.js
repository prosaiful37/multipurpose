(function($) {
    $(document).ready(function() {

        //post datatable
        $('table.post-table').DataTable();



        //ck editor
        CKEDITOR.replace('post_editor');

        //logout system
        $('a#logout-button').click(function(e) {
            e.preventDefault();
            $('form#logout-form').submit();
        });



        //category edit
        $(document).on('click', 'a#category_edit', function(e) {
            e.preventDefault();

            let id = $(this).attr('edit_id');

            $.ajax({
                url: "post-category-edit/" + id,
                dataType: "json",
                success: function(data) {
                    $('#category_modal_Update form input[name="name"]').val(data.name);
                    $('#category_modal_Update form input[name="id"]').val(data.id);
                }
            });



        });

        //post featuered image
        $(document).on('change', 'input#fimage', function(event) {
            event.preventDefault();
            let post_image_url = URL.createObjectURL(event.target.files[0]);
            $('img#post_featured_image').attr('src', post_image_url);
        });








    });
})(jQuery)
