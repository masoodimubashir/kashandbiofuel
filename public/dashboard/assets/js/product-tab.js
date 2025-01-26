(function ($) {
    //list layout view
    $(".grid-layout-view").on("click", function (e) {
        $(".Product-wrapper-grid").removeClass("list-view");
        $(".Product-wrapper-grid").children().children().removeClass("col-xl-12");
    });
    $(".list-layout-view").on("click", function (e) {
        $(".collection-grid-view").css("opacity", "0");
        $(".Product-wrapper-grid").css("opacity", "0.2");
        $(".Product-wrapper-grid").addClass("list-view");
        $(".Product-wrapper-grid").children().children();
        $(".Product-wrapper-grid").children().children().addClass("col-xl-12");
        setTimeout(function () {
            $(".Product-wrapper-grid").css("opacity", "1");
        }, 500);
    });

    // owl carousl
    $(document).ready(function () {
        $("#testimonial").owlCarousel({
            items: 1,
            margin: 30,
            loop: true,
            pagination: true,
            navigationText: true,
            dots: false,
            nav: true,
        });
    });

    // grid options
    // grid options
    $('.Product-2-layout-view').on('click', function (e) {
        if ($('.Product-wrapper-grid').hasClass("list-view")) {
        } else {
            $(".Product-wrapper-grid").children().children().removeClass();
            $(".Product-wrapper-grid").children().children().addClass("col-xl-6");
            $(".Product-wrapper-grid").children().children().addClass("col-sm-6");
            $(".left-filter").removeClass("filter-sidebar custom-scrollbar");
        }
    });
    $('.Product-3-layout-view').on('click', function (e) {
        if ($('.Product-wrapper-grid').hasClass("list-view")) {
        } else {
            $(".Product-wrapper-grid").children().children().removeClass();
            $(".Product-wrapper-grid").children().children().addClass("col-xl-4");
            $(".Product-wrapper-grid").children().children().addClass("col-sm-4");
            $(".left-filter").removeClass("filter-sidebar custom-scrollbar");
        }
    });
    $('.Product-4-layout-view').on('click', function (e) {
        if ($('.Product-wrapper-grid').hasClass("list-view")) {
        } else {
            $(".Product-wrapper-grid").children().children().removeClass();
            $(".Product-wrapper-grid").children().children().addClass("col-xl-3");
            $(".Product-wrapper-grid").children().children().addClass("col-sm-3");
            $(".left-filter").removeClass("filter-sidebar custom-scrollbar");
        }
    });
    $('.Product-6-layout-view').on('click', function (e) {
        if ($('.Product-wrapper-grid').hasClass("list-view")) {
        } else {
            $(".Product-wrapper-grid").children().children().removeClass();
            $(".Product-wrapper-grid").children().children().addClass("col-xl-2");
            $(".left-filter").addClass("filter-sidebar custom-scrollbar");
        }
    });
})(jQuery);
