
    $(document).ready(function(){
        
        $('#cinema').change(function(){
            var idCinema = $('#cinema').val();
            $.ajax({
            url: URL+'/filme/<?=$filme['ID_FILME']?>/sessoes/cinema/'+idCinema,
            // url: URL+'/cinemas/'+idCinema+'/salas',
            type: 'get',
            beforeSend:function(){

            },
            success:function(data){
                console.log(data);
                console.log(data[0].TITULO);
                for (let i = 0; i < data.length; i++) {
                    var sala = data[index].SALA;
                    var data = data[index].DATA;
                    var hora = data[index].HORA;
                    var preco = data[index].PRECO;
                    var lugares = data[index].LUGARES_DISPONIVEIS;
                    $('#sessoes')    
                    
                }         
                $('#sessoes').html(data);
            },
            error:function(data){
           //     alert("ERRO AO BUSCAR RUAS");
            }
        });
        
       
        });

        $('.close-modal').click(function(){
            $('.mod').fadeOut('1')
        });

        $('.modal-trigger').click(function(){
            $('.mod').fadeIn('1')
        });
    });