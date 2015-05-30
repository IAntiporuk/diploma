(function ($) {
    $(document).ready(function () {

        $('.btn-danger').on('click', function (e) {
            var isRemove = confirm('Вы действительно этоите удалить это?');

            if (!isRemove) {
                e.preventDefault();
            }
        });

        $('select').select2();

    });
})(jQuery);