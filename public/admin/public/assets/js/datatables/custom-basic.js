$(document).ready(function() {
    $('product-list').DataTable();
    // Basic table example
    
// new DataTable('#basic-1', {
//     layout: {
//         topStart: {
//              buttons: [
//                  { extend: 'copy', className: 'btn btn-info text-white' },
//         { extend: 'pdf', className: 'btn btn-dashed text-white' },
//         { extend: 'excel', className: 'btn btn-dashed text-white' }
//     ]
        
//         }
//     }
// });

new DataTable('#basic-2', {
    layout: {
        topStart: {
             buttons: [
                 { extend: 'copy', className: 'btn btn-dashed text-white' },
        { extend: 'pdf', className: 'btn btn-dashed text-white' },
        { extend: 'excel', className: 'btn btn-dashed text-white' }
    ]
        
        }
    }
});
    
    // $('#basic-1').DataTable();
    $('#basic-2').DataTable();
    $('#basic-3').DataTable();
    $('#basic-4').DataTable();
    $('#basic-5').DataTable();
    $('#basic-6').DataTable();
    $('#basic-7').DataTable();
    $('#basic-8').DataTable();
    $('#basic-9').DataTable();
    $('#basic-10').DataTable();
    $('#basic-11').DataTable();
    $('#basic-12').DataTable();
    $('#basic-13').DataTable();
    $('#basic-14').DataTable();
    $('#basic-15').DataTable();
});
