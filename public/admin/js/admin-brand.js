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
                            alert('Block fail');
                        } else {
                            alert('Block success');
                            window.location.reload(true);
                        }
                    }
                });
            }
        }
    });

    $('.js-btn-search-brand').on('click', function () {
        var keyword = $('.js-input-keyword-brand').val().trim();
        if (keyword.length >= 3) {
            window.location.href = urlSearch + '?keyword=' + keyword;
        }
    });

    // dành riêng cho việc nhấn enter
    $('.js-input-keyword-brand').on('keyup', function (e) {
        //e.preventDefault();
        var self = $(this);
        if(e.keyCode == 13){
            var keyword = self.val().trim();
            if (keyword.length >= 3) {
                window.location.href = urlSearch + '?keyword=' + keyword;
            }
        }
        return false;
    });

});
