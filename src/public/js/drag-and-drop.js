// ドラッグ&ドロップエリアの取得
let fileArea = document.getElementById("dropArea");

// input[type=file]の取得
let fileInput = document.getElementById("uploadFile");

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
    } else {
        //ファイルが受け取れなかった際の処理
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
        } else {
            // ファイルが受け取れなかった際の処理
        }
    },
    false
);
