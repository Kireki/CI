$(document).ready(function() {
    $(".fancybox")
        .fancybox({
            closeClick  : true,
            openEffect  : 'elastic',
            closeEffect : 'elastic',
            nextEffect  : 'none',
            prevEffect  : 'none',
            padding     : 0,
            margin      : [20, 60, 20, 60],
            beforeLoad: function() {
                var el, id = $(this.element).data('title-id');

                if (id) {
                    el = $('#' + id);
                
                    if (el.length) {
                        this.title = el.html();
                    }
                }
            }
        });
});

$(document).ready(function() {
    $(".fancybox-inline")
    .fancybox({
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        padding     : 0, 
    });
});

$(document).ready(function () {
    $('.group').hide();
    $('#option1').show();
    $('#selectMe').change(function () {
        $('.group').hide();
        $('#'+$(this).val()).show();
    })
});




$(document).ready(function () {
    $('#anonUploadError').hide();
    $("#anonupload").attr('disabled', 'disabled').addClass('disabled');
    var myFile = document.getElementById('anonFile');             
    var allowed = ["jpg", "jpeg", "gif", "bmp", "png"];
    myFile.addEventListener('change', function() {
        if (this.files[0].size > 6291456 || this.files[0].size === 0 || $.inArray(this.files[0].name.split('.').pop().toLowerCase(), allowed) === -1) 
        {
            $("#anonupload").attr('disabled', 'disabled').addClass('disabled');
            $('#anonUploadError').show();
        }
        else
        {
            $("#anonupload").removeAttr('disabled', 'disabled').removeClass('disabled');
            $('#anonUploadError').hide();
        }  
    });
});

$(document).ready(function () {
    $("#anonRemoveBtn").click(function () {
        $("#anonupload").attr('disabled', 'disabled').addClass('disabled');
        $('#anonUploadError').hide();
    });                               
});

$(document).ready(function () {
    $('#regularUploadError').hide();
    $("#regularUpload").attr('disabled', 'disabled').addClass('disabled');
    var myFile = document.getElementById('file');             
    var allowed = ["jpg", "jpeg", "gif", "bmp", "png"];
    myFile.addEventListener('change', function() {
        if (this.files[0].size === 0 || this.files[0].size > 31457280 || $.inArray(this.files[0].name.split('.').pop().toLowerCase(), allowed) === -1) 
        {
            $("#regularUpload").attr('disabled', 'disabled').addClass('disabled');
            $('#regularUploadError').show();
        }
        else
        {
            $("#regularUpload").removeAttr('disabled', 'disabled').removeClass('disabled');
            $('#regularUploadError').hide();
        }  
    });
});

$(document).ready(function () {
    $("#removeBtn").click(function () {
        $("#regularUpload").attr('disabled', 'disabled').addClass('disabled');
        $('#regularUploadError').hide();
    });                               
});
