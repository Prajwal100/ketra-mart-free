
    var $accordion = $('.accordion .accordion-item .accordion-button');
    $accordion.on("click",function () {
        console.log('test');
        var $this = $(this);
        if ($this.hasClass('active')) {
            $this.removeClass('active').find('i').removeClass('bx-minus').addClass('bx-plus');
        } 
        else {
            $this.addClass('active');
            // $this.addClass('active');
            $this.find('i').removeClass('bx-plus');
            $this.find('i').addClass('bx-minus');
        }
    });
