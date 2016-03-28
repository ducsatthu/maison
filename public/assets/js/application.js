/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 6000,
        values: [0, 2000],
        slide: function (event, ui) {
            $("#min").val(ui.values[ 0 ] + "K");
            $("#max").val(ui.values[ 1 ] + "K");

        }
    });
    $("#min").val($("#slider-range").slider("values", 0) + "K");
    $("#max").val($("#slider-range").slider("values", 1) + "K");
});


//the $(document).ready() function is down at the bottom

(function ($) {

    $.fn.rating = function (method, options) {
        method = method || 'create';
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            limit: 5,
            value: 0,
            glyph: "fa-star",
            coloroff: "gray",
            coloron: "gold",
            size: "10px",
            cursor: "default",
            onClick: function () {},
            endofarray: "idontmatter"
        }, options);
        var style = "";
        style = style + "font-size:" + settings.size + "; ";
        style = style + "color:" + settings.coloroff + "; ";
        style = style + "cursor:" + settings.cursor + "; ";



        if (method == 'create')
        {
            //this.html('');	//junk whatever was there

            //initialize the data-rating property
            this.each(function () {
                attr = $(this).attr('data-rating');
                if (attr === undefined || attr === false) {
                    $(this).attr('data-rating', settings.value);
                }
            })

            //bolt in the glyphs
            for (var i = 0; i < settings.limit; i++)
            {
                this.append('<span data-value="' + (i + 1) + '" class="ratingicon fa ' + settings.glyph + '" style="' + style + '" aria-hidden="true"></span>');
            }

            //paint
            this.each(function () {
                paint($(this));
            });

        }
        if (method == 'set')
        {
            this.attr('data-rating', options);
            this.each(function () {
                paint($(this));
            });
        }
        if (method == 'get')
        {
            return this.attr('data-rating');
        }
        //register the click events
        this.find("span.ratingicon").click(function () {
            rating = $(this).attr('data-value')
            $(this).parent().attr('data-rating', rating);
            paint($(this).parent());
            settings.onClick.call($(this).parent());
        })
        function paint(div)
        {
            rating = parseInt(div.attr('data-rating'));
            div.find("input").val(rating);	//if there is an input in the div lets set it's value
            div.find("span.ratingicon").each(function () {	//now paint the stars

                var rating = parseInt($(this).parent().attr('data-rating'));
                var value = parseInt($(this).attr('data-value'));
                if (value > rating) {
                    $(this).css('color', settings.coloroff);
                } else {
                    $(this).css('color', settings.coloron);
                }
            });
        }

    };

}(jQuery));

$(function () {
    $('.product').hover(function () {
        $(this).removeClass('animated zoomIn');
        $(this).addClass('animated pulse');
        $(this).find('.checkout').removeClass('hidden');
    }, function () {
        $(this).removeClass('animated pulse');
        $(this).find('.checkout').addClass('hidden');


    });
}(jQuery));



function ajaxFilter(field, value) {
    if(field === 'order'){
        $('.order').val(value).trigger('changed');
    }
    $.ajax({
        url: '/ajax/filter',
        type: 'post',
        data: {
            field: field,
            value: value
        },
        dataType: 'json',
        success: function (data) {
            render(data);
        }
    });
}

function render(data) {

    html = '<div class="row">';
    $.each(data, function (k, v) {
        html += '<div class="col-md-4"><div class="product animated zoomIn"> <div class="row"><div class="col-md-12 col-sm-6 col-xs-12"> <img src="' + v.image + '" class="img-responsive"/></div><div class="col-md-12 col-sm-6 col-xs-12"><div class="action"><button class="btn btn-dark btn-upper btn-sm btn-50"><i class="fa fa-search"></i>  Xem nhanh</button><button class="btn btn-gray btn-upper btn-sm btn-25"><i class="fa fa-heart"></i></button><button class="btn btn-gray btn-upper btn-sm btn-25"><i class="fa fa-toggle-on"></i></button></div><div class="info"><div class="star" id="star"><div class="stars-default"><input type=hidden name="rating"/></div></div><div class="hits"><span>3 Lượt xem</span><span> | </span><a href="#">Thêm vào giỏ hàng </a></div><div class="decor"></div>';

        html += '<article><h4>' + v.name + '</h4><div class="price"><strike>';

        if (v.price_old) {
            html += v.price_old.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' VNĐ';
        }
        html += '</strike><span>';
        html += v.price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' VNĐ';
        html += '</span> <span class="sale">-10%</span></div><p align="center" class="checkout hidden"> <a class="btn btn-darkness text-center btn-upper">Thanh toán</a> </p></article></div></div></div></div></div>';

    });

    html += '</div>';

    jQuery('#products').find('div.row').remove();

    jQuery('#products').append(html);

    $(".stars-default").rating('create', {value: 3});
    
    $('.product').hover(function () {
        $(this).removeClass('animated zoomIn');
        $(this).addClass('animated pulse');
        $(this).find('.checkout').removeClass('hidden');
    }, function () {
        $(this).removeClass('animated pulse');
        $(this).find('.checkout').addClass('hidden');
    });
}
