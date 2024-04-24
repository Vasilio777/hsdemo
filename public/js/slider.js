const slider = document.querySelector('#slider');
const ageDisplay = document.getElementById('ageDisplay');
let entries = [];
let currentActiveEntry = null;
let isDown = false;
let startY;
let scrollTop;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startY = e.pageY - slider.offsetTop;
    scrollTop = slider.scrollTop;
});
slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const y = e.pageY - slider.offsetTop;
    const walk = (y - startY) * 3;
    slider.scrollTop = scrollTop - walk;

    const normalizedWalk = (slider.scrollTop) / (slider.scrollHeight - slider.clientHeight);
    updateVisibleAge(normalizedWalk);
});

function initEntries() {
    entries = [];
    const sliderOffsetTop = slider.offsetTop;

    document.querySelectorAll('.entry').forEach(entry => {
        const rect = entry.getBoundingClientRect();
        entries.push({
            top: rect.top + window.pageYOffset - sliderOffsetTop,
            bottom: rect.bottom + window.pageYOffset - sliderOffsetTop,
            age: entry.getAttribute('data-age')
        });
    });

    updateVisibleAge(0);
}

function updateVisibleAge(normalizedWalk) {
    const targetScrollTop = normalizedWalk * slider.scrollHeight;
    // console.log(normalizedWalk, targetScrollTop, slider.scrollHeight);
    let newActiveEntry = null;
    for (const entry of entries) {
        const entryElement = document.querySelector(`[data-age="${entry.age}"]`);
        if (entry.top <= targetScrollTop && entry.bottom >= targetScrollTop) {
            newActiveEntry = entryElement;
            break;
        }
    }

    if (currentActiveEntry !== newActiveEntry) {
        if (currentActiveEntry) {
            currentActiveEntry.classList.remove('active-entry');
        }
        if (newActiveEntry) {
            newActiveEntry.classList.add('active-entry');
            ageDisplay.textContent = 'Age: ' + newActiveEntry.getAttribute('data-age');
        }
        currentActiveEntry = newActiveEntry;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    initEntries();
    window.addEventListener('resize', initEntries);
});
