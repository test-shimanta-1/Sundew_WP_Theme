console.warn("acf jquery admin validations");

// jQuery(document).ready(function ($) {
//     const field = $("#acf-field_69312dc30f5b5");

//     if ($("#acf-custom-warning").length === 0) {
//         field.before('<div id="acf-custom-warning" style="color:black; margin-bottom:5px;">You have a standard limit of 250 characters.</div>');
//     }

//     field.on('input', function () {
//         let text = field.val();
//         let length = text.length;
//         let warning = $("#acf-custom-warning");
//         if (length > 350) {
//             warning.text("The 350-character limit has been reached.");
//             field.val(text.substring(0, 350));
//             return;
//         }
//         if (length > 250) {
//             warning.text("You can enter up to 350 characters.");
//         } else {
//             warning.text("");
//         }

//     });
// });



jQuery(document).ready(function ($) {
    $('.acf-field[data-standard][data-max]').each(function () {
        const wrapper = $(this);
        const input = wrapper.find('input[type=text], textarea');

        const standard = parseInt(wrapper.data('standard'));
        const max = parseInt(wrapper.data('max'));
        const message = wrapper.data('message') || "You are exceeding the standard limit.";

        if (wrapper.find('.acf-custom-warning').length === 0) {
            input.before('<div class="acf-custom-warning" style="margin-bottom:5px;"></div>');
        }

        const warning = wrapper.find('.acf-custom-warning');
        warning.text(`You have a standard limit of ${standard} characters.`).css('color', 'black');

        input.on('input', function () {
            let text = input.val();
            let length = text.length;

            if (length > max) {
                warning.text(`Maximum limit of ${max} characters reached.`).css('color', 'red');
                input.val(text.substring(0, max));
                return;
            }

            if (length > standard) {
                warning.text(`You can enter up to ${max} characters.`).css('color', 'black');
            } else {
                warning.text("");
            }
        });
    });
});
