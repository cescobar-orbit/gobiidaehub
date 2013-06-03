jQuery.extend(jQuery.validator.messages, {
    required: "This value is required.",
    remote: "Please fix this field.",
    email: "Email is invalid.",
    url: "Invalid URL.",
    date: "Invalid date.",
    dateISO: "The date format is invalid (ISO).",
    number: "Invalid number.",
    digits: "Enter only digits.",
    creditcard: "Invalid credit card.",
    equalTo: "Must be the same previous value.",
    accept: "A valid extension is required.",
    maxlength: jQuery.validator.format("Accept a maximum of {0} characters."),
    minlength: jQuery.validator.format("Requires at least {0} characters."),
    rangelength: jQuery.validator.format("Must contain between {0} y {1} characters."),
    range: jQuery.validator.format("The value must be between {0} y {1}."),
    max: jQuery.validator.format("Must be less or equal to {0}."),
    min: jQuery.validator.format("Must be great or equal to {0}.")
});