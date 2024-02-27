function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.innerHTML = '<img src="' + reader.result + '" class="preview-image">';
    };
    reader.readAsDataURL(event.target.files[0]);

    const files = event.target.files;
    if (files.length === 0) return;
    const array_output = [
        escHtml(files[0].name),
    ];
    document.getElementById('output-01').innerHTML = array_output.join('<br>');
}

function escHtml(str) {
    const div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
}
