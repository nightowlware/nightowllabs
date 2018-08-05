@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>EZ File Share - Drag and Drop Files</strong>
        <br>
    </p>
    <hr>

    <form action="{{ route('fileshare') }}" enctype="multipart/form-data" class="dropzone" id="fileshare-dropzone">
        @csrf
    </form>

</div>


<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;

    window.onload = function () {
        const opts = {
            paramName: 'file',
            maxFilesize: 2048, // MB
            maxFiles: 5,
            clickable: false,
            dictDefaultMessage: "Simply drag&drop files in here, wait for them to upload, then click 'Copy Link' to share. The files are not guaranteed to be hosted for more than a day or so.",
            init: function() {
                this.on("success", function(file, response) {
                    let a = document.createElement('span');
                    a.className = "thumb-url btn btn-primary";
                    a.setAttribute('data-clipboard-text', response);
                    a.innerHTML = "Copy Link";
                    a.style.width = "100%";

                    file.previewElement.appendChild(a);
                    file.previewElement.firstElementChild.style.width = '250px';
                });
            }
        };

        const uploader = document.querySelector('#fileshare-dropzone');
        const newDropzone = new Dropzone(uploader, opts);

        $('.thumb-url').tooltip({
            trigger: 'click',
            placement: 'bottom'
        });

        function setTooltip(btn, message) {
            $(btn).tooltip('hide')
                .attr('data-original-title', message)
                .tooltip('show');
        }

        function hideTooltip(btn) {
            setTimeout(function() {
                $(btn).tooltip('hide');
            }, 500);
        }

        let clipboard = new Clipboard('.thumb-url');

        clipboard.on('success', function(e) {
            e.clearSelection();
            setTooltip(e.trigger, 'Copied!');
            hideTooltip(e.trigger);
        });

        clipboard.on('error', function(e) {
            e.clearSelection();
            setTooltip(e.trigger, 'Failed to copy');
            hideTooltip(e.trigger);
        });
    };
</script>

<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">

@endsection
