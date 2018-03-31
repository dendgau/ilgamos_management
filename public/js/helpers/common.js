var is_running_ajax = false;

function check_ajax_running() {
    return is_running_ajax;
}

function start_ajax_process(elem, is_show_loading_text) {
    // Add loading icon
    var loading_element = is_show_loading_text ? '<span class="loadding"><i class="fa fa-refresh fa-spin" style="font-size:16px"></i> Đang xử lý</span>' : '<span class="loadding"><i class="fa fa-refresh fa-spin" style="font-size:16px"></i></span>';

    elem.after(loading_element);
    elem.hide();

    is_running_ajax = true;
}

function stop_ajax_process(element, is_keep_element, html) {
    // Remove loading icon
    element.parent().children('.loadding').remove();

    if (is_keep_element) {
        element.show();
    } else if (html) {
        element.parent().html(html);
    } else {
        element.parent().remove();
    }

    is_running_ajax = false;
}

function show_dialog(type, content) {
    switch (type) {
        case 'error':
            var title = '<h4 class="modal-title" id="mySmallModalLabel"><i class="fa fa-warning" style="color:red"></i> Lỗi</h4>';
            $('#notification .modal-header').html(title);
            $('#notification .modal-body').html(content);
            break;
        case 'success':
            var title = '<h4 class="modal-title" id="mySmallModalLabel">Thông báo</h4>';
            $('#notification .modal-header').html(title);
            $('#notification .modal-body').html(content);
            break;
    }

    $('#notification').modal();
}

function get_order_detail_printing(contract_id) {
    if (contract_id == "") {
        show_dialog('error', 'Không thể in hóa đơn lúc này')
        return;
    }

    $.ajax({
        url: "/business/contract/ajax_get_order_detail_printing",
        type: "POST",
        data: {
            _token     : get_csrf_token(),
            contract_id: contract_id
        },
        success: function(resp) {
            if (resp.code == 1) {
                $('#modal_print').modal('show');
            } else {
                show_dialog('error', 'Không thể cập nhật trạng thái hóa đơn.');
            }
        }
    });
}
