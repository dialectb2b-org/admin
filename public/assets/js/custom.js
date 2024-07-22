$(function() {
    $(".dropify").dropify(),
    $(".dropify-fr").dropify({
        messages: {
            default: "Glissez-déposez un fichier ici ou cliquez",
            replace: "Glissez-déposez un fichier ou cliquez pour remplacer",
            remove: "Supprimer",
            error: "Désolé, le fichier trop volumineux"
        }
    });
    var e = $("#input-file-events").dropify();
    e.on("dropify.beforeClear", function(e, r) {
        return confirm('Do you really want to delete "' + r.file.name + '" ?')
    }),
    e.on("dropify.afterClear", function(e, r) {
        alert("File deleted")
    }),
    e.on("dropify.errors", function(e, r) {
        console.log("Has Errors")
    });
    var r = $("#input-file-to-destroy").dropify();
    r = r.data("dropify"),
    $("#toggleDropify").on("click", function(e) {
        e.preventDefault(),
        r.isDropified() ? r.destroy() : r.init()
    })

    $('.summernote').summernote({
        height: 150,   //set editable area's height
        codemirror: { // codemirror options
            theme: 'default'
        }
    });

    $('.js-example-basic-multiple').select2();

    $("body").on("click",".removeentry",function(){
        var action = $(this).data('action');
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).data('id');
        swal.fire({
           title: "Are you sure?",
           text: "You won't be able to revert this!",
           type: "warning",
           showCancelButton: !0,
           confirmButtonText: "Yes, delete it!",
           cancelButtonText: "No, cancel!",
           reverseButtons: !0,
       })
       .then(function (t) {
           if(t.value == true){
               $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
               $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
               $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
               $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
               $('body').find('.remove-form').submit();
           }
       });            
   });

});

function playaudio(msgtxt){
    if ('speechSynthesis' in window) {
        var msg = new SpeechSynthesisUtterance();
        var voices = window.speechSynthesis.getVoices();
        msg.voice = voices[2]; 
        msg.volume = 1; // From 0 to 1
        msg.rate = 1; // From 0.1 to 10
        msg.pitch = 2; // From 0 to 2
        msg.text = msgtxt;
        msg.lang = 'en-US';
        speechSynthesis.speak(msg);
    }else{
        alert("Sorry, your browser doesn't support the speech synthesis API !");
    }
}     

function createSlug(){ 
    var slug = $('#name').val();
    slug = slug.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
    slug = slug.replace(/^\s+|\s+$/gm,'');
    slug = slug.replace(/\s+/g, '-');
    $('#slug').val(slug);
 }