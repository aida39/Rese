document.addEventListener('DOMContentLoaded', function() {
    const storeNameElement = document.getElementById('storeName');
    const dateInput = document.getElementById('reservationDate');
    const timeSelect = document.getElementById('reservationTime');
    const peopleSelect = document.getElementById('reservationPeople');
    const courseSelect = document.getElementById('reservationCourse');

    updateConfirmField();

    dateInput.addEventListener('input', updateConfirmField);
    timeSelect.addEventListener('input', updateConfirmField);
    peopleSelect.addEventListener('input', updateConfirmField);
    courseSelect.addEventListener('change', updateConfirmField);

    function updateConfirmField() {
        const storeName = storeNameElement ? storeNameElement.dataset.name : '';
        const dateValue = dateInput.value;
        const timeValue = formatTime(timeSelect.value);
        const peopleValue = peopleSelect.value;

        const selectedOption = courseSelect.options[courseSelect.selectedIndex];
        const courseName = selectedOption.dataset.course;
        const coursePrice = selectedOption.dataset.price;

        const totalPrice = peopleValue * coursePrice;

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
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Course</th>
                        <td class="reservation-table__data">${courseName}コース</td>
                    </tr>
                    <tr class="reservation-table__row">
                        <th class="reservation-table__header">Price</th>
                        <td class="reservation-table__data">${totalPrice}円</td>
                    </tr>
                </table>`;
        }
    }

    function formatTime(time) {
        const formattedTime = time.split(':').slice(0, 2).join(':');
        return formattedTime;
    }

    const dateErrorMessage = document.getElementById('dateErrorMessage');
    const timeErrorMessage = document.getElementById('timeErrorMessage');
    const peopleErrorMessage = document.getElementById('peopleErrorMessage');
    const courseErrorMessage = document.getElementById('courseErrorMessage');
    const reservationButton = document.querySelector('.reservation-button');

    validateReservation();

    dateInput.addEventListener('input', validateReservation);
    timeSelect.addEventListener('input', validateReservation);
    peopleSelect.addEventListener('input', validateReservation);
    courseSelect.addEventListener('change', validateReservation);
    reservationButton.addEventListener('click', handleReservation);

    function validateReservation() {
        const selectedDate = dateInput.value;
        const selectedTime = timeSelect.value;
        const selectedPeople = peopleSelect.value;
        const selectedCourse = courseSelect.value;
        const today = new Date().toISOString().split('T')[0];

        if (!selectedDate) {
            dateErrorMessage.textContent = '日付を選択してください';
        } else if (selectedDate <= today) {
            dateErrorMessage.textContent = '明日以降の日付を選択してください';
        } else {
            dateErrorMessage.textContent = '';
        }

        if (!selectedTime) {
            timeErrorMessage.textContent = '時間を選択してください';
        } else {
            timeErrorMessage.textContent = '';
        }

        if (!selectedPeople) {
            peopleErrorMessage.textContent = '人数を選択してください';
        } else {
            peopleErrorMessage.textContent = '';
        }

        if (!selectedCourse) {
            courseErrorMessage.textContent = 'コースを選択してください';
        } else {
            courseErrorMessage.textContent = '';
        }

        if (dateErrorMessage.textContent || timeErrorMessage.textContent || peopleErrorMessage.textContent || courseErrorMessage.textContent) {
            reservationButton.disabled = true;
            reservationButton.classList.add('disabled');
        } else {
            reservationButton.disabled = false;
            reservationButton.classList.remove('disabled');
        }
    }

    function handleReservation() {
        const dateError = dateErrorMessage.textContent;
        const timeError = timeErrorMessage.textContent;
        const peopleError = peopleErrorMessage.textContent;
        const courseError = courseErrorMessage.textContent;

        if (dateError || timeError || peopleError || courseError) {
            return;
        }

    }
});
