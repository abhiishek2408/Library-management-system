<!-- resources/views/paypal_checkout.blade.php -->

<script src="https://www.paypal.com/sdk/js?client-id={{ $clientId }}&currency=USD"></script>

<div id="paypal-button-container"></div>

<form id="paypal-form" action="{{ route('paypal.success') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="issue_id" value="{{ $issueId }}">
    <input type="hidden" name="order_id" id="paypal-order-id">
</form>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '0.50' // Amount in USD
                    },
                    description: 'Book Issue Fee - Library Management'
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                document.getElementById('paypal-order-id').value = data.orderID;
                document.getElementById('paypal-form').submit();
            });
        }
    }).render('#paypal-button-container');
</script>
