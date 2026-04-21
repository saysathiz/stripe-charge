const cardButton = document.getElementById('card-button');
if (cardButton) {
    const stripeKey = cardButton.dataset.stripeKey;
    const clientSecret = cardButton.dataset.secret;
    const stripe = Stripe(stripeKey);
    const elements = stripe.elements();

    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': { color: '#aab7c4' },
        },
        invalid: { color: '#fa755a', iconColor: '#fa755a' },
    };

    const card = elements.create('card', { hidePostalCode: true, style });
    card.mount('#card-element');

    card.addEventListener('change', (event) => {
        const displayError = document.getElementById('card-errors');
        displayError.textContent = event.error ? event.error.message : '';
    });

    const cardHolderName = document.getElementById('card-holder-name');

    cardButton.addEventListener('click', async () => {
        const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
            payment_method: {
                card,
                billing_details: { name: cardHolderName.value },
            },
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
            return;
        }

        const form = document.getElementById('subscribe-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', setupIntent.payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    });
}
