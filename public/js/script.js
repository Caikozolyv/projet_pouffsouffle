// // $(document).ready(function () {
var $ville = $('#sortie_ville');
var lieu = $('#sortie_lieu');
//
//     $ville.change(function () {
//         var $form = $(this).closest('form');
//         var data = {};
//         data[$ville.attr('name')] = $ville.val();
//         $.ajax({
//             url: '/ajax/selectVille',
//             // data: {'idVille': ville},
//             // type: 'GET',
//             // dataType: 'json',
//             // url: $form.attr('action'),
//             type: $form.attr('method'),
//             data: data,
//             success: function (html) {
//                 lieu.prop('disabled', false);
//                 lieu.replaceWith(
//                     $(html).find('#sortie_lieu')
//                 );
//             }
//             // success: function (json) {
//             //     $('#sortie_lieu').prop('disabled', false);
//             //     $('#sortie_lieu').html('');
//             //     $.each(json, function (index, value) {
//             //         $('#sortie_lieu').append('<option value"' + value.id +'">' + value.nom + '</option>');
//             //     })
//             // }
//         });
//     });
// // });
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