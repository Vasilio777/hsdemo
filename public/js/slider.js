$(document).ready(function() {
    const ageDisplay = document.getElementById('ageDisplay');
    let entries = [];
    let currentActiveEntry = null;
    let isDown = false;
    let startY;
    let scrollTop;

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
        
        const normalizedWalk = ($(this).scrollTop()) / ($(this).prop('scrollHeight') - $(this).outerHeight());
        updateVisibleAge(normalizedWalk, $(this));
    });

    function initEntries() {
        $('.entry').each(function() {
            const entry = $(this);
            const parent = entry.parent();
            const rect = this.getBoundingClientRect();
            const parentRect = parent[0].getBoundingClientRect();
    
            entries.push({
                top: rect.top + window.scrollY - parentRect.top,
                bottom: rect.bottom + window.scrollY - parentRect.top,
                age: entry.attr('data-age')
            });
        });
    
        updateVisibleAge(0, $('.list-group'));
    }
    

    function updateVisibleAge(normalizedWalk, parent) {
        const targetScrollTop = normalizedWalk * (parent.prop('scrollHeight'));
        let newActiveEntry = null;
        for (const entry of entries) {
            const entryElement = $(`[data-age="${entry.age}"]`, parent)[0];
            if (entry.top <= targetScrollTop && entry.bottom >= targetScrollTop) {
                newActiveEntry = entryElement;
                break;
            }
        }
    
        if (currentActiveEntry !== newActiveEntry) {
            if (currentActiveEntry) {
                $(currentActiveEntry).removeClass('active-entry');
            }
            if (newActiveEntry) {
                $(newActiveEntry).addClass('active-entry');
                $('#ageDisplay').text('Age: ' + $(newActiveEntry).attr('data-age'));
            }
            currentActiveEntry = newActiveEntry;
        }
    }

    $('.nav-tabs a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    initEntries();
    window.addEventListener('resize', initEntries);
});
