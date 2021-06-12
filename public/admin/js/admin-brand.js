$(function () {
    $('.js-delete-brand').on('click', function () {
        var self = $(this); // Truy cập vào phần tử đang được click
        if (confirm('Bạn có chắc xoá ?')) {
            var idBrand = self.attr('id');
            var statusBrand = self.data('status');

            if ($.isNumeric(idBrand) && $.isNumeric(statusBrand)) {
                $.ajax({
                    url: urlBrand,
                    type: "POST",
                    data: {
                        idBrand: idBrand,
                        statusBrand: statusBrand
                    },
                    beforeSend: function () {
                        self.text('Loading...');
                    },
                    success: function (result) {
                        //self.text('Delete');
                        if (statusBrand === 0) {
                            self.text('block');
                        } else if (statusBrand === 1) {
                            self.text('Unblock');
                        }

                        var result = $.trim(result);
                        if (result === 'error' || result === 'fail') {
                            alert('delete fail');
                        } else {
                            alert('delete success');
                            window.location.reload(true);
                        }
                    }
                });
            }
        }
    });
});
