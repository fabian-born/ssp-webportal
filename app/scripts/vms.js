$('.delete-button').on('click', function (e) {
    var id = $(this).attr('data-id');
    $('.confirm-delete').attr('data-id',id);

    });
$(".confirm-delete").on('click', function (e) {
        var id = $(this).attr('data-id');
        console.log(id);
        location.href="/content/vms_overview.php?id="+id;
    });