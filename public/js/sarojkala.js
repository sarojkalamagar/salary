$(document).on('click', '.closeParent', function(){
    $(this).parent('*').remove();
});

$(document).ready(function(){
    $('.pull-right').parent().css('overflow', 'hidden');
    $('.pull-left').parent().css('overflow', 'hidden');
});

$(document).on('click', '.toggle-btn', function(){
    var targetClass = $(this).data('target-class');

    $('.' + targetClass).toggle();
});