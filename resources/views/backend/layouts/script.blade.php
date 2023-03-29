<script>
    $(document).ready(function() {
        $('.datepicker').datetimepicker({
            format:'YYYY-MM-DD HH:mm:ss',
            'minDate' : new Date()
        });
    });

//    $('.textarea').wysihtml5();
    function init_summernote(){
        $('.textarea').summernote({
            toolbar: [
                ['style', ['style']],
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'hr']],
                ['table', ['table']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],

        });
    }
    init_summernote();
</script>