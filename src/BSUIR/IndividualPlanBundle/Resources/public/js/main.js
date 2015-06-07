(function ($) {
    $(document).ready(function () {

        $('.btn-danger').on('click', function (e) {
            var isRemove = confirm('Вы действительно хотите удалить эту запись?');

            if (!isRemove) {
                e.preventDefault();
            }
        });

        $('select').select2();

        $('#print-all').on('click', function() {
            var links = $('.print');

            $.each(links, function(key, link) {
                var url = $(link).prop('href');
                window.open(url, '_blank');
            });
        });

    });
})(jQuery);