$(document).ready(function(){
   /* $('#modal-toggle').click(function(e){
        e.preventDefault();
        $("#modal-places").toggle('slide');
    });

    $('.modal-form-places').click(function(e)
    {
        e.preventDefault();
        $(this).toggleClass('bg-success');
        var val = $(this).text();

        if(val === 'Afficher les détails')
        {
            $(this).text('Masquer les détails');
        } 
        else 
        {
            $(this).text('Afficher les détails');
        }

        $(this).parent().parent().find('.form-places').toggle('slide');
    });*/

    /*$('.modal-all-places-toggle').click(function(e){
        e.preventDefault();
        $(this).toggleClass('bg-success');
        $(this).parent().parent().find('.modal-all-places').toggle('slide');
        var val = $(this).text();

        if(val === 'Afficher les détails')
        {
            $(this).text('Masquer les détails');
        } 
        else 
        {
            $(this).text('Afficher les détails');
        }
    });*/

    $('.toggle-delete-event').click(function(e){
        e.preventDefault();
        $(this).parent().find('.toggle-delete-confirmation').toggle('slide');
    });
  });
