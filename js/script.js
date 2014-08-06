jQuery(document).ready(function($){

    //Crédito field money mask
    $( '#consorcio_credito, .consorcio_money_field input' ).mask('000.000.000,00', {reverse: true});

    //Adds R$ before value of Crédito field
    $( '#consorcio_credito' ).parent().prepend( '<span>R$ </span>' );

    
    $(".rwmb-checkbox-list").each(function(index, val) {
     
        // INITIATE HIDDEN
        if( $(this).is(':checked') ){
            $("#wp-"+$(this).val()+"-wrap").parent().parent().show(0);
        }else{
            $("#wp-"+$(this).val()+"-wrap").parent().parent().hide(0);
        }
        
        // CLICK
        $(this).on('change', function(event) {
            console.log("#wp-"+$(this).val()+"-wrap");
            $("#wp-"+$(this).val()+"-wrap").parent().parent().slideToggle(300);
        });
    }); 
    
});
