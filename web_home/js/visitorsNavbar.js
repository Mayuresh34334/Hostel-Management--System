
$(function() {

    
    var current = 1;

    $('#navigation a').bind('click', function(e) {
        var $this = $(this);
        var prev = current;
        $this.closest('ul').find('li').removeClass('selected');
        $this.parent().addClass('selected');
        current = $this.parent().index() + 1;

        // Animate to the corresponding fieldset
        $('#visitorForm fieldset').eq(prev - 1).fadeOut('fast', function() {
            $('#visitorForm fieldset').eq(current - 1).fadeIn('fast');
        });

        e.preventDefault();
    });

});

