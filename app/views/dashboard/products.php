<?php $this->setSiteTitle('Products'); ?>
<?php $this->start('head'); ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.btn-group .active {
    background-color: #eee !important;
}

table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child::before, table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child::before {
    top: unset !important;
    left: 0px !important;
}
</style>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="content">
    <div class="w-100 table-responsive">
        <div class="page-title">
            <h3>Products
                <a href="javascript:;" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal"
                    data-target="#addProductModal"><i class="fas fa-plus-circle"></i> Add</a>
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="add-product" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
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
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom02">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                placeholder="Description">
                        </textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" id="price"
                                placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity"
                                placeholder="Quantity" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="price">Image</label>
                            <input type="file" name="image" class="form-control" id="image" required>
                            <div class="d-flex col-sm-12 mt-2 justify-content-center">
                                <img src="<?php echo BASE_URL; ?>assets/images/products/img-preview.png" id="preview"
                                    class="img-thumbnail" alt="preview" style="max-height: 160px;" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php if(count($categories) > 0): ?>
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" id="resetForm" class="d-none">Reset</button>
                    <button type="submit" class="btn btn-primary">Save product</button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="edit-product" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="product_id">

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="editName" placeholder="Name"
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom02">Description</label>
                            <textarea name="description" id="editDescription" class="form-control"
                                placeholder="Description">
                        </textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" id="editPrice"
                                placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="editQuantity"
                                placeholder="Quantity" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="price">Image</label>
                            <input type="file" name="editImage" class="form-control" id="editImage">
                            <div class="d-flex col-sm-12 mt-2 justify-content-center">
                                <img src="<?php echo BASE_URL; ?>assets/images/products/img-preview.png" id="editPreview"
                                    class="img-thumbnail" alt="preview" style="max-height: 160px;" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="editCategory" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php if(count($categories) > 0): ?>
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" id="resetEditForm" class="d-none">Reset</button>
                    <button type="submit" class="btn btn-primary">Update product</button>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
const baseUrl = "<?php echo BASE_URL; ?>";

(function() {
    $('#description, #editDescription').summernote({
        height: 100
    });
    $('.note-icon-caret, .note-color, .note-view, .note-insert').hide();
    $('.panel-heading').addClass('bg-light');
    load_productsDataTable();
})();

document.getElementById('image').onchange = function() {

var reader = new FileReader();
reader.onload = function(e) {
    $('#preview').attr('src', e.target.result);
};

reader.readAsDataURL($("#image")[0].files[0]);
};

document.getElementById('editImage').onchange = function() {

    var reader = new FileReader();
    reader.onload = function(e) {
        $('#editPreview').attr('src', e.target.result);
    };

    reader.readAsDataURL($("#editImage")[0].files[0]);
};


$.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
});


$('#add-product').validate({
    errorClass: "text-danger border-danger",
    rules: {
        image: {
            required: true,
            extension: "png|jpe?g|gif",
            filesize: 1048576
        },
        editImage: {
            extension: "png|jpe?g|gif",
            filesize: 1048576
        }
    },
    messages: {
        image: "File must be JPG, GIF or PNG, less than 1MB",
        editImage: "File must be JPG, GIF or PNG, less than 1MB"
    },
    submitHandler: function(form) {
        var formData = new FormData(form);
        formData.append('description', $('#description').summernote('code'));
        formData.append('image', $("#image")[0].files[0]);

        $.ajax({
            url: "<?php echo BASE_URL; ?>dashboard/add_product",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                alertify[data.status](data.message)

                $('#resetForm').click();
                $('#addProductModal').modal('hide');
                $("#description").summernote("code", "");
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

$('#edit-product').validate({
    errorClass: "text-danger border-danger",
    rules: {
        image: {
            required: true,
            extension: "png|jpe?g|gif",
            filesize: 1048576
        }
    },
    messages: {
        image: "File must be JPG, GIF or PNG, less than 1MB"
    },
    submitHandler: function(form) {
        var formData = new FormData(form);
        formData.append('description', $('#editDescription').summernote('code'));
        if ($("#editImage")[0].files && $("#editImage")[0].files[0]) {
            formData.append('img_changed', '1');
            formData.append('image', $("#editImage")[0].files[0]);
        }


        $.ajax({
            url: "<?php echo BASE_URL; ?>dashboard/update_product",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                alertify[data.status](data.message)
                $('#editProductModal').modal('hide');
                $('#resetEditForm').click();
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


function deleteProduct(id) {
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
                $.post('<?php echo BASE_URL; ?>dashboard/delete_product', {
                    id: id
                }, function(data) {
                    alertify['success']('Deleted successfully!');
                    $('#dataTables').DataTable().ajax.reload();

                });
            }


        }
    });
}

function editProductModal(id) {
    let data = $('#product_' + id).data('stringify');
    $('#editPreview').attr('src', baseUrl + 'assets/images/products/' + data.image);
    $('#product_id').val(data.id);
    $('#editName').val(data.name);
    $("#editDescription").summernote("code", data.description);
    $('#editPrice').val(data.price);
    $('#editQuantity').val(data.quantity);
    $('#editCategory').val(data.category);
    //console.log(data);
    $('#editProductModal').modal('show');
}
</script>

<?php $this->end(); ?>