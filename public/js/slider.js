let isDown = false;
let startY;
let scrollTop;
let totalDuration = 0;

$(document).ready(function() {
    $('.list-group').on('mousedown', function(e) {
        isDown = true;
        $(this).addClass('active');
        startY = e.pageY - $(this).offset().top;;
        scrollTop = $(this).scrollTop();
    });
    $('.list-group').on('mouseleave', function() {
        isDown = false;
        $(this).removeClass('active');
    });
    $('.list-group').on('mouseup', function() {
        isDown = false;
        $(this).removeClass('active');
    });
    $('.list-group').on('mousemove', function(e) {
        if (!isDown) return;
        e.preventDefault();
        const y = e.pageY - $(this).offset().top;
        const walk = (y - startY) * 3;
        $(this).scrollTop(scrollTop - walk);
    });
    
    $('.nav-tabs a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');

        var classes = $(this).attr('class').split(/\s+/);
        var eonClass = classes.find(className => className.startsWith('eon-'));

        if (eonClass) {
            let list_header = $('.list-header'); 
            list_header.removeClass();
            list_header.addClass('list-header ' + eonClass);
        }
    });

    
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
            let totalWidth = $(this).parent().width();
            let carriageX = ui.position.left;
            updateScrollText(carriageX / totalWidth);
        }
    });

    $('.entry').click(function() {
        let scrollPos = parseFloat($(this).attr('scroll_pos'));
        let totalWidth = $('.scroller-container').width();
        let carriageWidth = $('#scroll-carriage').outerWidth();
        let newLeft = (scrollPos / totalDuration) * totalWidth - (carriageWidth / 2);
        newLeft = Math.max(0, Math.min(newLeft, totalWidth - carriageWidth));

        $('#scroll-carriage').off('click').css('pointer-events', 'none');
        $('#scroll-carriage').animate({
            left: newLeft
        }, {
            duration: 500,
            step: function(now, fx) {
                updateScrollText(now / totalWidth);
            },
            complete: function() {
                $(this).on('click', function() {
                }).css('pointer-events', 'auto');
            }
        });
    });

    const $lis = $('.list-group .entry');
    const $randomEntry = $lis.eq(Math.floor(Math.random() * (125 - 105 + 1) + 105));
    const $tabPane = $randomEntry.closest('.tab-pane');
    const tabPaneId = $tabPane.attr('id');
    const $navLink = $('.nav-link[href="#' + tabPaneId + '"]');
    
    $navLink.click();
    $randomEntry.click();
    $('body').css('opacity', '1');
});

function updateScrollText(scrollPos) {
    let mlnYearsAgo = Math.floor(totalDuration * scrollPos);
    $('#info-text').text(mlnYearsAgo);
}