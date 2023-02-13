
//global js for the admin panel

$(document).ready(function () {

    //setting csrf token in all ajax calls in the application
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });


    //modal window code for add ons
    $('#menuModal').on('show.bs.modal', function (e) {

        var button = $(e.relatedTarget);
        var modal = $(this);
        // or, load content from value of data-remote url
        modal.find('.modal-body').load(button.data("remote"));

    });

    $(document).delegate(".add-more", 'click', function () {
        var rowlen = parseInt($('#rowsnumber').val()) + 1;
        $('#rowsnumber').val(rowlen);
        $(".after-add-more").append('<div class="row small-top"><div class="col-md-4"><input type="text" style="width:100% !important;" placeholder="Title" class="form-control custom-box-addon" autocomplete="off" placeholder="Enter Username" id="title_' + rowlen + '" name="title[' + rowlen + ']"></div><div class="col-md-3"><input type="text"  placeholder="Price" class="form-control custom-box-addon-price allownumbersonly" autocomplete="off" placeholder="Enter password" id="price_' + rowlen + '" name="price[' + rowlen + ']"></div><div class="col-md-4"><input type="text"  placeholder="Note" class="form-control custom-box-addon" autocomplete="off" name="note[' + rowlen + ']" style="width:100% !important;"></div><div class="col-md-1 text-right"><button type="button" class="btn btn-danger btn-sm removeopt"><i class="far fa-trash-alt"></i></button></div></div>');
    });

    $(document).delegate(".removeopt", 'click', function () {
        $(this).parent().parent().remove();
    });

    //saving menu information with ajax
    $(document).delegate("#saveaddonbtn", 'click', function () {
        var formdata = $('#frmaddon').serialize();
        $(".customerroraddon").remove();
        $(this).attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: config.routes.saveaddon,
            data: formdata,
            success: function (data) {
                var res = JSON.parse(data);

                $('#msgbox').html(res.message).removeClass('d-none');
                setTimeout(function () {
                    $("#msgbox").addClass('d-none');
                }, 3000);

                //update existing addon list
                if (res.status == 1) {
                    $("#addonlisting").append(res.newaddon);
                    $(".custom-box-addon, .custom-box-addon-price").val('');
                }
            },
            complete: function () {
                $('#saveaddonbtn').attr("disabled", false);
            },
            error: function (reject) {
                if (reject.status === 422) {
                    var response = JSON.parse(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        key = key.replace('.', '_');
                        $("#" + key).after('<label class="col-form-label float-left text-danger help-block customerroraddon" for="inputError"> ' + val[0] + '</label>');
                    });
                }
            }
        });
    });

    //save addon mapping with menu
    $(document).delegate(".addoncheck", 'click', function () {

        var status = ($(this).is(':checked')) ? 1 : 0;
        var dataAddonId = $(this).attr('data-attr-id');
        $.ajax({
            type: 'POST',
            url: config.routes.saveaddonmapping,
            data: { menu_id: $('#menu-id').val(), addon_id: dataAddonId, status: status },
            success: function (data) {
                var res = JSON.parse(data);
                $('#msgbox').html(res.message).removeClass('d-none');
                setTimeout(function () {
                    $("#msgbox").addClass('d-none');
                }, 3000);

                if (status == 1) {
                    $("#editprice" + dataAddonId).removeClass('d-none');
                    $("#detachprice" + dataAddonId).addClass('d-none');
                    $("#saveprice" + dataAddonId).removeClass('d-none');
                } else {
                    $("#editprice" + dataAddonId).addClass('d-none');
                    $("#detachprice" + dataAddonId).removeClass('d-none');
                    $("#saveprice" + dataAddonId).addClass('d-none');
                }

            },
            error: function (reject) {
            }
        });
    });

    //edit addon price
    $(document).delegate(".editpricelink", 'click', function () {

        var rowid = $(this).attr('data-edit-id');

        $("#savelink" + rowid).removeClass('d-none');
        $("#pricebox" + rowid).removeClass('d-none');
        $("#editprice" + rowid).addClass('d-none');

    });

    var updateAddonPrice = function (rowid = '', menuid = '', price = '') {
        $('.priceerror').remove();
        $.ajax({
            type: 'POST',
            url: config.routes.saveaddonprice,
            data: { menu_id: menuid, addon_id: rowid, price: price },
            success: function (data) {
                var res = JSON.parse(data);
                $('#msgbox').html(res.message).removeClass('d-none');
                setTimeout(function () {
                    $("#msgbox").addClass('d-none');
                }, 3000);

                $("#editprice" + rowid).html(price);
                $("#savelink" + rowid).addClass('d-none');
                $("#pricebox" + rowid).addClass('d-none');
                $("#editprice" + rowid).removeClass('d-none');
            },
            error: function (reject) {
                if (reject.status === 422) {
                    var response = JSON.parse(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#savelink" + rowid).after('<div class="help-block priceerror"><strong>' + val[0] + '</strong></div>');
                    });
                }
            }
        });
    }

    //save addon price
    $(document).delegate(".savepricelink", 'click', function () {

        var rowid = $(this).attr('data-attr-addon-id');
        var menu_id = $('#menu-id').val();
        var price = $("#pricebox" + rowid).val();

        updateAddonPrice(rowid, menu_id, price);

    });

    //save addon price on price box enter keydown
    $(document).delegate(".editpricebox", 'keydown', function () {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {

            var rowid = $(this).attr('data-attr-box-addon-id');
            var menu_id = $('#menu-id').val();
            var price = $("#pricebox" + rowid).val();

            updateAddonPrice(rowid, menu_id, price);
        }

    });

    $(document).delegate(".allownumbersonly", "keydown", function (evt) {
        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) ||
            (event.keyCode >= 96 && event.keyCode <= 105) ||
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault();
        //if a decimal has been added, disable the "."-button
    });

    $(document).delegate(".view-order", "click", function (e) {
        e.preventDefault();
        var vbtn = $(this);
        $.ajax({
            type: 'GET',
            url: vbtn.attr('href'),
            success: function (data) {
                var res = JSON.parse(data);
                $("#orderDetailHeading").html('Order Detail - Order ID #' + vbtn.attr('data-order-id'));
                $('#orderModal').modal({ show: true });
                // setTimeout(function() {
                //   $('#orderDetailBox').html(res.message);
                // }, 3500);
                $('#orderDetailBox').html(res.message);
            }
        });
    });

    var socket = io.connect('http://itexpertiseindia.com:3000');

    //use only if separate button required for processing
    //for now automatically next order will go in processing
    // $(document).delegate(".process-order", 'click', function(){
    //   event.preventDefault();
    //   var pbtn = $ (this);
    //   pbtn.attr('disabled',true);
    //   // Send an AJAX to Laravel
    //   $.ajax ({
    //     url: pbtn.attr('href'),
    //     type: "POST",
    //     data: {
    //       orderid: pbtn.attr('data-order-id'),
    //     },
    //     success: function (result) {
    //       var res = JSON.parse(result);
    //       if(res.status==1) {
    //         socket.emit('processorder', {'orderid':res.orderid,'currentorderid':pbtn.attr('data-order-id'),'eventtype':'eventprocessorder',shownext:true});

    //         $('.pending'+pbtn.attr('data-order-id')).addClass('d-none');
    //         $('.processing'+pbtn.attr('data-order-id')).removeClass('d-none');
    //         $('.process'+pbtn.attr('data-order-id')).addClass('d-none');
    //         $('.markprocessed'+pbtn.attr('data-order-id')).removeClass('d-none');
    //         $('.cancelorder'+pbtn.attr('data-order-id')).removeClass('d-none');

    //       } else {
    //         $("#msgerrorbox").removeClass('d-none');
    //         $('#msgerror').html(res.message);
    //       }
    //       pbtn.attr('disabled',false);
    //     }
    //   });
    // });

    $(document).delegate(".mark-processed", 'click', function () {
        event.preventDefault();
        var pbtn = $(this);
        pbtn.attr('disabled', true);
        // Send an AJAX to Laravel
        $.ajax({
            url: pbtn.attr('href'),
            type: "POST",
            data: {
                orderid: pbtn.attr('data-order-id'),
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res.status == 1) {
                    socket.emit('processorder', { 'orderid': res.orderid, 'currentorderid': pbtn.attr('data-order-id'), 'eventtype': 'eventmarkprocessed', shownext: false });
                    manageQueueButton(res.orderid, pbtn.attr('data-order-id'), 'markprocessed');
                } else {
                    $("#msgerrorbox").removeClass('d-none');
                    $('#msgerror').html(res.message);
                }

                pbtn.attr('disabled', false);
            }
        });
    });

    $(document).delegate(".cancel-order", 'click', function () {
        event.preventDefault();
        var pbtn = $(this);
        pbtn.attr('disabled', true);
        // Send an AJAX to Laravel
        $.ajax({
            url: pbtn.attr('href'),
            type: "POST",
            data: {
                orderid: pbtn.attr('data-order-id'),
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res.status == 1) {
                    socket.emit('processorder', { 'orderid': res.orderid, 'currentorderid': pbtn.attr('data-order-id'), 'eventtype': 'eventcancelorder', shownext: false });
                    manageQueueButton(res.orderid, pbtn.attr('data-order-id'), 'cancelorder');
                } else {
                    $("#msgerrorbox").removeClass('d-none');
                    $('#msgerror').html(res.message);
                }
                pbtn.attr('disabled', false);
            }
        });
    });

    socket.on('eventmarkprocessed', function (data) {
        //order set for processing
        if (data.eventtype == 'eventprocessorder') {
            //use if separate button is required for start processing order
            // $('.pending'+data.currentorderid).addClass('d-none');
            // $('.processing'+data.currentorderid).removeClass('d-none');
            // $('.process'+data.currentorderid).addClass('d-none');
            // $('.markprocessed'+data.currentorderid).removeClass('d-none');
            // $('.cancelorder'+data.currentorderid).removeClass('d-none');
        } else if (data.eventtype == 'eventmarkprocessed') {
            //order marked processed
            manageQueueButton(data.orderid, data.currentorderid, 'markprocessed');
        } else if (data.eventtype == 'eventcancelorder') {
            //order cancelled by admin
            manageQueueButton(data.orderid, data.currentorderid, 'cancelorder');
        }
    });

    //append order to admin panel
    socket.on('loadorder', function (data) {
        $.ajax({
            url: config.routes.refreshorderlist,
            type: "POST",
            data: {
                orderid: data.orderid,
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res.status == 1) {
                    $('#queueordertable .pending-processing').last().after(res.message);
                }
            }
        });
    });
});

