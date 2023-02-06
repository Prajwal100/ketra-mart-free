$(function() {
    'use strict'
    // const ps2 = new PerfectScrollbar('.main-chat-list', {
    //     useBothWheelAxes: true,
    //     suppressScrollX: true,
    // });

    const ps5 = new PerfectScrollbar('#ChatBody', {
        useBothWheelAxes: true,
        suppressScrollX: true,
    });
    const ps6 = new PerfectScrollbar('.profile-details-main', {
        useBothWheelAxes: true,
        suppressScrollX: true,
    });
    const ps7 = new PerfectScrollbar('.main-chat-contacts-slider', {
        useBothWheelAxes: true,
        suppressScrollY: true,
    });
});