<?php $this->setSiteTitle('Categories'); ?>
<?php $this->start('body'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="page-title">
            <h3>Categories
                <a href="javascript:;" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal"
                    data-target="#addCategoryModal"><i class="fas fa-plus-circle"></i> Add</a>
            </h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover" id="dataTables">

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-category" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" id="resetForm" class="d-none">Reset</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="edit-category" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="category_id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="editName" placeholder="Name"
                                required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" id="resetEditForm" class="d-none">Reset</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </div>
        </form>
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
    load_categoriesDataTable();
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