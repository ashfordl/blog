<script type="text/javascript">
    var postUrl = "{{ action('UserAdminController@postUpdateBan') }}";
    var userId = {{ $user->id }};
    var csrf = "{{ csrf_token() }}";
</script>