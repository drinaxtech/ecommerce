<?php $this->setSiteTitle('Orders'); ?>
<?php $this->start('body'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="page-title">
            <h3>Orders</h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover" id="dataTables">

                </table>
            </div>
        </div>
    </div>
</div>




<?php $this->end(); ?>

<?php $this->start('footer'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/dashboard/js/datatables.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/dashboard/js/initiate-datatables.js"></script>

<script>

const baseUrl = "<?php echo BASE_URL; ?>";

(function() {
    load_ordersDataTable();
})();

$('#add-category').validate({
    errorClass: "text-danger border-danger",
    submitHandler: function(form) {

        $.ajax({
            url: "<?php echo BASE_URL; ?>dashboard/save_category",
            data: {
                name: $('#name').val()
            },
            type: 'POST',
            success: function(data) {
                data = JSON.parse(data);
                alertify[data.status](data.message);
                $('#resetForm').click();
                $('#addCategoryModal').modal('hide');
                $('#dataTables').DataTable().ajax.reload();
            },
            error: function(data) {
                let error = data.responseJSON;
                alertify['error'](error.message);
                $('#addProductModal').modal('hide');
            }
        });
    }
});


$('#edit-category').validate({
    errorClass: "text-danger border-danger",
    submitHandler: function(form) {

        $.ajax({
            url: "<?php echo BASE_URL; ?>dashboard/update_category",
            data: {
                id: $('#category_id').val(),
                name: $('#editName').val()
            },
            type: 'POST',
            success: function(data) {
                data = JSON.parse(data);
                alertify[data.status](data.message);
                $('#resetEditForm').click();
                $('#editCategoryModal').modal('hide');
                $('#dataTables').DataTable().ajax.reload();
            },
            error: function(data) {
                let error = data.responseJSON;
                alertify['error'](error.message);
                $('#editProductModal').modal('hide');
            }
        });
    }
});

function deleteCategory(id) {
    bootbox.confirm({
        message: "Are you sure?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function(result) {
            if (result) {
                $.post('<?php echo BASE_URL; ?>dashboard/delete_category', {
                    id: id
                }, function(data) {
                    alertify['success']('Deleted successfully!');
                    $('#dataTables').DataTable().ajax.reload();

                });
            }


        }
    });
}


function editCategoryModal(id) {
    let data = $('#category_' + id).data('stringify');
    $('#category_id').val(data.id);
    $('#editName').val(data.name);

    $('#editCategoryModal').modal('show');
}
</script>

<?php $this->end(); ?>