function manageQueueButton(nextOrderId, currentOrderId, action) {

    // $('.process'+res.orderid).removeClass('d-none');
    $('.processing' + nextOrderId).removeClass('d-none');
    $('.pending' + nextOrderId).addClass('d-none');
    // $('.processed'+res.orderid).removeClass('d-none');
    $('.markprocessed' + nextOrderId).removeClass('d-none');
    $('.cancelorder' + nextOrderId).removeClass('d-none');

    if (action == 'markprocessed') {
        $('tr.order-row' + currentOrderId + ' td:nth-child(4)').empty();
        $('tr.order-row' + currentOrderId + ' td:first-child').removeClass('order-pending').addClass('order-processed');

        $('.processed' + currentOrderId).removeClass('d-none');
    } else if (action == 'cancelorder') {
        $('.ordercancelled' + currentOrderId).removeClass('d-none');
    }

    //append processed to back of the table and remove from top
    $('.markprocessed' + currentOrderId).remove();
    $('.cancelorder' + currentOrderId).remove();
    $('.processing' + currentOrderId).remove();


    var orderprocessed = $('.order-row' + currentOrderId);
    $('#queueordertable').append('<tr>' + orderprocessed.html() + '</tr>');
    $('.order-row' + currentOrderId).remove();
}


$(document).delegate(".edit-charge", 'click', function () {
    event.preventDefault();
    $('#chargeEditModel').modal('show');
    $('#validation-errors').html('');
    $('.cc-title').val($(this).data('title'));
    $('.cc-charge').val($(this).data('charge'));
    $('.cc-note').val($(this).data('note'));
    $('#charge_id').val($(this).data('id'));
    let close = $(this).data('status');
    $('.cc-close').attr('checked', close ? true : false);
    $('.cc-charges-type').attr('checked',  ($(this).data('charges_type') == 'percentage') ? true : false);
});

