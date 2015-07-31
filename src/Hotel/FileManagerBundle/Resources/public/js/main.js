//FILE MANANAGER

function convertUrlPlus (url) {
    url = url.toString();
    url = url.replace(/\//g, '+');
    return url;
}
//filemanager JS
//$(function() {
//    $('#file-manager-dirs .btn-default').on('click', function() {
//        currentDir = $(this).attr('data-dir');
//        console.log(convertUrlPlus(currentDir));
//        $('#file-manager-dirs .btn-default').removeClass('active');
//        $(this).addClass('active');
//
//        $.ajax({
//            method: "POST",
//            url: "{{ path('file_manager') }}/" + currentDir
//            success: function(){
//                $('#file-manager').load("{{ path('file_manager') }} "+ currentDir +" #file-manager", function() {
//                /// can add another function here
//            }),
//
//            }
//        })
//        .done(function( msg ){
//            alert("sukces " + msg);
//        });
//
//
//    });
//
//    $('#file-manager-files .btn-default').on('click', function() {
//        currentFile = $(this).attr('data-dir');
//        $('#file-manager-files .btn-default').removeClass('active');
//        $(this).addClass('active');
//
//    });
//});

