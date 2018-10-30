$(document).ready(function(){

    $("#payment-modal").click(function(e){
    	e.preventDefault();
        $('.modal').toggleClass('is-active');
    });

    $('.modal-close').click(function(e){
		e.preventDefault();
        $('.modal').toggleClass('is-active');
    });

    $('.modal-background').click(function(e){
		e.preventDefault();
        $('.modal').toggleClass('is-active');
    });

    $('#com-event').change(function (e) { 
        e.preventDefault();
        getTableHeader($('#table-head'), $(this));
        var data = {
            'bool' : $('#role').val(),
            'event' : $(this).val()
        }
        if($(this).val() === "0"){
            all(data);
        } else {
            details(data);
        }
        
    });

    function getTableHeader(header, select){
        var role = $('#role').val();
        if(role === 'fest' || role === 'adm'){
            var col = 'Commerçant';
        } else if(role === 'com'){
            var col = 'Festivallier';
        }
        if(header.data('role') === 0 && select.val() !== "0"){
            header.fadeOut().promise().done(function(){
                let head = "<tr>\
                     <th scope=col>#</th>\
                     <th scope=col>Evenement</th>\
                     <th scope=col>"+col+"</th>\
                     <th scope=col>Montant</th>\
                     <th scope=col>Date</th>";

                if(role === 'adm'){
                    head += "<th scope=col>Commissioner</th>";
                }
                head += "</tr>";
                header.text('');
                header.append(head);
                header.data('role',1);
                header.fadeIn();
            });
        } else if(header.data('role') !== 0 && select.val() === "0"){
            header.fadeOut().promise().done(function(){
                let head = "<tr>\
                    <th scope=col>#</th>\
                    <th scope=col>Evenement</th>\
                    <th scope=col>Montant</th>\
                    </tr>";
                header.text('');
                header.append(head);
                header.data('role',0);
                header.fadeIn();
            });
        }
    }

    function details(data){
        $.post("/ajax/table", data,
            function (data, textStatus, jqXHR) {
                console.log(data);
                $('#table-event').fadeOut().promise().done(function(){
                    $('#table-event').text('');
                    $.each(data, function (index, value) {
                        let i=index+1;
                        console.log(data);
                        if(value.company_name !== null){
                            var name = value.company_name;
                        } else {
                            var name = value.firstname+" "+value.lastname;
                        }
                        var role = $('#role').val();
                        if(role === 'fest'){
                            var html = "<tr class='fest-details' data-value="+value.id_trans+">";
                        } else if(role === 'adm'){
                            var html = "<tr class='adm-details' data-place="+value.place_id+" data-com="+value.id_com+">";
                        } else {
                            var html = "<tr>";
                        }
                        html += "<th scope=row>"+i+"</th>\
                        <td>"+value.title+" - "+ value.place +"</td>\
                        <td>"+name+"</td>\
                        <td>"+value.amount+"€</td>\
                        <td>"+value.created_at+"</td>";
                        if(role === 'adm'){
                            if(value.checked === '1'){
                                html += "<td class='text-center font-weight-bold'><label class='align-middle' for=checkbox-com>Commissioné</label><input class='ml-2 checkbox-com' type=checkbox onclick='return false;' checked></td>"
                            } else {
                                html += "<td class='text-center font-weight-bold'>\
                                            <label class='align-middle' for=checkbox-com>Commissioné</label>\
                                            <input class='ml-2 checkbox-com input-index"+i+"' value="+i+" type=checkbox>\
                                        </td>"
                            }
                        }
                        html += "</tr>";
                        $('#table-event').append(html).fadeIn();
                    });
                });
            },
        );
    }

    function all(data){
        $.post("/ajax/table/all", data,
            function (data, textStatus, jqXHR) {
                $('#table-event').fadeOut().promise().done(function(){
                    $('#table-event').text('');
                    $.each(data, function (index, value) {
                        let i=index+1;
                        var html = "<tr>\
                        <th scope=row>"+i+"</th>\
                        <td>"+value.title+" - "+value.place+"</td>\
                        <td>"+value.amount+"€</td>";
                        $('#table-event').append(html).fadeIn();
                    });
                });
            },
        );
    }

    $(document).on('click', '.fest-details', function(e){
        var id = $(this).data('value');
        data = {
            'trans_id' : id
        }
        $.post("/ajax/table/details", data,
            function (data, textStatus, jqXHR) {
                console.log(data);
                $('#table-details').text('');
                $.each(data, function(index, value){
                    if(value.products_name !== null){
                        var name = value.products_name
                    } else {
                        var name = value.name
                    }
                    var html = "<tr>\
                        <th scope=row>"+name+"</th>\
                        <td>"+value.qty+"</td>\
                        <td>"+value.price+"€</td>\
                        <td>"+(value.price * value.qty)+"€</td>";
                        $('#table-details').append(html);
                });
                $('#saleModal').modal('toggle');
            }
        );
    });

    $(document).on('change', '.checkbox-com', function(e){
        e.preventDefault();
        if($('#checkbox-com-dropdown').is(':hidden')){
            var data = "<input id=place_id type=hidden value="+$(this).parent().parent().data('place')+">\
                        <input id=com_id type=hidden value="+$(this).parent().parent().data('com')+">\
                        <input id=input-index type=hidden value="+$(this).val()+">";

            $('#data-check').append(data);
        } else {
            $(this).prop('checked', false);
        }
        $('#checkbox-com-dropdown').show('bounce', 500);
    });

    $(document).on('click', '#checkbox-com-no', function(e){
        e.preventDefault();
        var inputClass = ".input-index"+$('#input-index').val();
        $(inputClass).prop('checked', false);
        $("#data-check").text('');
        $('#checkbox-com-dropdown').fadeOut(500);
    });

    $(document).on('click', '#checkbox-com-yes', function(e){
        e.preventDefault();
        var id_place = $('#place_id').val();
        var id_com = $('#com_id').val();
        var inputClass = ".input-index"+$('#input-index').val();

        var data = {
            'id_place' : id_place,
            'id_com' : id_com
        }

        $.post("/ajax/check", data ,
            function (data, textStatus, jqXHR) {
                if(data === true){
                    $(inputClass).attr('onclick', 'return false');
                }
            },
            
        );

        $("#data-check").text('');
        $('#checkbox-com-dropdown').fadeOut(500);
    })
});
