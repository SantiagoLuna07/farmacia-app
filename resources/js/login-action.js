function sign(type) {
  var email = document.getElementById('email');
  var password = document.getElementById('password');

  if(valFieldsIn(email, password)) {
    document.getElementById('type').value = type;
    return true;
  } else {
    return false;
  }
}

function valFieldsIn(email, password) {
  let res = true;

  if (email.value === '') {
    email.className = 'form-control is-invalid';
    res = false;
  } else {
    email.className = 'form-control is-valid';
  }

  if (password.value === '') {
    password.className = 'form-control is-invalid';
    res = false;
  } else {
    password.className = 'form-control is-valid';
  }

  return res;
}
