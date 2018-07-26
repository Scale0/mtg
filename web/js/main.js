+function ($) {
    $(document).ready(function() {
        var imageToggle = function() {
            $('[data-toggle="popover"]').popover({
                placement : 'right',
                trigger : 'hover',
                html : true,
                content : function () {
                    return '<div class="media"><a href="#" class="pull-left"><img src="/images/cards/'+$(this).data('img')+'.jpg" height="340px" class="media-object"></a><div class="media-body"></div></div>'
                }
            });
        };
        $('.js-header-search-toggle').on('click', function() {
            $('.search-bar').slideToggle();
        });
        $('#deckviewtable').on('mouseenter', function() {
            imageToggle();
        });
        $('#collectionTable').DataTable();
        $('#collectionTable').on('mouseenter', 'tbody', function () {
            imageToggle();
        });

        $('.doubleFacedCards').not(":first").hide();


        $('.toggleDoubleFacedCards').on('click', function() {
            $('.doubleFacedCards').fadeToggle("fast");
        });

    });


}(jQuery);
