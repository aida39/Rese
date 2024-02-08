document.addEventListener('DOMContentLoaded', function() {
    const storeNameElement = document.getElementById('storeName');
    const dateInput = document.getElementById('reservationDate');
    const timeSelect = document.getElementById('reservationTime');
    const peopleSelect = document.getElementById('reservationPeople');

    updateConfirmField();

    dateInput.addEventListener('input', updateConfirmField);
    timeSelect.addEventListener('input', updateConfirmField);
    peopleSelect.addEventListener('input', updateConfirmField);

    function updateConfirmField() {
        const storeName = storeNameElement ? storeNameElement.dataset.name : '';
        const dateValue = dateInput.value;
        const timeValue = formatTime(timeSelect.value);
        const peopleValue = peopleSelect.value;

        const confirmField = document.getElementById('confirmField');

        if (confirmField) {
            confirmField.innerHTML = `
                <table class="reservation-table">
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Shop</th>
                        <td class="reservation-table__data">${storeName}</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Date</th>
                        <td class="reservation-table__data">${dateValue}</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Time</th>
                        <td class="reservation-table__data">${timeValue}</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Number</th>
                        <td class="reservation-table__data">${peopleValue}人</td>
                    </tr>
                </table>`;
        }
    }

    function formatTime(time) {
        const formattedTime = time.split(':').slice(0, 2).join(':');
        return formattedTime;
    }
});
