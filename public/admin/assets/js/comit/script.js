(function($) {
    $(document).ready(function() {

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



    });
})(jQuery)