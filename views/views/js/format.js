// -----------------------------SENHA E MOSTRAR SENHA

function mostrarSenha() {
    var senhaInput = document.getElementById('senha')
    var btnShow = document.getElementById('btsenha')

    if (senhaInput.type === 'password'){
      senhaInput.setAttribute('type', 'text')
      btnShow.classList.replace('bi-eye', 'bi-eye-slash') 
    }
    else   {
      senhaInput.setAttribute('type', 'password')
      btnShow.classList.replace('bi-eye-slash', 'bi-eye')
      
    }
}


function mostrarSenhaB() {
    var tsenhaInput = document.getElementById('confirmSenha')
    var btnShow = document.getElementById('btsenhaTwo')

    if (tsenhaInput.type === 'password'){
      tsenhaInput.setAttribute('type', 'text')
      btnShow.classList.replace('bi-eye', 'bi-eye-slash') 
    }
    else   {
      tsenhaInput.setAttribute('type', 'password')
      btnShow.classList.replace('bi-eye-slash', 'bi-eye')
      
    }
}

// ----------------------------FORMAT - cpf
function CadastrarCpf() {
    let cpf = event.target.value;
    cpf = cpf.replace(/\D/g, ''); // Tira caracteres não numéricos

    if (cpf.length > 11) {
      cpf = cpf.slice(0, 11); // Limita a 11 dígitos
    }

    cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); 

    event.target.value = cpf; 
  }

// ----------------------------FORMAT - cnpj
function formatCnpj(event) {
  let cnpj = event.target.value;
  cnpj = cnpj.replace(/\D/g, ''); 

  cnpj = cnpj.slice(0, 14); 

  cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5'); 

  event.target.value = cnpj; 
}


// -------------------------------tel
function formatarTel() {
    const celularInput = document.getElementById('celular');
    const telefoneInput = document.getElementById('telefone');

    let cel = celularInput.value;
    let tel = telefoneInput.value;
    cel = cel.replace(/\D/g, ''); 
    tel = tel.replace(/\D/g, '');

    cel = cel.replace(/^(\d{2})(\d{2})(\d{5})(\d{4})$/, '(+$1)$2-$3$4');  
    tel = tel.replace(/(\d{2})(\d{2})(\d{4,5})(\d{4})$/, '(+$1)$2-$3$4');
  

    celularInput.value = cel;
    telefoneInput.value = tel;

}

// ------------------------------CEP- format

function ProcuraCEP() {
    const cepInput = document.getElementById('cep');
    cepInput.addEventListener('input', formatarCEP);
  

  function formatarCEP() {
      cepInput.value = cepInput.value
        .replace(/\D/g, '') 
        .replace(/(\d{5})(\d{3})/, '$1-$2'); // Adiciona o hífen após os primeiros 5 dígitos
    }
  var cep = document.getElementById("cep").value.replace("-","");
  if(cep !== ''){
      let url = 'https://brasilapi.com.br/api/cep/v1/' + cep;
      let req = new XMLHttpRequest();
      req.open("GET", url);
      req.send();

      req.onload = function() {
          if(req.status === 200) {
              let endereco = JSON.parse(req.response)
              document.getElementById('end').value = endereco.street
              document.getElementById('bairro').value = endereco.neighborhood
              document.getElementById('cidade').value = endereco.city
              document.getElementById('state').value = endereco.state
          }
          else if(req.status === 404){
              let errocep = document.getElementById('errocep')
              errocep.style.display = "block";
              setTimeout(function() {
                  errocep.style.display = "none";
              }, 3000);
              document.getElementById("cep").value = '';
          }
      }   
  }
}