$(document).delegate(".save-charge", 'click', function () {
    event.preventDefault();
    var title = $('.cc-title').val();
    var charge = $('.cc-charge').val();
    var note = $('.cc-note').val();
    var charge_id = $('#charge_id').val();
    var charges_type = $('.cc-charges-type').is(":checked") ? 'percentage' : 'fixed';
    var status = $('.cc-close').is(":checked") ? 1 : 0;
    var pbtn = $(this);
    // Send an AJAX to Laravel
    $.ajax({
        url: pbtn.data('link'),
        type: "POST",
        data: {
            id: charge_id,
            title: title,
            charge: charge,
            note: note,
            charges_type: charges_type,
            status: status,
        },
        success: function (result) {
            if (result.code == 200) {
                $('.msgalert').html('<div class="alert alert-success" role="alert">' + result.message + '</div>');
                window.setTimeout(function () {
                    location.reload()
                }, 1000);
            } else {
                $('.msgalert').html('<div class="alert alert-warning" role="alert">' + result.message + '</div>');
            }
            pbtn.attr('disabled', false);
        },
        error: function (xhr) {
            $('#validation-errors').html('');
            $.each(xhr.responseJSON.errors, function(key,value) {
              $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
          });
         },
    });
});

$(document).delegate(".edit-time", 'click', function () {
    event.preventDefault();
    $('#timeEditModel').modal('show');
    $('.day-text').text($(this).data('day'));
    $('.otime').val($(this).data('otime'));
    $('.ctime').val($(this).data('ctime'));
    $('#time_id').val($(this).data('id'));
    let close = $(this).data('close');
    $('.is-close').attr('checked', close ? false : true);
});

