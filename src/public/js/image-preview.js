function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.innerHTML = '<img src="' + reader.result + '" class="preview-image">';
    };
    reader.readAsDataURL(event.target.files[0]);
}