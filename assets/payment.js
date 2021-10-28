$(function () {
    var $stripePg = $(".form-validation");
    $('form.form-validation').bind('submit', function (e) {
        var $stripePg = $(".form-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'].join(', '),
            $inputs = $stripePg.find('.required').find(inputSelector),
            $errorMessage = $stripePg.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function (i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });

        if (!$stripePg.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($stripePg.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, handleStripePayment);
        }

    });

    function handleStripePayment(status, res) {
        if (res.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(res.error.message);
        } else {
            var token = res['id'];
            $stripePg.find('input[type=text]').empty();
            $stripePg.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $stripePg.get(0).submit();
        }
    }

});