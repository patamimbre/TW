function validaCCC(val){
    var banco = val.substring(0,4);
    var sucursal = val.substring(4,8);
    var dc = val.substring(8,10);
    var cuenta=val.substring(10,20);
    var CCC = banco+sucursal+dc+cuenta;
    if (!/^[0-9]{20}$/.test(banco+sucursal+dc+cuenta)){
        return false;
    }
    else
    {
        valores = new Array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
        control = 0;
        for (i=0; i<=9; i++)
        control += parseInt(cuenta.charAt(i)) * valores[i];
        control = 11 - (control % 11);
        if (control == 11) control = 0;
        else if (control == 10) control = 1;
        if(control!=parseInt(dc.charAt(1))) {
            return false;
        }
        control=0;
        var zbs="00"+banco+sucursal;
        for (i=0; i<=9; i++)
            control += parseInt(zbs.charAt(i)) * valores[i];
        control = 11 - (control % 11);
        if (control == 11) control = 0;
            else if (control == 10) control = 1;
        if(control!=parseInt(dc.charAt(0))) {
            return false;
        }
        return true;
    }
}

function checkForm() {

    correcto = true;
    
    nombre = $('input[name="nombre"]').val()
    if ( nombre == "" ) {
        $('#nombreErr').show();
        correcto = false
    } else {
        $('#nombreErr').hide();
    }
    
    apellidos = $('input[name="apellidos"]').val()
    if ( apellidos == "" ) {
        $('#apellidosErr').show();
        correcto = false
    } else {
        $('#apellidosErr').hide();
    }

    direccion = $('input[name="direccion"]').val()
    if ( direccion == "" ) {
        $('#direccionErr').show();
        correcto = false
    } else {
        $('#direccionErr').hide();
    }

    nacimiento = $('input[name="nacimiento"]').val()
    if ( nacimiento == "" ) {
        $('#nacimientoErr').show();
        correcto = false
    } else {
        $('#nacimientoErr').hide();
    }

    telefono = $('input[name="telefono"]').val()
    if ( !/^[0-9]{9}$/.test(telefono)) {
        $('#telefonoErr').show();
        correcto = false
    } else {
        $('#telefonoErr').hide();
    }

    //regex automático
    email = $('input[name="email"]').val()
    if ( email == "" ) {
        $('#emailErr').show();
        correcto = false
    } else {
        $('#emailErr').hide();
    }

    if ( $('input[name="modo_pago"]:checked').val() == "tarjeta" ){
        
        var numero_tarjeta = $('input[name="numero_tarjeta"]').val()
        if ( !/^[0-9]{16}$/.test(numero_tarjeta) ) {
            $('#numero_tarjetaErr').show();
            correcto = false
        } else {
        $('#numero_tarjetaErr').hide();
        }

        var fecha_tarjeta = $('input[name="fecha_tarjeta"]').val();
        if ( !/^[0-9]{2}\/[0-9]{4}$/.test(fecha_tarjeta) ) {
            $('#fecha_tarjetaErr').show();
            correcto = false
        } else {
        $('#fecha_tarjetaErr').hide();
        }

        cvc = $('input[name="cvc"]').val()
        if ( !/^[0-9]{3}$/.test(cvc) ) {
            $('#cvcErr').show();
            correcto = false
        } else {
        $('#cvcErr').hide();
        }

    } else {
        $('#numero_tarjetaErr').hide();
        $('#fecha_tarjetaErr').hide();
        $('#cvcErr').hide();
    }

    if (!correcto){
        window.scrollTo(0,0);
    }

    console.log(correcto);

    return false;


}