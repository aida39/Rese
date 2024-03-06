function openStripeCheckout() {
    var courseSelect = document.getElementById('reservationCourse');
    var selectedOption = courseSelect.options[courseSelect.selectedIndex];
    var coursePrice = parseFloat(selectedOption.dataset.price);
    var memberCount = parseInt(document.getElementById('reservationPeople').value);

    if (isNaN(coursePrice) || isNaN(memberCount)) {
        alert('金額または人数が不正です');
        return;
    }

    var amount = coursePrice * memberCount;

    var handler = StripeCheckout.configure({
        key: stripeKey,
        image: "https://stripe.com/img/documentation/checkout/marketplace.png",
        locale: "auto",
        currency: "JPY",
        name: "Stripe決済デモ",
        description: "これはデモ決済です",
        amount: amount,
        token: function(token) {
            var form = document.getElementById('reservationForm');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            var amountInput = document.createElement('input');
            amountInput.setAttribute('type', 'hidden');
            amountInput.setAttribute('name', 'amount');
            amountInput.setAttribute('value', amount);
            form.appendChild(amountInput);

            form.submit();
        }
    });

    handler.open({
        name: "Stripe決済画面（デモ）",
        description: "支払いが完了すると予約が確定します",
        amount: amount
    });
}
