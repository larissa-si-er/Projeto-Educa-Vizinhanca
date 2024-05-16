// var campos = ['nome', 'nomeM', 'email','cpf','niver', 'genero', 'celular', 'telefone','cep', 'road', 'bairro', 'cidade', 'state', 'end', 'complemento', 'usuario', 'senha', 'confirmSenha']; 

//VALID-NOME
  function validarNome(valor) {
    const erroNome = document.getElementById("erroNome");
    const valorAnterior = event.target.value;
    const novoValor = valorAnterior.replace(/\d/g, '');  //remover numeros - podendo só caracter
    event.target.value = novoValor;  //atualizando o valor do campo de input com o valor filtrado

    if (valor.length < 15 || !/^[A-Z a-z]+$/.test(valor)) {
        erroNome.innerHTML = "Mínimo 15 caracteres.";
    } else {
      erroNome.innerHTML = "";
    }
  }



  
//valid - cpf
function validarCpf() {
    const erroCpf = document.getElementById("erroCpf");
    
    let cpf = document.getElementById("cpf").value.replace(".","").replace(".","").replace("-","").toString(); //obtém o valor digitado no campo 
    let aux = 0;
    let isValid = false;

    for(i = 0; i < 11; i++){
        aux += parseInt(cpf.charAt(i)); //dígito atual do CPF é obtido usando o método charAt(i)
    }
    
    if((aux == 33 || aux == 44 || aux == 55 || aux == 66) && (cpf != 33333333333 && cpf != 44444444444 && cpf != 55555555555 && cpf != 66666666666)){
        isValid = true;
        erroCpf.innerHTML =  "";
    }

    if(isValid == false || document.getElementById("cpf").value.length != 14){
      erroCpf.innerHTML = "CPF inválido";
      document.getElementById("cpf").value = "";
  }
}


// VALIDAR CNPJ
function validarCNPJ() {
  const erroCnpj = document.getElementById("erroCnpj");
  const cnpjInput = document.getElementById("cnpj");
  let cnpj = cnpjInput.value.replace(/\D/g,''); // Remove todos os caracteres que não são dígitos

  let isValid = false;

  // Verifica se o CNPJ tem 14 dígitos e se não está em uma lista de CNPJs inválidos
  if (cnpj.length === 14 && !['00000000000000', '11111111111111', '22222222222222', '33333333333333', '44444444444444', '55555555555555', '66666666666666', '77777777777777', '88888888888888', '99999999999999'].includes(cnpj)) {
      let soma = 0;
      let pos = 5;

      for (let i = 0; i < 12; i++) {
          soma += parseInt(cnpj.charAt(i)) * pos--;
          if (pos < 2) pos = 9;
      }

      let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado === parseInt(cnpj.charAt(12))) {
          soma = 0;
          pos = 6;

          for (let i = 0; i < 13; i++) {
              soma += parseInt(cnpj.charAt(i)) * pos--;
              if (pos < 2) pos = 9;
          }

          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado === parseInt(cnpj.charAt(13))) {
              isValid = true;
              erroCnpj.innerHTML = "";
          }
      }
  }

  if (!isValid) {
      erroCnpj.innerHTML = "CNPJ inválido";
      cnpjInput.value = "";
  }
}



//VALID - LOGIN
  function validarLogin(valor) {
    const erroLogin = document.getElementById("erroLogin");
    const valorAnterior = event.target.value;
    const novoValor = valorAnterior.replace(/\d/g, '');  //remover numeros - podendo só caracter
    event.target.value = novoValor;  //atualizando o valor do campo de input com o valor filtrado

    if (valor.length !== 6 || !/^[A-Za-z]+$/.test(valor)) {
        erroLogin.innerHTML = "O Login deve ter exatamente 6 caracteres ";
    } else {
      erroLogin.innerHTML = "";
    }
  }
  

//VALID - SENHA
function validarSenha(valor) {
    const erroSenha = document.getElementById("erroSenha");
    const valorAnterior = event.target.value;
    const novoValor = valorAnterior.replace(/\d/g, ''); 
    event.target.value = novoValor; 

    if (valor.length !== 8) {
        erroSenha.innerHTML = "A senha deve ter 8 caracteres.";
    } else if (campos.includes(valor)) {
      erroSenha.innerHTML = "Nome já existente.";
    } else {
        erroSenha.innerHTML = "";
    }
  }


  // VALIDAR - Confirmar senha
function comparePassword() {
    let senha = document.getElementById("senha");
    let Confirmarsenha = document.getElementById("confirmSenha");
    let erroTwoSenha = document.getElementById("erroTwoSenha");
        if (Confirmarsenha.value !== senha.value) {
            erroTwoSenha.innerHTML = "A senha e a confirmação de senha devem ser iguais."; 
        } else {
            erroTwoSenha.innerHTML = "";
        
        }
        }

// VALIDATE BUTTONS - CAMPO OBRIGATÓRIO
function validate() {
  var campos = [ 'nome', 'nomeM', 'email','cpf','niver', 'genero', 'celular', 'telefone', 'cep', 'complemento', 'usuario', 'senha', 'confirmSenha']; // Vetor contendo os IDs dos campos obrigatórios
  for (var i = 0; i < campos.length; i++) {
    var campo = document.getElementById(campos[i]);
    var errorSpan = document.getElementById(campos[i] + '_error');

    if (campo.value === '') {
      if (errorSpan) {
        errorSpan.innerHTML = 'Campo obrigatório.';
      }
    } else {
      if (errorSpan) {
        errorSpan.innerHTML = '';
      }
    }
  }
}

function validate_cadTwo() {
  var campos = [ 'nome', 'instituicao', 'email','datainstituicao','cnpj', 'celular', 'telefone', 'cep', 'complemento', 'usuario', 'senha', 'confirmSenha']; // Vetor contendo os IDs dos campos obrigatórios
  for (var i = 0; i < campos.length; i++) {
    var campo = document.getElementById(campos[i]);
    var errorSpan = document.getElementById(campos[i] + '_error');

    if (campo.value === '') {
      if (errorSpan) {
        errorSpan.innerHTML = 'Campo obrigatório.';
      }

    } else {
      if (errorSpan) {
        errorSpan.innerHTML = '';

      }

    }
  }
}


function clearError(campoId) {
  var errorSpan = document.getElementById(campoId + '_error');
  
  if (errorSpan) {
    errorSpan.innerHTML = '';
  }
}

// ALERTAS
function Alert(){
  Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Preencha todos os campos!",
      confirmButtonColor: '#a2a3a3',      
      footer: '<a href="cadastro.php">Não tem uma conta?</a>',
    });
}