<!-- resources/views/checkout.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <form id="payment-form" action="/" method="POST">
        @csrf
        <div id="card-element">
            <!-- Stripe Elements will be inserted here. -->
        </div>

        <button id="submit">Pay</button>
    </form>

    <script>
        const stripe = Stripe("{{ config('services.stripe.public') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);
            if (error) {
                console.error(error);
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethod');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    </script>
</body>
</html>