<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_curriculos.php");
include_once ("includes/usuario_logado.php");

include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1><i class="fas fa-user"></i> Dados Pessoais</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-7">
        <form method="post" action="funcoes/dados.php?funcao=dados&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Atualize seus dados pessoais</legend>
            
            <h2>Dados</h2>
            
            <div class="form-group">
            	<label for="inputNome" class="col-sm-3 control-label">Nome Completo</label>
                <div class="col-sm-9">
                	<input type="text" name="nome" class="form-control" id="inputNome" value="<?php echo $usuarioNome; ?>" required autofocus>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
                <div class="col-sm-9">
                	<input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo $usuarioEmail; ?>" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDataNasc" class="col-sm-3 control-label">Data de Nascimento</label>
                <div class="col-sm-3">
                	<input type="text" name="data_nasc" class="form-control" id="inputDataNasc" value="<?php echo $usuarioDataNasc; ?>" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectSexo" class="col-sm-3 control-label">Sexo</label>
                <div class="col-sm-3">
                	<select name="sexo" class="form-control" id="selectSexo" required>
                    	<option value=""<?php if ($usuarioSexo == "") { echo " selected"; } ?>></option>
						<option value="M"<?php if ($usuarioSexo == "M") { echo " selected"; } ?>>Masculino</option>
						<option value="F"<?php if ($usuarioSexo == "F") { echo " selected"; } ?>>Feminino</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectEstCivil" class="col-sm-3 control-label">Estado Civil</label>
                <div class="col-sm-3">
                	<select name="estado_civil" class="form-control" id="selectEstCivil" required>
                    	<option value=""<?php if ($usuarioEstadoCivil == "") { echo " selected"; } ?>></option>
                        <option value="1"<?php if ($usuarioEstadoCivil == "1") { echo " selected"; } ?>>Solteiro(a)</option>
                        <option value="2"<?php if ($usuarioEstadoCivil == "2") { echo " selected"; } ?>>Casado(a)</option>
                        <option value="3"<?php if ($usuarioEstadoCivil == "3") { echo " selected"; } ?>>Divorciado(a)</option>
                        <option value="4"<?php if ($usuarioEstadoCivil == "4") { echo " selected"; } ?>>Separado(a)</option>
                        <option value="5"<?php if ($usuarioEstadoCivil == "5") { echo " selected"; } ?>>Viúvo(a)</option>
                        <option value="6"<?php if ($usuarioEstadoCivil == "6") { echo " selected"; } ?>>União Estável</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectFilhos" class="col-sm-3 control-label">Filhos</label>
                <div class="col-sm-2">
                	<select name="filhos" class="form-control" id="selectFilhos" required>
                    	<option value="00"<?php if ($usuarioFilhos == "00") { echo " selected"; } ?>>Não</option>
                        <option value="01"<?php if ($usuarioFilhos == "01") { echo " selected"; } ?>>01</option>
                        <option value="02"<?php if ($usuarioFilhos == "02") { echo " selected"; } ?>>02</option>
                        <option value="03"<?php if ($usuarioFilhos == "03") { echo " selected"; } ?>>03</option>
                        <option value="04"<?php if ($usuarioFilhos == "04") { echo " selected"; } ?>>04</option>
                        <option value="05"<?php if ($usuarioFilhos == "05") { echo " selected"; } ?>>05</option>
                        <option value="06"<?php if ($usuarioFilhos == "06") { echo " selected"; } ?>>06</option>
                        <option value="07"<?php if ($usuarioFilhos == "07") { echo " selected"; } ?>>07</option>
                        <option value="08"<?php if ($usuarioFilhos == "08") { echo " selected"; } ?>>08</option>
                        <option value="09"<?php if ($usuarioFilhos == "09") { echo " selected"; } ?>>09</option>
                        <option value="10"<?php if ($usuarioFilhos == "10") { echo " selected"; } ?>>10</option>
                        <option value="11"<?php if ($usuarioFilhos == "11") { echo " selected"; } ?>>11</option>
                        <option value="12"<?php if ($usuarioFilhos == "12") { echo " selected"; } ?>>12</option>
                        <option value="13"<?php if ($usuarioFilhos == "13") { echo " selected"; } ?>>13</option>
                        <option value="14"<?php if ($usuarioFilhos == "14") { echo " selected"; } ?>>14</option>
                        <option value="15"<?php if ($usuarioFilhos == "15") { echo " selected"; } ?>>15</option>
                    </select>
                </div>
            </div>
            
            <h2>Documentação</h2>
            
            <div class="form-group">
            	<label for="inputRG" class="col-sm-3 control-label">RG</label>
                <div class="col-sm-3">
                	<input type="text" name="rg" class="form-control" id="inputRG" value="<?php echo $usuarioRG; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="selectUFRG" class="col-sm-3 control-label">Estado RG</label>
                <div class="col-sm-2">
                	<select name="uf_rg" class="form-control" id="selectUFRG">
                    	<option value=""<?php if ($usuarioUFRG == "") { echo " selected"; } ?>></option>
                        <option value="AC"<?php if ($usuarioUFRG == "AC") { echo " selected"; } ?>>AC</option>
                        <option value="AL"<?php if ($usuarioUFRG == "AL") { echo " selected"; } ?>>AL</option>
                        <option value="AM"<?php if ($usuarioUFRG == "AM") { echo " selected"; } ?>>AM</option>
                        <option value="AP"<?php if ($usuarioUFRG == "AP") { echo " selected"; } ?>>AP</option>
                        <option value="BA"<?php if ($usuarioUFRG == "BA") { echo " selected"; } ?>>BA</option>
                        <option value="CE"<?php if ($usuarioUFRG == "CE") { echo " selected"; } ?>>CE</option>
                        <option value="DF"<?php if ($usuarioUFRG == "DF") { echo " selected"; } ?>>DF</option>
                        <option value="ES"<?php if ($usuarioUFRG == "ES") { echo " selected"; } ?>>ES</option>
                        <option value="GO"<?php if ($usuarioUFRG == "GO") { echo " selected"; } ?>>GO</option>
                        <option value="MA"<?php if ($usuarioUFRG == "MA") { echo " selected"; } ?>>MA</option>
                        <option value="MG"<?php if ($usuarioUFRG == "MG") { echo " selected"; } ?>>MG</option>
                        <option value="MS"<?php if ($usuarioUFRG == "MS") { echo " selected"; } ?>>MS</option>
                        <option value="MT"<?php if ($usuarioUFRG == "MT") { echo " selected"; } ?>>MT</option>
                        <option value="PA"<?php if ($usuarioUFRG == "PA") { echo " selected"; } ?>>PA</option>
                        <option value="PB"<?php if ($usuarioUFRG == "PB") { echo " selected"; } ?>>PB</option>
                        <option value="PE"<?php if ($usuarioUFRG == "PE") { echo " selected"; } ?>>PE</option>
                        <option value="PI"<?php if ($usuarioUFRG == "PI") { echo " selected"; } ?>>PI</option>
                        <option value="PR"<?php if ($usuarioUFRG == "PR") { echo " selected"; } ?>>PR</option>
                        <option value="RJ"<?php if ($usuarioUFRG == "RJ") { echo " selected"; } ?>>RJ</option>
                        <option value="RN"<?php if ($usuarioUFRG == "RN") { echo " selected"; } ?>>RN</option>
                        <option value="RO"<?php if ($usuarioUFRG == "RO") { echo " selected"; } ?>>RO</option>
                        <option value="RR"<?php if ($usuarioUFRG == "RR") { echo " selected"; } ?>>RR</option>
                        <option value="RS"<?php if ($usuarioUFRG == "RS") { echo " selected"; } ?>>RS</option>
                        <option value="SC"<?php if ($usuarioUFRG == "SC") { echo " selected"; } ?>>SC</option>
                        <option value="SE"<?php if ($usuarioUFRG == "SE") { echo " selected"; } ?>>SE</option>
                        <option value="SP"<?php if ($usuarioUFRG == "SP") { echo " selected"; } ?>>SP</option>
                        <option value="TO"<?php if ($usuarioUFRG == "TO") { echo " selected"; } ?>>TO</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectCNH" class="col-sm-3 control-label">CNH</label>
                <div class="col-sm-2">
                	<select name="cnh" class="form-control" id="selectCNH">
                    	<option value="0"<?php if ($usuarioCNH == "0" || $usuarioCNH == '') { echo " selected"; } ?>>Não</option>
                        <option value="A"<?php if ($usuarioCNH == "A") { echo " selected"; } ?>>A</option>
                        <option value="B"<?php if ($usuarioCNH == "B") { echo " selected"; } ?>>B</option>
                        <option value="C"<?php if ($usuarioCNH == "C") { echo " selected"; } ?>>C</option>
                        <option value="D"<?php if ($usuarioCNH == "D") { echo " selected"; } ?>>D</option>
                        <option value="E"<?php if ($usuarioCNH == "E") { echo " selected"; } ?>>E</option>
                        <option value="AB"<?php if ($usuarioCNH == "AB") { echo " selected"; } ?>>AB</option>
                        <option value="AC"<?php if ($usuarioCNH == "AC") { echo " selected"; } ?>>AC</option>
                        <option value="AD"<?php if ($usuarioCNH == "AD") { echo " selected"; } ?>>AD</option>
                        <option value="AE"<?php if ($usuarioCNH == "AE") { echo " selected"; } ?>>AE</option>
                    </select>
                </div>
            </div>
            
            <h2>Dados para Contato</h2>
            
            <div class="form-group">
            	<label for="inputFone" class="col-sm-3 control-label">Telefone Fixo</label>
                <div class="col-sm-3">
                	<input type="text" name="fone" class="form-control" id="inputFone" value="<?php echo $usuarioFone; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputRecados" class="col-sm-3 control-label">Recados Falar com</label>
                <div class="col-sm-5">
                	<input type="text" name="recados" class="form-control" id="inputRecados" value="<?php echo $usuarioRecados; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCelular" class="col-sm-3 control-label">Telefone Celular</label>
                <div class="col-sm-3">
                	<input type="text" name="celular" class="form-control" id="inputCelular" value="<?php echo $usuarioCelular; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputWebsite" class="col-sm-3 control-label">Website Pessoal</label>
                <div class="col-sm-9">
                	<input type="text" name="website" class="form-control" id="inputWebsite" maxlength="255" value="<?php echo $usuarioWebsite; ?>">
                </div>
            </div>
            
            <h2>Endereço</h2>
            
            <div class="form-group">
            	<label for="inputEndereco" class="col-sm-3 control-label">Endereço</label>
                <div class="col-sm-9">
                	<input type="text" name="endereco" class="form-control" id="inputEndereco" maxlength="255" value="<?php echo $usuarioEndereco; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputNumero" class="col-sm-3 control-label">Número</label>
                <div class="col-sm-2">
                	<input type="text" name="numero" class="form-control" id="inputNumero" maxlength="5" value="<?php echo $usuarioNumero; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputComplemento" class="col-sm-3 control-label">Complemento</label>
                <div class="col-sm-6">
                	<input type="text" name="complemento" class="form-control" id="inputComplemento" maxlength="100" value="<?php echo $usuarioComplemento; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputBairro" class="col-sm-3 control-label">Bairro</label>
                <div class="col-sm-6">
                	<input type="text" name="bairro" class="form-control" id="inputBairro" maxlength="100" value="<?php echo $usuarioBairro; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCEP" class="col-sm-3 control-label">CEP</label>
                <div class="col-sm-3">
                	<input type="text" name="cep" class="form-control" id="inputCEP" value="<?php echo $usuarioCEP; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCidade" class="col-sm-3 control-label">Cidade</label>
                <div class="col-sm-6">
                	<input type="text" name="cidade" class="form-control" id="inputCidade" maxlength="100" value="<?php echo $usuarioCidade; ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="selectUF" class="col-sm-3 control-label">Estado</label>
                <div class="col-sm-2">
                	<select name="uf" class="form-control" id="selectUF">
                    	<option value=""<?php if ($usuarioUF == "") { echo " selected"; } ?>></option>
                        <option value="AC"<?php if ($usuarioUF == "AC") { echo " selected"; } ?>>AC</option>
                        <option value="AL"<?php if ($usuarioUF == "AL") { echo " selected"; } ?>>AL</option>
                        <option value="AM"<?php if ($usuarioUF == "AM") { echo " selected"; } ?>>AM</option>
                        <option value="AP"<?php if ($usuarioUF == "AP") { echo " selected"; } ?>>AP</option>
                        <option value="BA"<?php if ($usuarioUF == "BA") { echo " selected"; } ?>>BA</option>
                        <option value="CE"<?php if ($usuarioUF == "CE") { echo " selected"; } ?>>CE</option>
                        <option value="DF"<?php if ($usuarioUF == "DF") { echo " selected"; } ?>>DF</option>
                        <option value="ES"<?php if ($usuarioUF == "ES") { echo " selected"; } ?>>ES</option>
                        <option value="GO"<?php if ($usuarioUF == "GO") { echo " selected"; } ?>>GO</option>
                        <option value="MA"<?php if ($usuarioUF == "MA") { echo " selected"; } ?>>MA</option>
                        <option value="MG"<?php if ($usuarioUF == "MG") { echo " selected"; } ?>>MG</option>
                        <option value="MS"<?php if ($usuarioUF == "MS") { echo " selected"; } ?>>MS</option>
                        <option value="MT"<?php if ($usuarioUF == "MT") { echo " selected"; } ?>>MT</option>
                        <option value="PA"<?php if ($usuarioUF == "PA") { echo " selected"; } ?>>PA</option>
                        <option value="PB"<?php if ($usuarioUF == "PB") { echo " selected"; } ?>>PB</option>
                        <option value="PE"<?php if ($usuarioUF == "PE") { echo " selected"; } ?>>PE</option>
                        <option value="PI"<?php if ($usuarioUF == "PI") { echo " selected"; } ?>>PI</option>
                        <option value="PR"<?php if ($usuarioUF == "PR") { echo " selected"; } ?>>PR</option>
                        <option value="RJ"<?php if ($usuarioUF == "RJ") { echo " selected"; } ?>>RJ</option>
                        <option value="RN"<?php if ($usuarioUF == "RN") { echo " selected"; } ?>>RN</option>
                        <option value="RO"<?php if ($usuarioUF == "RO") { echo " selected"; } ?>>RO</option>
                        <option value="RR"<?php if ($usuarioUF == "RR") { echo " selected"; } ?>>RR</option>
                        <option value="RS"<?php if ($usuarioUF == "RS") { echo " selected"; } ?>>RS</option>
                        <option value="SC"<?php if ($usuarioUF == "SC") { echo " selected"; } ?>>SC</option>
                        <option value="SE"<?php if ($usuarioUF == "SE") { echo " selected"; } ?>>SE</option>
                        <option value="SP"<?php if ($usuarioUF == "SP") { echo " selected"; } ?>>SP</option>
                        <option value="TO"<?php if ($usuarioUF == "TO") { echo " selected"; } ?>>TO</option>
                    </select>
                </div>
            </div>
            
            <h2>Portador de Necessidades Especiais</h2>
            
            <div class="form-group">
            	<label for="inputPNE" class="col-sm-3 control-label">PNE</label>
                <div class="col-sm-6">
                	<div class="radio">
                        <label>
                        <input type="radio" name="pne" value="N" onclick="if(document.getElementById('inputPNEDesc').disabled==false){document.getElementById('inputPNEDesc').disabled=true}" <?php if ($usuarioPNE == "N") { echo "checked"; } ?>> Não
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        <input type="radio" name="pne" value="S" onclick="if(document.getElementById('inputPNEDesc').disabled==true){document.getElementById('inputPNEDesc').disabled=false}" <?php if ($usuarioPNE == "S") { echo "checked"; } ?>> Sim
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputPNEDesc" class="col-sm-3 control-label">Qual?</label>
                <div class="col-sm-6">
                	<input type="text" name="pne_desc" class="form-control" id="inputPNEDesc" maxlength="255" value="<?php echo $usuarioIndicacao; ?>" disabled>
                </div>
            </div>
            
            <h2>Você foi indicado por algum colaborador da Linde?</h2>
            
            <div class="form-group">
            	<label for="inputIndicacao" class="col-sm-3 control-label">Nome do Colaborador</label>
                <div class="col-sm-6">
                	<input type="text" name="indicacao" class="form-control" id="inputIndicacao" maxlength="255" value="<?php echo $usuarioPNEDesc; ?>">
                </div>
            </div>
            
            <h2>Situação Atual</h2>
            
            <div class="form-group">
            	<label for="selectEmpregado" class="col-sm-3 control-label">Empregado Atualmente</label>
                <div class="col-sm-2">
                	<select name="empregado" class="form-control" id="selectEmpregado" required>
                    	<option value=""<?php if ($usuarioEmpregado == "") { echo " selected"; } ?>></option>
                        <option value="S"<?php if ($usuarioEmpregado == "S") { echo " selected"; } ?>>Sim</option>
                        <option value="N"<?php if ($usuarioEmpregado == "N") { echo " selected"; } ?>>Não</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectSituacao" class="col-sm-3 control-label">Situação Atual</label>
                <div class="col-sm-7">
                	<select name="situacao" class="form-control" id="selectSituacao" required>
                    	<option value=""<?php if ($usuarioSituacao == "") { echo " selected"; } ?>></option>
                        <option value="1"<?php if ($usuarioSituacao == "1") { echo " selected"; } ?>>Estou em busca do primeiro estágio</option>
                        <option value="2"<?php if ($usuarioSituacao == "2") { echo " selected"; } ?>>Estou em busca de outro estágio</option>
                        <option value="3"<?php if ($usuarioSituacao == "3") { echo " selected"; } ?>>Estou em busca do primeiro emprego</option>
                        <option value="4"<?php if ($usuarioSituacao == "4") { echo " selected"; } ?>>Estou em busca de outro emprego</option>
                        <option value="5"<?php if ($usuarioSituacao == "5") { echo " selected"; } ?>>Sou recém-formado, busco um emprego melhor</option>
                        <option value="6"<?php if ($usuarioSituacao == "6") { echo " selected"; } ?>>Desempregado recentemente</option>
                        <option value="7"<?php if ($usuarioSituacao == "7") { echo " selected"; } ?>>Desempregado a mais de 3 meses</option>
                        <option value="8"<?php if ($usuarioSituacao == "8") { echo " selected"; } ?>>Desempregado a mais de 1 ano</option>
                    </select>
                </div>
            </div>
            
            <h2>Objetivo Profissional</h2>
            
            <div class="form-group">
            	<label for="selectArea" class="col-sm-3 control-label">Área de Atuação</label>
                <div class="col-sm-4">
                	<select name="area" class="form-control" id="selectArea" required>
                    	<option value=""<?php if ($usuarioArea == "") { echo " selected"; } ?>></option>
                        <option value="1"<?php if ($usuarioArea == "1") { echo " selected"; } ?>>Administrativa</option>
                        <option value="2"<?php if ($usuarioArea == "2") { echo " selected"; } ?>>Almoxarifado</option>
                        <option value="3"<?php if ($usuarioArea == "3") { echo " selected"; } ?>>Compras</option>
                        <option value="4"<?php if ($usuarioArea == "4") { echo " selected"; } ?>>Contabilidade</option>
                        <option value="5"<?php if ($usuarioArea == "5") { echo " selected"; } ?>>Construção Civil</option>
                        <option value="18"<?php if ($usuarioArea == "18") { echo " selected"; } ?>>Faturamento</option>
                        <option value="6"<?php if ($usuarioArea == "6") { echo " selected"; } ?>>Financeiro</option>
                        <option value="17"<?php if ($usuarioArea == "17") { echo " selected"; } ?>>Limpeza</option>
                        <option value="7"<?php if ($usuarioArea == "7") { echo " selected"; } ?>>Manutenção</option>
                        <option value="8"<?php if ($usuarioArea == "8") { echo " selected"; } ?>>PCP</option>
                        <option value="9"<?php if ($usuarioArea == "9") { echo " selected"; } ?>>Portaria</option>
                        <option value="10"<?php if ($usuarioArea == "10") { echo " selected"; } ?>>Produção</option>
                        <option value="11"<?php if ($usuarioArea == "11") { echo " selected"; } ?>>Projeto</option>
                        <option value="12"<?php if ($usuarioArea == "12") { echo " selected"; } ?>>Qualidade</option>
                        <option value="13"<?php if ($usuarioArea == "13") { echo " selected"; } ?>>Recepção</option>
                        <option value="20"<?php if ($usuarioArea == "20") { echo " selected"; } ?>>RH</option>
                        <option value="19"<?php if ($usuarioArea == "19") { echo " selected"; } ?>>Técnico Segurança</option>
                        <option value="14"<?php if ($usuarioArea == "14") { echo " selected"; } ?>>TI</option>
                        <option value="15"<?php if ($usuarioArea == "15") { echo " selected"; } ?>>Transporte</option>
                        <option value="16"<?php if ($usuarioArea == "16") { echo " selected"; } ?>>Vendas</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectNivel" class="col-sm-3 control-label">Nível</label>
                <div class="col-sm-4">
                	<select name="nivel" class="form-control" id="selectNivel" required>
                    	<option value=""<?php if ($usuarioNivel == "") { echo " selected"; } ?>></option>
                        <option value="1"<?php if ($usuarioNivel == "1") { echo " selected"; } ?>>Estagiário</option>
                        <option value="2"<?php if ($usuarioNivel == "2") { echo " selected"; } ?>>Auxiliar</option>
                        <option value="3"<?php if ($usuarioNivel == "3") { echo " selected"; } ?>>Assistente</option>
                        <option value="4"<?php if ($usuarioNivel == "4") { echo " selected"; } ?>>Técnico</option>
                        <option value="5"<?php if ($usuarioNivel == "5") { echo " selected"; } ?>>Trainee</option>
                        <option value="6"<?php if ($usuarioNivel == "6") { echo " selected"; } ?>>Líder</option>
                        <option value="7"<?php if ($usuarioNivel == "7") { echo " selected"; } ?>>Encarregado</option>
                        <option value="8"<?php if ($usuarioNivel == "8") { echo " selected"; } ?>>Supervisor</option>
                        <option value="9"<?php if ($usuarioNivel == "9") { echo " selected"; } ?>>Gerente</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectSalario" class="col-sm-3 control-label">Pretenção Salarial</label>
                <div class="col-sm-4">
                	<select name="salario" class="form-control" id="selectSalario" required>
                    	<option value=""<?php if ($usuarioSalario == "") { echo " selected"; } ?>></option>
                        <option value="1"<?php if ($usuarioSalario == "1") { echo " selected"; } ?>>Até R$500,00</option>
                        <option value="2"<?php if ($usuarioSalario == "2") { echo " selected"; } ?>>Até R$1.000,00</option>
                        <option value="3"<?php if ($usuarioSalario == "3") { echo " selected"; } ?>>A partir de R$1.000,00</option>
                        <option value="4"<?php if ($usuarioSalario == "4") { echo " selected"; } ?>>A partir de R$1.500,00</option>
                        <option value="5"<?php if ($usuarioSalario == "5") { echo " selected"; } ?>>A partir de R$2.000,00</option>
                        <option value="6"<?php if ($usuarioSalario == "6") { echo " selected"; } ?>>A partir de R$2.500,00</option>
                        <option value="7"<?php if ($usuarioSalario == "7") { echo " selected"; } ?>>A partir de R$3.000,00</option>
                        <option value="8"<?php if ($usuarioSalario == "8") { echo " selected"; } ?>>A partir de R$4.000,00</option>
                        <option value="9"<?php if ($usuarioSalario == "9") { echo " selected"; } ?>>A partir de R$5.000,00</option>
                        <option value="10"<?php if ($usuarioSalario == "10") { echo " selected"; } ?>>A partir de R$6.000,00</option>
                        <option value="11"<?php if ($usuarioSalario == "11") { echo " selected"; } ?>>A partir de R$7.000,00</option>
                        <option value="12"<?php if ($usuarioSalario == "12") { echo " selected"; } ?>>A partir de R$8.000,00</option>
                        <option value="13"<?php if ($usuarioSalario == "13") { echo " selected"; } ?>>A partir de R$9.000,00</option>
                        <option value="14"<?php if ($usuarioSalario == "14") { echo " selected"; } ?>>A partir de R$10.000,00</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputObjetivo" class="col-sm-3 control-label">Objetivo Profissional</label>
                <div class="col-sm-9">
                	<textarea name="objetivo" rows="8" class="form-control" id="inputObjetivo" placeholder="Coloque aqui seus objetivos profissionais."><?php echo $usuarioObjetivo; ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputMiniCurriculo" class="col-sm-3 control-label">Mini Currículo</label>
                <div class="col-sm-9">
                	<textarea name="mini" rows="8" class="form-control" id="inputMiniCurriculo" placeholder="Mini Currículo é um resumo do seu currículo e é a primeira informação visualizada pela empresa na busca de currículos. Por isso seja claro e objetivo."><?php echo $usuarioMini; ?></textarea>
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>