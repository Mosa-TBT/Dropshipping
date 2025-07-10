<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe Payment</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        .StripeElement {
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: white;
        }

        #card-errors {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">💳 Stripe Payment</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('stripe.post') }}" method="post" id="payment-form">
                        @csrf

                        <div class="mb-3">
                            <label for="card-element" class="form-label">Card Info</label>
                            <div id="card-element" class="form-control">
                                <!-- Stripe card element here -->
                            </div>
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <button class="btn btn-success w-100" type="submit">Pay {{ $price }} $</button>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-3">Test card: 4242 4242 4242 4242 - any date & CVC</p>

        </div>
    </div>
</div>

<script>
    const stripe = Stripe('{{ config("services.stripe.key") }}');
    const elements = stripe.elements();

    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
            },
        }
    });

    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    const errorDiv = document.getElementById('card-errors');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {token, error} = await stripe.createToken(card);

        if (error) {
            errorDiv.textContent = error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>

</body>
</html>