$(document).delegate(".save-time", 'click', function () {
    event.preventDefault();
    var otime = $('.otime').val();
    var ctime = $('.ctime').val();
    var time_id = $('#time_id').val();
    var close = $('.is-close').is(":checked") ? 0 : 1;
    var pbtn = $(this);
    pbtn.attr('disabled', true);
    // Send an AJAX to Laravel
    $.ajax({
        url: pbtn.data('link'),
        type: "POST",
        data: {
            time_id: time_id,
            open_time: otime,
            close_time: ctime,
            close: close,
        },
        success: function (result) {
            if (result.code == 200) {
                $('.msgalert').html('<div class="alert alert-success" role="alert">' + result.message + '</div>');
                window.setTimeout(function () {
                    location.reload()
                }, 1000);
            } else {
                $('.msgalert').html('<div class="alert alert-warning" role="alert">' + result.message + '</div>');
            }
            pbtn.attr('disabled', false);
        }
    });
});


$(document).delegate(".active-branch-menu", 'click', function () {
    var menu_status = $(this).is(":checked") ? 1 : 0;
    var pbtn = $(this);
    // Send an AJAX to Laravel
    $.ajax({
        url: pbtn.data('link'),
        type: "POST",
        data: {
            menu_status: menu_status,
            menu_id: pbtn.data('menu-id'),
            branch_id: pbtn.data('user-id'),
        },
        success: function (result) {
            if (result.code == 200) {
                $('.msgalert').html('<div class="alert alert-success" role="alert">' + result.message + '</div>');
            } else {
                $('.msgalert').html('<div class="alert alert-warning" role="alert">' + result.message + '</div>');
            }
        }
    });
});

//for addons
$(document).delegate(".is-close", 'click', function () {
    var addons_status = $(this).is(":checked") ? 1 : 0;
    var pbtn = $(this);
    // Send an AJAX to Laravel
    $.ajax({
        url: pbtn.data('link'),
        type: "POST",
        data: {
            addons_status: addons_status,
            menu_id: pbtn.data('menu-id'),
            addons_id: pbtn.data('addons-id'),
        },
        success: function (result) {
            if (result.code == 200) {
                $('.msgalert').html('<div class="alert alert-success" role="alert">' + result.message + '</div>');
            } else {
                $('.msgalert').html('<div class="alert alert-warning" role="alert">' + result.message + '</div>');
            }
        }
    });
});
