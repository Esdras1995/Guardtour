$(function(){
    function initBackgrid(){
        Backgrid.InputCellEditor.prototype.attributes.class = 'form-control input-sm';

        var Territory = Backbone.Model.extend({});

        var PageableTerritories = Backbone.PageableCollection.extend({
            model: Territory,
            url: "demo/json/pageable-territories.json",
            state: {
                pageSize: 9
            },
            mode: "client" // page entirely on the client side
        });


        var pageableTerritories = new PageableTerritories(),
            initialTerritories = pageableTerritories;

        function createBackgrid(collection){
            var columns = [{
                name: "id", // The key of the model attribute
                label: "ID", // The name to display in the header
                editable: false, // By default every cell in a column is editable, but *ID* shouldn't be
                // Defines a cell type, and ID is displayed as an integer without the ',' separating 1000s.
                cell: Backgrid.IntegerCell.extend({
                    orderSeparator: ''
                })
            }, {
                name: "name",
                label: "Name",
                // The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
                cell: "string" // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up
            }, {
                name: "pop",
                label: "Population",
                cell: "integer" // An integer cell is a number cell that displays humanized integers
            }, {
                name: "url",
                label: "URL",
                cell: "uri" // Renders the value in an HTML <a> element
            }];
            if (Sing.isScreen('xs')){
                columns.splice(3,1)
            }
            var pageableGrid = new Backgrid.Grid({
                columns: columns,
                collection: collection,
                className: 'table table-striped table-editable no-margin mb-sm'
            });

            var paginator = new Backgrid.Extension.Paginator({

                slideScale: 0.25, // Default is 0.5

                // Whether sorting should go back to the first page
                goBackFirstOnSort: false, // Default is true

                collection: collection,

                controls: {
                    rewind: {
                        label: '<i class="fa fa-angle-double-left fa-lg"></i>',
                        title: "First"
                    },
                    back: {
                        label: '<i class="fa fa-angle-left fa-lg"></i>',
                        title: "Previous"
                    },
                    forward: {
                        label: '<i class="fa fa-angle-right fa-lg"></i>',
                        title: "Next"
                    },
                    fastForward: {
                        label: '<i class="fa fa-angle-double-right fa-lg"></i>',
                        title: "Last"
                    }
                }
            });

            $("#table-dynamic").html('').append(pageableGrid.render().$el).append(paginator.render().$el);
        }

        SingApp.onResize(function(){
            createBackgrid(pageableTerritories);
        });

        createBackgrid(pageableTerritories);

        $("#search-countries").keyup(function(){

            var $that = $(this),
                filteredCollection = initialTerritories.fullCollection.filter(function(el){
                    return ~el.get('name').toUpperCase().indexOf($that.val().toUpperCase());
                });
            createBackgrid(new PageableTerritories(filteredCollection, {
                state: {
                    firstPage: 1,
                    currentPage: 1
                }
            }));
        });


        pageableTerritories.fetch();

        $('.input-group-transparent, .input-group-no-border').transparentGroupFocus();
    }
    function initDataTables(){
        /* Set the defaults for DataTables initialisation */
        $.extend( true, $.fn.dataTable.defaults, {
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            }
        } );


        /* Default class modification */
        $.extend( $.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
        } );


        /* API method to get paging information */
        $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
        {
            return {
                "iStart":         oSettings._iDisplayStart,
                "iEnd":           oSettings.fnDisplayEnd(),
                "iLength":        oSettings._iDisplayLength,
                "iTotal":         oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage":          oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
                "iTotalPages":    oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
            };
        };


        /* Bootstrap style pagination control */
        $.extend( $.fn.dataTableExt.oPagination, {
            "bootstrap": {
                "fnInit": function( oSettings, nPaging, fnDraw ) {
                    var oLang = oSettings.oLanguage.oPaginate;
                    var fnClickHandler = function ( e ) {
                        e.preventDefault();
                        if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                            fnDraw( oSettings );
                        }
                    };

                    $(nPaging).append(
                            '<ul class="pagination no-margin">'+
                            '<li class="prev disabled"><a href="#">'+oLang.sPrevious+'</a></li>'+
                            '<li class="next disabled"><a href="#">'+oLang.sNext+'</a></li>'+
                            '</ul>'
                    );
                    var els = $('a', nPaging);
                    $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
                    $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
                },

                "fnUpdate": function ( oSettings, fnDraw ) {
                    var iListLength = 5;
                    var oPaging = oSettings.oInstance.fnPagingInfo();
                    var an = oSettings.aanFeatures.p;
                    var i, ien, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

                    if ( oPaging.iTotalPages < iListLength) {
                        iStart = 1;
                        iEnd = oPaging.iTotalPages;
                    }
                    else if ( oPaging.iPage <= iHalf ) {
                        iStart = 1;
                        iEnd = iListLength;
                    } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                        iStart = oPaging.iTotalPages - iListLength + 1;
                        iEnd = oPaging.iTotalPages;
                    } else {
                        iStart = oPaging.iPage - iHalf + 1;
                        iEnd = iStart + iListLength - 1;
                    }

                    for ( i=0, ien=an.length ; i<ien ; i++ ) {
                        // Remove the middle elements
                        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                        // Add the new list items and their event handlers
                        for ( j=iStart ; j<=iEnd ; j++ ) {
                            sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                            $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                                .insertBefore( $('li:last', an[i])[0] )
                                .bind('click', function (e) {
                                    $(".check-item").prop('checked', false);
                                    $("#select-all").prop('checked', false);
                                    e.preventDefault();
                                    oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                                    fnDraw( oSettings );
                                } );
                        }

                        // Add / remove disabled classes from the static elements
                        if ( oPaging.iPage === 0 ) {
                            $('li:first', an[i]).addClass('disabled');
                        } else {
                            $('li:first', an[i]).removeClass('disabled');
                        }

                        if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                            $('li:last', an[i]).addClass('disabled');
                        } else {
                            $('li:last', an[i]).removeClass('disabled');
                        }
                    }
                }
            }
        } );

        var unsortableColumns = [];
        $('#datatable-table').find('thead th').each(function(){
            if ($(this).hasClass( 'no-sort')){
                unsortableColumns.push({"bSortable": false});
            } else {
                unsortableColumns.push(null);
            }
        });

        $("#datatable-table").dataTable({
            "sDom": "<'row'<'col-md-6 hidden-xs'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sInfo": "Showing <strong>_START_ to _END_</strong> of _TOTAL_ entries"
            },
            "oClasses": {
              "sFilter": "pull-right",
              "sFilterInput": "form-control input-rounded ml-sm"
            },
            
            "aoColumns": unsortableColumns,

            "fnDrawCallback": function () {
              // window.pageLength = this.fnPagingInfo().iLength;
              selectedData(0, this.fnPagingInfo().iTotal);
              $(".check-item").prop('checked', false);
              $("#select-all").prop('checked', false);
              $('tr').removeClass('to-remove');
            }
        });       
        

        $(".dataTables_length select").selectpicker({
            width: 'auto'
        });
    }

        function selectedData(selected, entries){
            $(".selected-item").html(selected+" of "+entries+" entries");
        }
        var selected = 0;
        $("#select-all").on("click", function(){

            var table = $('#datatable-table').DataTable();
            var info = table.page.info();
            // alert("jghgghgfgfg");

            // var page = 
            // var length = info.length;
            // var recordsTotal = info.recordsTotal;

            // alert(length);
            var entries = info.recordsTotal;

            if($(this).is(':checked')){
                $(".check-item").prop('checked', true);
                $('tr').addClass('to-remove');
                // $('tr'),addClass
                selected = info.end - info.start;
            }
            else{

                $(".check-item").prop('checked', false);
                $('tr').removeClass('to-remove');
                selected = 0;
            }

            selectedData(selected, entries);

            // $('#datatable-table tr td:nth-child(2)').addClass('edit');

            // for (var i = 0; i <=length; i++) {

            //     $("#datatable-table tr:eq("+i+")").find("td.item").each(function(){
            //         // if($(this).text())
            //             console.log($(this).text()+" - ");
            //     });
            //     console.log("\n");
            // }

            // var text = $("#datatable-table tr:eq("+t+") td:eq(0)").text();
        });
    $('.check-item').on('click', function(){
       
        var table = $('#datatable-table').DataTable();
        var info = table.page.info();
        var entries = info.recordsTotal;
        
        if(!$(this).is(':checked')){

            if($('#select-all').is(':checked'))
                $("#select-all").prop('checked', false);
            --selected;
            $(this).closest("tr").removeClass('to-remove');
        }else{

            if(++selected == info.end - info.start){
                $("#select-all").prop('checked', true);
            }
            $(this).closest("tr").addClass('to-remove');
        }

        selectedData(selected, entries);
    });

    // $('.delete').on('click', function(){
    //     for (var i = 0; i <=length; i++) {

    //         $("#datatable-table tr:eq("+i+")").find("td.item").each(function(){
    //             // if($(this).text())
    //                 console.log($(this).text()+" - ");
    //         });
    //         console.log("\n");
    //     }        
    // });

    function pageLoad(){
        $('.widget').widgster();
        initBackgrid();
        initDataTables();
    }
    // selectedData(0, $('#datatable-table').DataTable().info().recordsTotal);
    pageLoad();
    SingApp.onPageLoad(pageLoad);

    $('.del-selected').on('click', function(){
        if(selected == 0){
            $('.modal-body').html('<i class="glyphicon glyphicon-warning-sign" style="font-size: 2em; color: #DD5826;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Nothing to delete!');
            $('.no').prop('disabled', true);
            $('.delete').prop('disabled', true);
        }
        else{
            $('.modal-body').html('<i class="glyphicon glyphicon-remove" style="font-size: 2em; color: red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Are you sure you wan\'t to delete selected data?');
            $('.no').prop('disabled', false);
            $('.delete').prop('disabled', false);
        }
    });

    $('.delete').on('click', function(){
        // var allId = {"id":[]};
        if(selected != 0){
            
            // var objTmpl = {};
            // var key = [];

            // $('tr .key').each(function(i){
            //     objTmpl[$(this).text()] = '';
            //     key[i] = $(this).text();
            // });

            // // console.log(key, objTmpl);
            
            // var dataToDelete = [];
            // var arrayTemp = JSON.parse(JSON.stringify(objTmpl));

            var allId = [];

            $('.to-remove td:nth-child(2)').each(function(){
                 allId.push($(this).text());
            });

           $.post('delete.php', {id: JSON.stringify(allId)});
           $('.modal-body').html('<i class="glyphicon glyphicon-ok" style="font-size: 2em; color: green;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Successfully deleted!');
           $('.no').prop('disabled', true);
           $('.delete').prop('disabled', true);
           // console.log(JSON.stringify(allId));
           location.reload();
        }
    });


// $('.delete').on('click', function(){
//         // var allId = {"id":[]};
//         if(selected != 0){
            
//             var objTmpl = {};
//             var key = [];

//             $('tr .key').each(function(i){
//                 objTmpl[$(this).text()] = '';
//                 key[i] = $(this).text();
//             });

//             // console.log(key, objTmpl);
            
//             var dataToDelete = [];
//             $('.to-remove').each(function(){
//                 var arrayTemp = JSON.parse(JSON.stringify(objTmpl));

//                 $(this).find('.item').each(function(i){
//                     arrayTemp[key[i]] = $(this).text();
//                     if(key.length == i+1)
//                         dataToDelete.push(arrayTemp);
//                 });
//             });

//            $.post('delete.php', {id: JSON.stringify(dataToDelete)});
//            $('.modal-body').html('<i class="glyphicon glyphicon-ok" style="font-size: 2em; color: green;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Successfully deleted!');
//            $('.no').prop('disabled', true);
//            $('.delete').prop('disabled', true);
//            console.log(JSON.stringify(dataToDelete));
//         }
//     });
});