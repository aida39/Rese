
    const el_input_file_01 = document.getElementById('input-file-01');
    const bt_file_01 = document.getElementById('bt-file-01');
    const el_output_01 = document.getElementById('output-01');

    // ボタンをクリックしたときにファイル選択画面を開く
    bt_file_01.addEventListener('click', function() {
        el_input_file_01.click();
    });

    // ファイル情報を表示する。
// el_input_file_02.addEventListener('change', function(e) {
//     const files = e.target.files;
//     if (files.length === 0) return;
//     const array_output = [
//         'name: ' + escHtml(files[0].name),
//         'type: ' + files[0].type,
//         'size: ' + files[0].size + 'byte'
//     ];
//     el_output_02.innerHTML = array_output.join('<br>');
// });
