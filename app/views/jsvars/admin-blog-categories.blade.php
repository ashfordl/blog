<script type="text/javascript">
    var postUrl = "{{ action('CategoryAdminController@postEdit') }}";
    var deleteUrl = "{{ action('CategoryAdminController@postDelete') }}";
    var csrf = "{{ csrf_token() }}";
</script>