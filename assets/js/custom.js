


/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
           
            /*====================================
              LOAD APPROPRIATE MENU BAR
           ======================================*/
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
        },
        initialization: function () {
            mainApp.main_fun();

        }
    }
    // Initializing ///

    $(document).ready(function () {
        var currentdate = new Date();
        var datetime = currentdate.getDate() + "/"
            + (currentdate.getMonth()+1)  + "/"
            + currentdate.getFullYear() + " @ "
            + currentdate.getHours() + ":"
            + currentdate.getMinutes() + ":"
            + currentdate.getSeconds();
        mainApp.main_fun();
        $('#datatable1').DataTable();        
        $('#printable').DataTable( {
            order: [[ 3, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
               
                'print',
                {   extend: 'pdfHtml5',
                    title: 'Booking report on '+ datetime,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7 ],
                        stripNewlines: false
                    },
                    messageBottom: function () {
                        return $('#total').text();
                    },


                }

    ]
        } );

        $('#printable_car').DataTable( {
            order: [[ 3, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                'print',
                {   extend: 'pdfHtml5',
                    title: 'Car report on '+datetime,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7 ],
                        stripNewlines: true
                    },
                    messageBottom: function () {
                        return "\n"+$('#total').text();
                    },
                    messageTop: function () {
                        return "\n"+$('#top').text();
                    },


                }

            ]
        } );

    });

}(jQuery));

