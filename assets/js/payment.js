
$("#value-range").text("10€");

$("#amount").on("input", function (e) { 
	e.preventDefault();
	var val = $(this).val();
	$("#value-range").text(val+"€")
});

var stripe = Stripe('pk_test_ZxhbwBhOWuJVMSnD6RCKRlWm');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
var style = {
	base: {
		color: '#32325d',
		fontSmoothing: 'antialiased',
		fontSize: '18px',
		'::placeholder': {
			color: '#aab7c4'
		}
	},
	invalid: {
		color: '#fa755a',
		iconColor: '#fa755a'
	}
};

// Create an instance of the card Element.
var card = elements.create('card', { style: style });

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

card.addEventListener('change', function (event) {
	var displayError = $('#card-errors');
	displayError.text('');
	if (event.error) {
		displayError.text(event.error.message);
	}
});

// Create a token or display an error when the form is submitted.
$('#payment-form').submit(function (event) {
	console.log('form');
	event.preventDefault();
	stripe.createSource(card).then(function (result) {
		if (result.error) {
			$('#card-errors').text(result.error.message);
		} else {
			stripeTokenHandler(result.source);
		}
	})
});

function stripeTokenHandler(token) {
	// Insert the token ID into the form so it gets submitted to the server
	var form = $('#payment-form');
	form.append('<input type=hidden name=stripeToken value=' + token.id + ' />');
	console.log('coucou');
	// Submit the form
	form.get(0).submit();
}