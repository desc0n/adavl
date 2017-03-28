$(document).ready(function() {
    $('#street').typeahead({
        source: function (query, process) {
            return $.get('/ajax/find_street', {query: query}, function (data) {
                var json = JSON.parse(data); // string to json

                return process(json);
            });
        }
    });
});

function redactPortfolioItemImg(id, src)
{
    $('#redactImgModal .modal-body')
        .html('')
        .append('<img src="/public/img/thumb/' + src + '" data-id="' + id + '">')
    ;

    $('#redactImgModal').modal('toggle');
}

function removePortfolioItemImg()
{
    var id = $('#redactImgModal .modal-body img').data('id');

    $.ajax({url: '/ajax/remove_portfolio_item_img', type: 'POST', data: {id: id}, async: true})
        .done(function () {
            $('#redactImgModal').modal('toggle');
            $('#portfolioItemImg' + id).remove();
        });
}

function removePortfolioItem(id)
{
    $.ajax({url: '/ajax/remove_portfolio_item', type: 'POST', data: {id: id}, async: true})
        .done(function () {
            $('#portfolioItemRow' + id).remove();
        });
}
function removeContact(id)
{
    $.ajax({url: '/ajax/remove_contact', type: 'POST', data: {id: id}, async: true})
        .done(function () {
            $('#contactRow' + id).remove();
        });
}