// ドラッグ&ドロップエリアの取得
let fileArea = document.getElementById("bt-file-01");

// input[type=file]の取得
let fileInput = document.getElementById("input-file-01");

// ボタンクリック時の処理
const el_upload_file = document.getElementById("input-file-01");
const bt_drop_area = document.getElementById("bt-file-01");

bt_drop_area.addEventListener("click", function () {
    el_upload_file.click();
});

// ドラッグオーバー時の処理
fileArea.addEventListener("dragover", function (e) {
    e.preventDefault();
    fileArea.classList.add("dragover");
});

// ドラッグアウト時の処理
fileArea.addEventListener("dragleave", function (e) {
    e.preventDefault();
    fileArea.classList.remove("dragover");
});

// ドロップ時の処理
fileArea.addEventListener("drop", function (e) {
    e.preventDefault();
    fileArea.classList.remove("dragover");

    // ドロップしたファイルの取得
    let files = e.dataTransfer.files;

    // 取得したファイルをinput[type=file]へ
    fileInput.files = files;

    if (typeof files[0] !== "undefined") {
        //ファイルが正常に受け取れた際の処理
        document.getElementById("output-01").textContent = files[0].name; // ファイル名を表示
    } else {
        //ファイルが受け取れなかった際の処理
        document.getElementById("output-01").textContent = "ファイルが選択されていません。"; // エラーメッセージを表示
    }
});

// input[type=file]に変更があれば実行
// もちろんドロップ以外でも発火します
fileInput.addEventListener(
    "change",
    function (e) {
        let file = e.target.files[0];

        if (typeof e.target.files[0] !== "undefined") {
            // ファイルが正常に受け取れた際の処理
            document.getElementById("output-01").textContent = file.name; // ファイル名を表示
        } else {
            // ファイルが受け取れなかった際の処理
            document.getElementById("output-01").textContent = "ファイルが選択されていません。"; // エラーメッセージを表示
        }
    },
    false
);
