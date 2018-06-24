
    var name = $('[data-type="name"] input').val(),
        email = $('[data-type="email"] input').val(),
        phone = $('[data-type="phone"] input').val();
    console.log(config, 'exit', 'form1', name, email, phone);
    redirectUser(config, 'exit', 'form1', name, email, phone);
