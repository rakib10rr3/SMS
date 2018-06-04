// Custom File Input
// https://getbootstrap.com/docs/4.1/components/forms/#file-browser
// https://stackoverflow.com/questions/40111225/bootstrap-file-input-dont-show-file-name-after-selecting-the-file
// https://stackoverflow.com/questions/48613992/bootstrap-4-file-input-doesnt-show-the-file-name

$('#customInputPhoto').on('change',function(){
    //get the file name
    var fileName = $(this).val().split('\\').pop();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})