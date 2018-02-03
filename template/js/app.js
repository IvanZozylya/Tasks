
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }

        resize(event.target.files[0], 240, 320);
        reader.readAsDataURL(event.target.files[0]);
    }

function resize(img, maxh, maxw) {
    var ratio = maxh/maxw;
    if (img.height/img.width > ratio){
        // height is the problem
        if (img.height > maxh){
            img.width = Math.round(img.width*(maxh/img.height));
            img.height = maxh;
        }
    } else {
        // width is the problem
        if (img.width > maxh){
            img.height = Math.round(img.height*(maxw/img.width));
            img.width = maxw;
        }
    }
}