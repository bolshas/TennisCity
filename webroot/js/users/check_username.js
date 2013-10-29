$(document).ready(function() {
    
    jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
        this.each(function() {
            $(this).css("position","relative");
            for (var x=1; x<=intShakes; x++) {
                $(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
                .animate({left:intDistance}, ((intDuration/intShakes)/2))
                .animate({left:0}, (((intDuration/intShakes)/4)));
                }
            });
        return this;
    };

    $(this).submit(function(event) {
        $(this).find($('input.validate')).each(function() {
            console.log('labas');
            if($(this).val() === "" || $(this).closest('.form-group.has-error').length) {
                $(':submit').shake(2, 5, 350);
                $(this).focus();
                event.preventDefault();
                return false;
            }
        });
    });

    $('input.validate').typeWatch({
        callback: function () {
            var thisControlId = $(this).attr('id');
            var arr = thisControlId.match(/[A-Z][a-z]*/g);
            var info = '.help-block.' + thisControlId;
            var modelName = arr[0];
            var fieldName = arr[1].toLowerCase();
            var fieldClass = "." + fieldName;
            var fieldValue = $(this).val();
            var field = {};
            var data = {};
            
            field['fieldName'] = fieldName;
            field[fieldName] = fieldValue;
            data [modelName] = field;

            $(info).closest('.form-group').removeClass('has-error has-success').addClass('has-checking');
            $(info).text('Checking...');
            
            $.post(
                window.location + "ajax/users/validate", data,
                function(data) {
                    $.each(data, function(key, value) {
                        if (key === 'status') {
                            $(info).closest('.form-group').removeClass('has-checking has-error has-success').addClass(value);
                        }
                        else $(info).text(value);
                    });
                }, "json"
            );
            
            $(this).data("changed", false);
        }, wait: 750, highlight: false, captureLength: 0
    });
});