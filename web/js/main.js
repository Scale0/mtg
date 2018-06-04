+function ($) {

    $(document).ready(function() {
        $('.js-header-search-toggle').on('click', function() {
            $('.search-bar').slideToggle();
        });
        $('#collectionTable').DataTable();
        $('#collectionTable').on('mouseenter', 'tbody', function () {
            $('[data-toggle="popover"]').popover({
                placement : 'right',
                trigger : 'hover',
                html : true,
                content : function () {
                    return '<div class="media"><a href="#" class="pull-left"><img src="/images/cards/'+$(this).data('img') +'.jpg" height="340px" class="media-object"></a><div class="media-body"></div></div>'
                }
            });
        });
        $('#search').autocomplete({
            source: '/card/search/1',
            minLength: 2
        })
        $('[data-toggle="popover"]').popover({
            placement : 'right',
            trigger : 'hover',
            html : true,
            content : function () {
                return '<div class="media"><a href="#" class="pull-left"><img src="/images/cards/'+$(this).data('img') +'.jpg" height="340px" class="media-object"></a><div class="media-body"></div></div>'
            }
        });
    });

}(jQuery);
