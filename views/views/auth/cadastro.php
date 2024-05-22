<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/home-ic.png">
    <title>Cadastro</title>
    <script src="../js/format.js"></script>
    <script src="../js/campos.js"></script>
    <script src="../js/cadastro.js"></script>
    <link rel="stylesheet" href="../css/cadastro.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>
<body>
    <div class="menu">
        <div class="menu-bar">
            <a href="../auth/login.php"><i class="bi bi-box-arrow-left"></i></a>
            <img src="../img/Home.png" alt="" srcset="">
        </div>
    </div>

    <div class="container">
        <div class="form-image">
            <img src="../img/undraw_My_password_re_ydq7 (1).png" alt="">
        </div>

        <div class="box">
            <form class="form" action="">
                    <div class="legenda">
                    <legend>Cadastre-se</legend>
                    </div>
                    <br>
        
                    <select id="tipoCadastro" class="selectInput" onchange="redirecionarCadastro()">
                        <option value="" hidden>Qual o seu tipo de cadastro? </option>
                        <option value="normal">Sou Aluno</option>
                        <option value="admin">Sou uma Instituição</option>
                    </select>

                    <br>
                    <br>
                    <br>

                    <div class="sub-title-form"> <p>Informações pessoais</p></div>

                    <div class="inputbox w50">
                        <label for="nome">Nome Completo: *</label>
                        <input type="text" name="nome" id="nome" maxlength="80" placeholder="Digite seu nome" required class="inputUser" oninput="clearError('nome')" onkeyup="validarNome(this.value)">
                        <span id="nome_error" class="error"></span>
                        <small class="small-required" id="erroNome"></small>
                    </div>


                    <div class="inputbox">
                        <label for="nomeM">Nome Materno: *</label>
                        <input type="text" name="nomeM" id="nomeM" maxlength="60"  required class="inputUser" oninput="clearError('nomeM')">
                        <span id="nomeM_error" class="error"></span> 
                    </div>


                    <div class="inputbox ww">
                        <label for="email">Email: *</label>
                        <input type="email" name="email" id="email" maxlength="60" placeholder="Example@.com" required class="inputUser" oninput="clearError('email')">
                        <span id="email_error" class="error"></span> 
                    </div>
            

                    <div class="inputbox">
                        <label for="cpf"> CPF: *</label>
                        <input type="text" id="cpf" placeholder="000.000.000-00" required maxlength="11" inputmode="numeric" required class="inputUser" onblur="validarCpf()" oninput="clearError('cpf')" onkeyup="CadastrarCpf()">
                        <span id="cpf_error" class="error"></span>
                        <small class="small-required" id="erroCpf"></small>
                    </div>
                    <br>
                    <div class="inputbox">
                        <label for="niver" style="background-color: transparent;">Data de Nascimento: *</label>
                        <input type="date" id="niver" placeholder="" required class="inputUser" oninput="clearError('niver')" />
                        <span id="niver_error" class="error"></span>
                    </div>
                    <br>
                    <div class="inputbox">
                        <label>Informe seu Gênero: </label>
                        <select id="genero" class="selectInput sel2" oninput="clearError('genero')" required>
                            <option value="" hidden>Escolha seu Gênero</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outros</option>
                        </select>
                        <span id="genero_error" class="error"></span> 
                    </div>
                    <br>
                    <div class="inputbox w30">
                        <label for="celular">Celular: *</label>
                        <input type="text" id="celular" placeholder="(+55)XX-XXXXXXXX" pattern="\(\+\d{2}\)\d{2}-\d{8}" required inputmode="numeric"  oninput="formatarTel(), clearError('celular')" maxlength="14" class="inputUser" />
                        <span id="celular_error" class="error"></span>
                    </div>

                    <div class="inputbox">
                        <label for="telefone">Telefone: *</label>
                        <input type="text" id="telefone" placeholder="(+55)XX-XXXXXXXX" pattern="\(\+\d{2}\)\d{2}-\d{8}" required inputmode="numeric"   maxlength="13" class="inputUser" oninput="formatarTel(),clearError('telefone')"/>
                        <span id="telefone_error" class="error"></span>
                    </div>
                    <br>

                    <!-- endereço [inicio] -->

                    <div class="sub-title-form"> <p>Informações de endereço</p></div>

                    <div class="inputbox">
                        <label for="cep">CEP: *</label>
                        <input type="text" id="cep" required maxlength="8" inputmode="numeric" oninput=" clearError('cep'),formatarCEP()" onkeyup="ProcuraCEP()" class="inputUser"/>
                        <span id="cep_error" class="error"></span>

                    </div>

                    <div class="inputbox w30">
                        <label for="cidade">Cidade: *</label>
                        <input type="text"  id="cidade" required>
                    </div>

                    <div class="inputbox">
                        <label for="state">Estado: *</label>
                        <input type="text"  id="state" required>
                    </div>

                    <div class="inputbox">
                        <label for="end" >Logradouro: *</label>
                        <input type="text" id="end" placeholder="Rua" class="inputUser"  />
                    </div>

                    <div class="inputbox w30">
                        <label for="bairro" >Bairro: *</label>
                        <input type="text" id="bairro" class="inputUser"/>
                    </div>

                    <div class="inputbox">
                        <label for="complemento">Número: *</label>
                        <input type="text" id="complemento" placeholder="nº" required class="inputUser" oninput="clearError('complemento')"/>
                        <span id="complemento_error" class="error"></span>
                    </div>
                    <br>
                    <!-- endereço [fim] -->

                    <div class="inputbox">
                        <label id="labelUsuario" for="usuario">Usuário: *</label>
                        <input type="text" id="usuario" maxlength="6"  required class="inputUser" oninput="clearError('usuario')" onkeyup="validarLogin(this.value)"/>
                        <span id="usuario_error" class="error"></span>
                        <small class="small-required" id="erroLogin"></small>
                    </div>
    
                    <div class="inputbox w20">
                        <label for="senha">Senha: *</label>
                        <input type="password" id="senha" maxlength="8"  required class="inputUser" oninput="clearError('senha')" onkeyup="validarSenha(this.value)"/>
                        <i class="bi bi-eye" id="btsenha"  onclick="mostrarSenha()"></i>
                        <span id="senha_error" class="error"></span> 
                        <small class="small-required" id="erroSenha"></small>
                    </div>
                    
                    <div class="inputbox">
                        <label id="labelConfirmSenha" for="confirmSenha"
                        >Confirmar Senha: *</label>
                        <input type="password" id="confirmSenha" maxlength="8" required class="inputUser" oninput="clearError('confirmSenha')" onkeyup="comparePassword()"/>
                        <i class="bi bi-eye" id="btsenhaTwo" onclick="mostrarSenhaB()"></i>
                        <span id="confirmSenha_error" class="error"></span> 
                        <small class="small-required" id="erroTwoSenha"></small> 
                    </div>

         <!-- ALTERAÇAO 25-04 -->

                    <div class="captcha-container">
                        <h2 class="title-captcha">Marque a caixa abaixo se você não é um robô:</h2>
                        <div id="captcha" class="captcha">
                            <div class="content-captcha">
                                <div class="block-chk">
                                    <div class="checkbox-wrapper-46">
                                        <input type="checkbox" id="cbx-46" class="inp-cbx" />
                                        <label for="cbx-46" class="cbx"
                                        ><span>
                                            <svg viewBox="0 0 12 10" height="10px" width="12px">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline></svg></span
                                        ><span>Não sou um robô</span>
                                        </label>
                                    </div>

                                    <img class="img-captcha" src="../img/foto-captcha.png" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>

         <!-- ALTERAÇAO 25-04 -->

                    <div class="buttons">
                        <button onclick="validate()">
                            <span class="shadow"></span>
                            <span class="edge"></span>
                            <span class="front text"> Entrar
                            </span>
                        </button>
                        <button onclick="javascript:document.location.reload()">
                            <span class="shadow"></span>
                            <span class="edge"></span>
                            <span class="front text"> Limpar
                            </span>
                        </button>
                    </div>
            </form>
        </div> 
    </div>  
</body>
</html>