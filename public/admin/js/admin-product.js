$(document).ready(function(){
    $('.js-select-brand').select2();
    $('.js-select-category').select2();

    $('.js-select-size').select2({
        maximumSelectionLength: 5
    });
    $('.js-select-color').select2({
        maximumSelectionLength: 5
    });
    $('.js-select-tag').select2({
        maximumSelectionLength: 10
    });
});
