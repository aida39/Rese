function cancelReservationConfirmation(event) {
        if (confirm('予約をキャンセルしますか？')) {
            form.submit()
        } else {
            event.preventDefault();
        }
    }