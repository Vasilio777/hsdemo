let isDown = false;
let startY;
let scrollTop;
let totalDuration = 0;
let eons = $('.eons');

$(document).ready(function() {
    let totaScrolllWidth = $('#scroll-carriage').parent().width();

    // $('.list-group').on('mousedown', function(e) {
    //     isDown = true;
    //     $(this).addClass('active');
    //     startY = e.pageY - $(this).offset().top;;
    //     scrollTop = $(this).scrollTop();
    // });
    // $('.list-group').on('mouseleave', function() {
    //     isDown = false;
    //     $(this).removeClass('active');
    // });
    // $('.list-group').on('mouseup', function() {
    //     isDown = false;
    //     $(this).removeClass('active');
    // });
    // $('.list-group').on('mousemove', function(e) {
    //     if (!isDown) return;
    //     e.preventDefault();
    //     const y = e.pageY - $(this).offset().top;
    //     const walk = (y - startY) * 3;
    //     $(this).scrollTop(scrollTop - walk);
    // });
    
    // $('.nav-tabs a').on('click', function(e) {
    //     e.preventDefault();
    //     $(this).tab('show');

    //     var classes = $(this).attr('class').split(/\s+/);
    //     var eonClass = classes.find(className => className.startsWith('eon-'));

    //     if (eonClass) {
    //         let list_header = $('.list-header'); 
    //         list_header.removeClass();
    //         list_header.addClass('list-header ' + eonClass);
    //     }
    // });

    
    $('.horizontal-scroll-item').each(function() {
        totalDuration += parseFloat($(this).attr('duration'));
    });

    $('.horizontal-scroll-item').each(function() {
        let duration = parseFloat($(this).attr('duration'));
        let widthPercentage = (duration / totalDuration) * 100;
        $(this).css('width', widthPercentage + '%');

        if (widthPercentage < 0.2) {
            $(this).text('');
        }

        let eon = $(this).data('eon');
        let eonClass = 'eon-' + eon;
        if (eonClass) {
            $(this).addClass(eonClass);
        }
    });

    $('#scroll-carriage').draggable({
        axis: "x",
        containment: "parent",
        drag: function(event, ui) {
            let carriageX = ui.position.left;
            carriage_relative = clamp(carriageX / totaScrolllWidth*1.01, 0, 1.000039); // =)
            updateScrollText(carriage_relative);
            updateEonsVisibility(carriage_relative);
        }
    });

    // $('.entry').click(function() {
    //     let scrollPos = parseFloat($(this).attr('scroll_pos'));
    //     let carriageWidth = $('#scroll-carriage').outerWidth();
    //     let newLeft = (scrollPos / totalDuration) * totaScrolllWidth - (carriageWidth / 2);
    //     newLeft = Math.max(0, Math.min(newLeft, totaScrolllWidth - carriageWidth));

    //     $('#scroll-carriage').off('click').css('pointer-events', 'none');
    //     $('#scroll-carriage').animate({
    //         left: newLeft
    //     }, {
    //         duration: 500,
    //         step: function(now, fx) {
    //             updateScrollText(now / totaScrolllWidth);
    //         },
    //         complete: function() {
    //             $(this).on('click', function() {
    //             }).css('pointer-events', 'auto');
    //         }
    //     });
    // });

    function updateEonsVisibility(carriageX) {
        $('.eons').each(function() {
            let base = parseFloat($(this).attr('base'));
            let base_end = parseFloat($(this).attr('base_end'));
            let eonLeft = (base / totalDuration);
            let eonRight = (base_end / totalDuration);
            // console.log(carriageX, eonLeft, eonRight);
            if (eonLeft <= carriageX && eonRight > carriageX) {
                $(this).show();
               $(this).find($('h2, .eon-desc, .image-container img')).addClass('fadeIn');
            } else {
                $(this).hide();
            }
        });
    }

    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    $('body').css('opacity', '1');
    updateEonsVisibility(0);
});

function updateScrollText(scrollPos) {
    let mlnYearsAgo = Math.floor(totalDuration * scrollPos);
    $('#info-text').text(mlnYearsAgo);
}