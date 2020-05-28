var $ville = $('#sortie_ville');
var lieu = $('#sortie_lieu');
$ville.change(function () {
    var villeId = $(this).val();
    $.ajax({
       url: '/ajax/selectVille',
        type: "GET",
        dataType: "JSON",
        data: {
           villeId: villeId
        },
        success: function (lieux) {
            lieu.prop('disabled', false);
            lieu.html('');
            // lieu.append('<option value="Selectionner un lieu"' + $ville.find("option:selected").text() +  '</option>');
            $.each(lieux, function (key, value) {
                lieu.append('<option value="' + value.id + '">' + value.name + '</option>')
            });
        }
    });
});