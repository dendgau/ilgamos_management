$(document).ready(function() {
    $('body').on('click', '.process_payment', function() {
        if (check_ajax_running()) return true;

        var contract_id = $(this).closest('.table-contract').find('input.contract_id').val(),
            me = $(this);
        start_ajax_process(me, true);
        $.ajax({
            url: "/business/contract/ajax_change_payment_state",
            type: "POST",
            data: {
                _token     : get_csrf_token(),
                contract_id: contract_id
            },
            success: function(resp) {
                if (resp.code == 1) {
                    me.closest('.table-contract').find('.add_order').remove();
                    me.closest('.table-contract').find('.add_order_detail').remove();
                    me.closest('.table-contract').find('.remove_order_detail').remove();
                    me.closest('.table-contract').find('.column_state').html('<span style="color: green"><i class="fa fa-check" style="color: green"></i> Đã thanh toán</span>');
                    // For hard code screen update
                    me.closest('body').find('.btn_update_contract').remove();
                    // For hard code list contract
                    me.closest('table.table-contract').remove();
                    stop_ajax_process(me, false, '');
                    get_order_detail_printing(contract_id);
                } else {
                    show_dialog('error', 'Không thể cập nhật trạng thái hóa đơn.');
                    stop_ajax_process(me, true, '');
                }
            }
        });
    });

    $('body').on('click', '.add_order_detail, .remove_order_detail', function() {
        if (check_ajax_running()) return true;

        var contract_id = $(this).closest('.table-contract').find('input.contract_id').val(),
            order_detail_id = $(this).data('order_detail_id'),
            quantity = $(this).hasClass('add_order_detail') ? 1 : -1,
            me = $(this);

        start_ajax_process(me, false);
        $.ajax({
            url: "/business/order_detail/ajax_change_quantity_order_detail",
            type: "POST",
            data: {
                _token          : get_csrf_token(),
                contract_id     : contract_id,
                order_detail_id : order_detail_id,
                quantity        : quantity
            },
            success: function(resp) {

                if (resp.code == 1) {
                    var parent = me.closest('.table-contract');
                    stop_ajax_process(me, false, '');
                    parent.find('.column_table_order_detail').html(resp.data.html_order_detail);
                    parent.find('.column_total_price').html(resp.data.html_total_price);

                    if (resp.data.html_order_detail != '') {
                        parent.find('.column_table_order_detail').removeClass('hide');
                        parent.find('.process_payment').removeClass('hide');
                        parent.find('.print').removeClass('hide');
                        parent.find('.column_state').html('<span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa thanh toán</span>');
                    } else {
                        parent.find('.column_table_order_detail').addClass('hide');
                        parent.find('.process_payment').addClass('hide');
                        parent.find('.print').addClass('hide');
                        parent.find('.column_state').html('<span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa gọi món</span>');
                    }
                } else {
                    show_dialog('error', 'Không thể cập nhật số lượng món');
                    stop_ajax_process(me, true, '');
                }
            }
        });
    });

    $('body').on('click', '.add_order', function() {
        var contract_id  = $(this).closest('.table-contract').find('input.contract_id').val(),
            table_number = $(this).closest('.table-contract').find('.table-number').html();

        $('#modal_add_order .modal-header').html('<h6>Thêm món cho bàn <strong>' + table_number + '</strong> - Hóa đơn số <strong>' + 'HD00' + contract_id + '</strong></h6>');
        $('#modal_add_order input[name=modal_hidden_contract_id]').val(contract_id);
        $('#modal_add_order #menu-select2').val(-1).select2();
        $('#modal_add_order').modal({backdrop: 'static', keyboard: false});
    });

    $('#modal_add_order #menu-select2').on('select2:select', function (e) {
        var data = e.params.data;
        if (data.id == -1) return;
        if ($('table.modal_table_order_detail tbody #modal_row_order_detail_' + data.id).length > 0) return;

        var html =
            "<tr id='modal_row_order_detail_"+data.id+"'>" +
                "<td>" + data.text + "</td>" +
                "<td style='text-align: center'>x1</td>" +
                "<td style='text-align: center'><button class='btn btn-sm btn-danger modal_remove_order_detail'>Xóa</button></td>" +
            "</tr>";

        $('#modal_add_order table.modal_table_order_detail tbody').append(html);
        $('#modal_add_order table.modal_table_order_detail').show();
    });

    $('body').on('click', '#modal_add_order .modal_remove_order_detail', function() {
        $(this).closest('tr').remove();
        if ($('#modal_add_order table.modal_table_order_detail tbody tr').length == 0) {
            $('#modal_add_order table.modal_table_order_detail').hide();
        }
    });

    $('body').on('click', '#modal_add_order .modal-footer button.save', function() {
        if (check_ajax_running()) return true;

        var contract_id = $('#modal_add_order input[name=modal_hidden_contract_id]').val(),
            product_ids = [],
            me = $(this);

        $("#modal_add_order table.modal_table_order_detail tbody tr").each(function(index) {
            var product_id = $(this).attr('id');
            product_id = product_id.split("_")[4];
            product_ids.push(product_id);
        });

        if (product_ids.length <= 0) {
            $('#modal_add_order').modal('hide');
            return;
        }

        start_ajax_process(me, false);
        $.ajax({
            url: "/business/order_detail/ajax_add_order_detail",
            type: "POST",
            data: {
                _token          : get_csrf_token(),
                contract_id     : contract_id,
                product_ids     : product_ids,
                quantity        : 1
            },
            success: function(resp) {
                if (resp.code == 1) {
                    var contract_hidden = $('.table-contract input[value="'+contract_id+'"]');
                    var parent = contract_hidden.closest('.table-contract');
                    parent.find('.column_table_order_detail').html(resp.data.html_order_detail);
                    parent.find('.column_total_price').html(resp.data.html_total_price);

                    if (resp.data.html_order_detail != '') {
                        parent.find('.column_table_order_detail').removeClass('hide');
                        parent.find('.process_payment').removeClass('hide');
                        parent.find('.print').removeClass('hide');
                        parent.find('.column_state').html('<span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa thanh toán</span>');
                    } else {
                        parent.find('.column_table_order_detail').addClass('hide');
                        parent.find('.process_payment').addClass('hide');
                        parent.find('.print').addClass('hide');
                        parent.find('.column_state').html('<span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa gọi món</span>');
                    }
                } else {
                    show_dialog('error', 'Không thể cập nhật số lượng món');
                }

                $('#modal_add_order').modal('hide');
                stop_ajax_process(me, true, '');
            }
        });
    });

    $("#modal_add_order").on("hidden.bs.modal", function () {
        $("#modal_add_order #menu-select2").select2('destroy');
        $('#modal_add_order input[name=modal_hidden_contract_id]').val('');
        $('#modal_add_order table.modal_table_order_detail tbody').html("");
        $('#modal_add_order table.modal_table_order_detail').hide();
    });

    $('body').on('click', '#modal_print_agree', function(){
        $("#modal_print").modal('hide');
        $("#modal_print_sector").print();
    });
});