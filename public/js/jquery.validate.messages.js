jQuery.extend(jQuery.validator.messages, {
    required: "Este valor es requerido.",
    remote: "Please fix this field.",
    email: "Dirección de email inválida.",
    url: "URL inválida.",
    date: "Fecha inválida.",
    dateISO: "El formato de fecha es inválido (ISO).",
    number: "Número inválido.",
    digits: "Ingresar solo caracteres.",
    creditcard: "Número de tarjeta de crédito inválido.",
    equalTo: "Debe ser el mismo valor anterior.",
    accept: "Se requiere una extensión válida.",
    maxlength: jQuery.validator.format("Se acepta un máximo de {0} caracteres."),
    minlength: jQuery.validator.format("Se requieren al menos {0} caracteres."),
    rangelength: jQuery.validator.format("Debe contener entre {0} y {1} caracteres."),
    range: jQuery.validator.format("El valor debe estar entre {0} y {1}."),
    max: jQuery.validator.format("Debe ser menor o igual a {0}."),
    min: jQuery.validator.format("Debe ser mayor o igual a {0}.")
});