@extends('layouts.app')
@section('content')

    <script src="{{ asset('assets/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
    
     tinymce.init({
            selector: 'textarea#mytextarea',
            menubar: false,
            plugins: 'anchor autolink charmap emoticons link lists searchreplace table visualblocks wordcount checklist casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss contextmenu paste ',
            toolbar: 'undo redo cut copy paste | fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat', //blocks
            toolbar_location: 'bottom',
            tinycomments_mode: 'embedded',
            paste_as_text: true,
            elementpath: false,
            branding: false,
            paste_data_images: true,
            contextmenu: "paste | link image inserttable | cell row column deletetable",
            skin: 'oxide',
            setup: function (ed) {
                ed.on('init', function (e) {
                    ed.execCommand("fontName", false, "Verdana");
                });
            }
        });

    //   tinymce.init({
    //     selector: '#mytextarea'
    //   });
    </script>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> User Agreement</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{">User Agreement</a></li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <div class="card-body">
                        <form action="{{ route('save-user-agreement') }}" method="POST" >
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <textarea class="mytextarea" id="mytextarea" name="content" >{!! $content->user_agreement !!}</textarea>
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-12 text-right mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
            <!-- end form -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
    @push('scripts')
        <script>

            function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 46 && charCode > 31 
                    && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

        </script>
    @endpush
@endsection