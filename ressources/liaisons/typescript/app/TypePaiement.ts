export class TypePaiement {

    constructor() {
        $('input[type=radio]').change(function() {
            if($(this).val() == "credit"){
                $('#creditInfo').removeClass('invisible__Facturation');
            }
            else if($(this).val() == "paypal"){
                $('#creditInfo').addClass('invisible__Facturation');
            }
        });
    }
}