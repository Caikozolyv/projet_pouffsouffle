var $ville = $('#sortie_ville');
var lieu = $('#sortie_lieu');
var rue = $('#sortie_rue');
var latitude = $('#sortie_latitude');
var longitude = $('#sortie_longitude');
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
        },
        error:function (xhr,ajaxOptions, thrownError) {
        alert(xhr.responseText);
        alert(thrownError);
        }
    });
});

lieu.change(function () {
    var lieuId = $(this).val();
    $.ajax({
        url: '/ajax/selectLieu',
        type: "GET",
        dataType: "JSON",
        data: {
            lieuId: lieuId
        },
        success: function (lieuSelected) {
            $.each(lieuSelected, function (key, value) {
                rue.val(value.rue);
                latitude.val(value.latitude);
                longitude.val(value.longitude);
            });
            ;
        }
    })
});