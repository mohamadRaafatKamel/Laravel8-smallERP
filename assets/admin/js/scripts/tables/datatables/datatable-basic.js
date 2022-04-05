/*=========================================================================================
    File Name: datatables-basic.js
    Description: Basic Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function() {

/****************************************
*       js of zero configuration        *
****************************************/

$('.zero-configuration').DataTable();

/**************************************
*       js of default ordering        *
**************************************/

// $('.default-ordering').DataTable( {
//     "order": [[ 0, "desc" ]]
// } );

/**************************************
*       js of ordering and print file       *
**************************************/

// Setup - add a text input to each footer cell
$('.ordering-print tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="'+title+'" />' );
} );

var tableSearching =$('.ordering-print').DataTable( {
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf', 'print'
    ]
} );
// Button style
$('.buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

// Apply the search
tableSearching.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
            that
                .search( this.value )
                .draw();
        }
    } ); 
} );


// Col7 

// Setup - add a text input to each footer cell
$('.ordering-col7-print tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="'+title+'" />' );
} );

var tableSearching =$('.ordering-col7-print').DataTable( {
    "order": [[ 6, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf', 'print'
    ]
} );
// Button style
$('.buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

// Apply the search
tableSearching.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
            that
                .search( this.value )
                .draw();
        }
    } ); 
} );

/***************************************************************
*       js of Individual column searching (text inputs)        *
***************************************************************/

// Setup - add a text input to each footer cell
// $('.text-inputs-searching tfoot th').each( function () {
//     var title = $(this).text();
//     $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
// } );

// // DataTable
// var tableSearching = $('.text-inputs-searching').DataTable();

// // Apply the search
// tableSearching.columns().every( function () {
//     var that = this;

//     $( 'input', this.footer() ).on( 'keyup change', function () {
//         if ( that.search() !== this.value ) {
//             that
//                 .search( this.value )
//                 .draw();
//         }
//     } );
// } );

/************************************
*       js of multi ordering        *
************************************/

$('.multi-ordering').DataTable( {
    columnDefs: [ {
        targets: [ 0 ],
        orderData: [ 0, 1 ]
    }, {
        targets: [ 1 ],
        orderData: [ 1, 0 ]
    }, {
        targets: [ 4 ],
        orderData: [ 4, 0 ]
    } ]
} );

/*************************************
*       js of complex headers        *
*************************************/

$('.complex-headers').DataTable();

/*************************************
*       js of dom positioning        *
*************************************/

$('.dom-positioning').DataTable( {
    "dom": '<"top"i>rt<"bottom"flp><"clear">'
} );

/************************************
*       js of alt pagination        *
************************************/

$('.alt-pagination').DataTable( {
    "pagingType": "full_numbers"
} );

/*************************************
*       js of scroll vertical        *
*************************************/

$('.scroll-vertical').DataTable( {
    "scrollY":        "200px",
    "scrollCollapse": true,
    "paging":         false
} );

/************************************
*       js of dynamic height        *
************************************/

$('.dynamic-height').DataTable( {
    scrollY:        '50vh',
    scrollCollapse: true,
    paging:         false
} );

/***************************************
*       js of scroll horizontal        *
***************************************/

$('.scroll-horizontal').DataTable( {
    "scrollX": true
} );

/**************************************************
*       js of scroll horizontal & vertical        *
**************************************************/

$('.scroll-horizontal-vertical').DataTable( {
    "scrollY": 200,
    "scrollX": true
} );

/**********************************************
*       Language - Comma decimal place        *
**********************************************/

$('.comma-decimal-place').DataTable( {
    "language": {
        "decimal": ",",
        "thousands": "."
    }
} );


});