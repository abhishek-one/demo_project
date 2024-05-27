function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        document.getElementById(`deleteForm_${id}`).submit();
    }
}
$(document).ready(function () {
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/products',
        columns: [{
            data: 'id'
        },
        {
            data: 'product_name'
        },
        {
            data: 'product_price'
        },
        {
            data: 'product_description'
        },
        {
            data: 'product_images',
            name: 'product_images',
            render: function (data) {
                return data;
            }
        },
        {
            data: 'id',
            render: function (data) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                return `
                <a href="/products/${data}/edit" class="btn btn-sm btn-warning">Edit</a>
                <form id="deleteForm_${data}" method="POST" action="/products/${data}" style="display:inline;">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(${data})">Delete</button>
                </form>    `;
            }
        }
        ]
    });
});