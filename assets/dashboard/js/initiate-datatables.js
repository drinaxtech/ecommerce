function load_productsDataTable() {

    var table = $("#dataTables").DataTable({
        responsive: true,
        pageLength: 20,
        lengthChange: false,
        searching: true,
        ordering: true,
      lengthMenu: [
        [5, 10, 20, 50, 100, 200, 500, -1],
        [5, 10, 20, 50, 100, 200, 500, "All"],
      ],
      pageLength: 5,
      ajax: {
        type: "get",
        url: BASE_URL + "dashboard/get_products",
        dataSrc: "",
      },
      columns: [
          
        {
          title: "ID",
          data: "product_id"
        },
        {
          title: "Name",
          data: "product_name"
        },
        {
          title: "Description",
          data: null,
          "render": function(data, type, row ){
              
              let description = data.description.replace(/(<([^>]+)>)/gi, "");
              if(description.length > 10) description = description.substring(0,10) + '...';
              return description;
          }
        },
        {
          title: "Price",
          data: "price"
        },
        {
            title: "Quantity",
            data: "quantity"
        },
        {
            title: "Image",
            data: "image"
        },
        {
            title: "Category",
            data: "category_name"
        },
        {
            title: "Created At",
            data: "created_at"
        },
        {
          title: "",
          data: null, 
          "render": function(data, type, row ){

            let newData = {
              id: data.product_id,
              name: data.product_name.replace(/'/g, '&apos;'),
              description: data.description.replace(/'/g, '&apos;'),
              price: data.price.replace(/'/g, '&apos;'),
              quantity: data.quantity.replace(/'/g, '&apos;'),
              image: data.image.replace(/'/g, '&apos;'),
              category: data.category_id
            };
            
            let stringifyData = JSON.stringify(newData);

            let html = '<div style="width: 130px; display: inline-block;"><a id="product_'+data.product_id+'" href="javascript:;" data-stringify=\''+stringifyData+'\' class="btn btn-outline-info btn-rounded" onclick="editProductModal('+data.product_id+')"><i class="fas fa-pen"></i></a>';
            html += '<a href="javascript:;" onclick="deleteProduct('+data.product_id+')" class="btn btn-outline-danger btn-rounded mr-2"><i class="fas fa-trash"></i></a></div>';
            return html;
          }
        }
        
      ]
    });
  
  
}

function load_ordersDataTable() {

  var table = $("#dataTables").DataTable({
      responsive: true,
      pageLength: 20,
      lengthChange: false,
      searching: true,
      ordering: true,
    lengthMenu: [
      [5, 10, 20, 50, 100, 200, 500, -1],
      [5, 10, 20, 50, 100, 200, 500, "All"],
    ],
    pageLength: 5,
    ajax: {
      type: "get",
      url: BASE_URL + "dashboard/get_orders",
      dataSrc: "",
    },
    columns: [
        
      {
        title: "ID",
        data: "id"
      },
      {
        title: "Full Name",
        data: null,
        "render": function(data, type, row ){
          return data.name + ' ' + data.surname;
        }
      },
      {
        title: "Email",
        data: "email"
      },
      {
        title: "Product Name",
        data: "productName"
      },
      {
        title: "Amount",
        data: "amount"
      },
      {
        title: "Quantity",
        data: "quantity"
      },
      {
        title: "Transaction ID",
        data: "transactionId"
      },
      {
        title: "City",
        data: "city"
      },
      {
        title: "Country",
        data: "country"
      },
      {
        title: "Order Time",
        data: "order_time"
      },
      {
        title: "Status",
        data: null, 
        "render": function(data, type, row ){
          return data.paid == 1 ? 'Paid' : 'Not paid';
        }
      },
      
    ],
    initComplete: function( settings, json ) {
      let paidStatus = $('#paidStatus option:selected').val();
      let paidStatusDropdown = $('.paidStatus').html();
      $('.paidStatus').remove();
      let filterContent = '<div class="dataTables_filter d-flex">';
      filterContent += '<label class="d-inline-flex"><span style="margin-right:15px">Paid status:</span>'+paidStatusDropdown + '</label></div>';
      $('.col-sm-12.col-md-6').first().html(filterContent);
      filterDtPaidStatus();
    }
  });


}

function load_categoriesDataTable() {

  var table = $("#dataTables").DataTable({
      responsive: true,
      pageLength: 20,
      lengthChange: false,
      searching: true,
      ordering: true,
    lengthMenu: [
      [5, 10, 20, 50, 100, 200, 500, -1],
      [5, 10, 20, 50, 100, 200, 500, "All"],
    ],
    pageLength: 5,
    ajax: {
      type: "get",
      url: BASE_URL + "dashboard/get_categories",
      dataSrc: "",
    },
    columns: [
        
      {
        title: "ID",
        data: "id"
      },
      {
        title: "Name",
        data: "name"
      },
      {
        title: "",
        data: null, 
        "render": function(data, type, row ){

          let newData = {
            id: data.id,
            name: data.name.replace(/'/g, '&apos;')
          };
          
          let stringifyData = JSON.stringify(newData);

          let html = '<div class="d-flex justify-content-center" style="width: 130px;"><a id="category_'+data.id+'" href="javascript:;" data-stringify=\''+stringifyData+'\' class="btn btn-outline-info btn-rounded" onclick="editCategoryModal('+data.id+')"><i class="fas fa-pen"></i></a>';
          html += '<a href="javascript:;" onclick="deleteCategory('+data.id+')" class="btn btn-outline-danger btn-rounded ml-2"><i class="fas fa-trash"></i></a></div>';
          return html;
        },
        "createdCell": function (td, cellData, rowData, row, col) {

            $(td).attr('style', 'width:20% !important');
            //$(td).addClass('d-flex').addClass('justify-content-center');
          
        }
      }
      
    ]
  });


}

function filterDtPaidStatus() {
  let paidStatus = $('#paidStatus option:selected').val();

  if(paidStatus != '') {
      $("#dataTables").DataTable()
            .columns( 10 )
            .search( '^'+paidStatus+'$', true, false )
            .draw();
  } else {
    $("#dataTables").DataTable()
            .columns( 10 )
            .search( )
            .draw();
  }
}