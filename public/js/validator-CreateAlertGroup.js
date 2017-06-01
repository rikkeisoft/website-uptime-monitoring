$("#form-create").validate({
    rules: {
        name: {
            required: true,
            minlength: 3,
            maxlength:100,
        }
    }
})