	// Check javascript has loaded
$(document).ready(function(){

  // Click event of the showPassword button
  $('#showPassword').on('click', function(){
    
    // Get the password field
    var passwordField = $('#inputPassword');

    // Get the current type of the password field will be password or text
    var passwordFieldType = passwordField.attr('type');

    // Check to see if the type is a password field
    if(passwordFieldType == 'password'){
        // Change the password field to text
        passwordField.attr('type', 'text');
        $(this).val('Ocultar Contraseña');
    }else{
        // If the password field type is not a password field then set it to password
        passwordField.attr('type', 'password');
        $(this).val('Mostrar Contraseña');
    }
  });
});