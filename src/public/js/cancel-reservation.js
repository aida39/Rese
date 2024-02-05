 function cancelReservationConfirmation(reservationId) {
        var isConfirmed = confirm('予約をキャンセルしますか？');

        if (isConfirmed) {
            axios.post('/cancel-reservation', { reservation_id: reservationId })
                .then(function (response) {
                    alert('');
                })
                .catch(function (error) {
                    console.error('キャンセルエラー:', error);
                });
        }

        return false;
    }