<!-- Modal Delete Poi -->
<div class="modal fade custom-modal" id="delete-poi" tabindex="-1" role="dialog" aria-labelledby="myModalAdd" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-warning">
                    <i class="fa fa-exclamation-triangle fa"></i>&nbsp;<h3 class="block-title">Error Message When Import Template</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- Basic Elements -->
                    @if (Session::has('errorTemplating'))
                        <div class="table-responsive">
                            <table id="table_product" class="table table-bordered table-striped table-vcenter nowrap">   
                                <thead>
                                    <tr>
                                        <th class="text-center">Line</th>
                                        <th class="text-center">Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Session::get('errorTemplating') as $good)
                                        <tr>
                                            <td class="text-center">{{ $good->line }}</td>
                                            <td class="text-center">{{ $good->reason }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <!-- END Input Grid Sizes -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script type="text/javascript">
    $(document).ready(function() {
        var errorMsg = '<?= Session::has('errorTemplating'); ?>';
        if(errorMsg) $('#delete-poi').modal('show');
    });
</script>