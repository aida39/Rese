// ページの読み込み完了後に実行
document.addEventListener('DOMContentLoaded', function() {
    // 各HTML要素を取得
    const storeNameElement = document.getElementById('storeName'); // 店名の要素
    const dateInput = document.getElementById('reservationDate'); // 予約日の入力要素
    const timeSelect = document.getElementById('reservationTime'); // 予約時間の選択要素
    const peopleSelect = document.getElementById('reservationPeople'); // 予約人数の選択要素

    // 初回表示処理を実行
    updateConfirmField();

    // 予約日、予約時間、予約人数のいずれかが変更されたときに updateConfirmField 関数を呼び出す
    dateInput.addEventListener('input', updateConfirmField);
    timeSelect.addEventListener('input', updateConfirmField);
    peopleSelect.addEventListener('input', updateConfirmField);

    // 予約情報を更新する関数
    function updateConfirmField() {
        // 店名のデータを取得（存在しない場合は空文字）
        const storeName = storeNameElement ? storeNameElement.dataset.name : '';
        // 予約日、予約時間、予約人数の値を取得
        const dateValue = dateInput.value;
        const timeValue = formatTime(timeSelect.value); // 予約時間をフォーマット
        const peopleValue = peopleSelect.value;

        // 表示を更新する要素（id="confirmField"）を取得
        const confirmField = document.getElementById('confirmField');

        // 表示を更新
        if (confirmField) {
            confirmField.innerHTML = `
                <p class="confirmation-info">Shop ${storeName}</p>
                <p>Date ${dateValue}</p>
                <p>Time ${timeValue}</p>
                <p>Number ${peopleValue}人</p>`;
        }
    }

    // 予約時間のフォーマットを変更する関数
    function formatTime(time) {
        // 時刻のフォーマットを変更して返す
        const formattedTime = time.split(':').slice(0, 2).join(':'); // 時間部分までのフォーマットに変更
        return formattedTime;
    }
});
