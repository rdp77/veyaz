@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.2/dataTables.bootstrap5.min.css" integrity="sha512-3VQ5YOquRk3XRbF17BuokXD8FKDJNlZmlXN8Ws3oTFRmuw0wLz5Ba4JuKgY2GNzARgTGLW1Bt+Ubzbl4gA5R4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.2/dataTables.bootstrap5.min.js" integrity="sha512-SfExRKPoCXOgJZjjO5T37PAjzs7EYyLW4iuFpqV4QHp66Hcv/QZtbcD1Mo0WqpJa1gw/G9Mi+AgPkY75rKBjvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$(function() {
    $('.datatable').dataTable()
});
</script>
@endpush
