function Validar(tela) {

    var ret = true;



    switch (tela) {

        case 1: //quero_doar    &&     quero_doar_parceiro



            if ($("#queroDoar").val().trim() == '') {

                $("#val_queroDoar").show().html("Preencher o campo QUERO DOAR");

                $("#divQueroDoar").addClass("has-error");

                ret = false;

            } else {

                $("#val_queroDoar").hide();

                $("#divQueroDoar").removeClass("has-error");

            }

            if ($("#estadoObj").val().trim() == '') {

                $("#val_estadoObj").show().html("Preencher o campo CONSERVAÇÃO");

                $("#divEstadoObj").addClass("has-error");

                ret = false;

            } else {

                $("#val_estadoObj").hide();

                $("#divEstadoObj").removeClass("has-error");

            }

            if ($("#descricao").val().trim() == '') {

                $("#val_descricao").show().html("Preencher o campo DESCRIÇÃO");

                $("#divDescricao").addClass("has-error");

                ret = false;

            } else {

                $("#val_descricao").hide();

                $("#divDescricao").removeClass("has-error");

            }

            if ($("#imagem").val().trim() == '') {

                $("#val_imagem").show().html("Selecione o campo IMAGEM");

                $("#divImagem").addClass("has-error");

                ret = false;

            } else {

                $("#val_imagem").hide();

                $("#divImagem").removeClass("has-error");

            }

            if ($("#tipo").val().trim() == '') {

                $("#val_tipo").show().html("Selecione o campo ENDEREÇO");

                $("#divTipo").addClass("has-error");

                ret = false;

            } else {

                $("#val_tipo").hide();

                $("#divTipo").removeClass("has-error");

            }



            if ($("#tipo").val().trim() != 1) {



                if ($("#cep").val().trim() == '') {

                    $("#val_cep").show().html("Preencher o campo CEP");

                    $("#divCep").addClass("has-error");

                    ret = false;

                } else {

                    $("#val_cep").hide();

                    $("#divCep").removeClass("has-error");

                }

                if ($("#rua").val().trim() == '') {

                    $("#val_rua").show().html("Preencher o campo RUA");

                    $("#divRua").addClass("has-error");

                    ret = false;

                } else {

                    $("#val_rua").hide();

                    $("#divRua").removeClass("has-error");

                }

                if ($("#numero").val().trim() == '') {

                    $("#val_numero").show().html("Preencher o campo NÚMERO");

                    $("#divNumero").addClass("has-error");

                    ret = false;

                } else {

                    $("#val_numero").hide();

                    $("#divNumero").removeClass("has-error");

                }

                if ($("#bairro").val().trim() == '') {

                    $("#val_bairro").show().html("Preencher o campo BAIRRO");

                    $("#divBairro").addClass("has-error");

                    ret = false;

                } else {

                    $("#val_bairro").hide();

                    $("#divBairro").removeClass("has-error");

                }

                if ($("#cidade").val().trim() == '') {

                    $("#val_cidade").show().html("Preencher o campo CIDADE");

                    $("#divCidade").addClass("has-error");

                    ret = false;

                } else {

                    $("#val_cidade").hide();

                    $("#divCidade").removeClass("has-error");

                }

            }

            break;



        case 2: //trabalho_voluntario



            if ($("#disp").val().trim() == '') {

                $("#val_disp").show().html("Selecione o campo DISPONIBILIDADE");

                $("#divDisp").addClass("has-error");

                ret = false;

            } else {

                $("#val_disp").hide();

                $("#divDisp").removeClass("has-error");

            }

            if ($("#setor").val().trim() == '') {

                $("#val_setor").show().html("Selecione o campo SETOR");

                $("#divSetor").addClass("has-error");

                ret = false;

            } else {

                $("#val_setor").hide();

                $("#divSetor").removeClass("has-error");

            }

            if ($("#sobre").val().trim() == '') {

                $("#val_sobre").show().html("Preencher o campo SOBRE");

                $("#divSobre").addClass("has-error");

                ret = false;

            } else {

                $("#val_sobre").hide();

                $("#divSobre").removeClass("has-error");

            }

            break;





        case 3: //cadastrar_funcionario

            if ($("#nome").val().trim() == '') {

                $("#val_nome").show().html("Preencher o campo NOME");

                $("#divNome").addClass("has-error");

                ret = false;

            } else {

                $("#val_nome").hide();

                $("#divNome").removeClass("has-error");

            }

            if ($("#email").val().trim() == '') {

                $("#val_email").show().html("Preencher o campo E-MAIL");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");



                var email = $("#email").val().trim();

                $.post("assets/ajax/validar_email.php", {email_user: email, acao: 'I'}, function (ret) {

                    if (ret == '1') {

                        $("#val_email").show().html("E-mail já existente");

                        $("#divEmail").addClass("has-error");

                        ret = false;

                    } else {

                        $("#val_email").hide();

                        $("#divEmail").removeClass("has-error");

                    }

                });



            }



            if ($("#telefone").val().trim() == '') {

                $("#val_telefone").show().html("Preencher o campo TELEFONE");

                $("#divTelefone").addClass("has-error");

                ret = false;

            } else {

                $("#val_telefone").hide();

                $("#divTelefone").removeClass("has-error");

            }

            if ($("#cep").val().trim() == '') {

                $("#val_cep").show().html("Preencher o campo CEP");

                $("#divCep").addClass("has-error");

                ret = false;

            } else {

                $("#val_cep").hide();

                $("#divCep").removeClass("has-error");

            }

            if ($("#cidade").val().trim() == '') {

                $("#val_cidade").show().html("Selecionar o campo CIDADE");

                $("#divCidade").addClass("has-error");

                ret = false;

            } else {

                $("#val_cidade").hide();

                $("#divCidade").removeClass("has-error");

            }

            if ($("#rua").val().trim() == '') {

                $("#val_rua").show().html("Preencher o campo RUA");

                $("#divRua").addClass("has-error");

                ret = false;

            } else {

                $("#val_rua").hide();

                $("#divRua").removeClass("has-error");

            }

            if ($("#bairro").val().trim() == '') {

                $("#val_bairro").show().html("Preencher o campo BAIRRO");

                $("#divBairro").addClass("has-error");

                ret = false;

            } else {

                $("#val_bairro").hide();

                $("#divBairro").removeClass("has-error");

            }

            if ($("#numero").val().trim() == '') {

                $("#val_numero").show().html("Preencher o campo NÚMERO");

                $("#divNumero").addClass("has-error");

                ret = false;

            } else {

                $("#val_numero").hide();

                $("#divNumero").removeClass("has-error");

            }

            break;



        case 4: ///gerenciar_parceiro



            if ($("#nome").val().trim() == '') {

                $("#val_nome").show().html("Preencher o campo NOME EMPRESA");

                $("#divNome").addClass("has-error");

                ret = false;

            } else {

                $("#val_nome").hide();

                $("#divNome").removeClass("has-error");

            }

            if ($("#telefone").val().trim() == '') {

                $("#val_telefone").show().html("Preencher o campo TELEFONE");

                $("#divTelefone").addClass("has-error");

                ret = false;

            } else {

                $("#val_telefone").hide();

                $("#divTelefone").removeClass("has-error");

            }

            if ($("#email").val().trim() == '') {

                $("#val_email").show().html("Preencher o campo E-MAIL");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");



                var email = $("#email").val().trim();

                $.post("assets/ajax/validar_email.php", {email_user: email, acao: 'I'}, function (ret) {

                    if (ret == '1') {

                        $("#val_email").show().html("E-mail já existente");

                        $("#divEmail").addClass("has-error");

                        ret = false;

                    } else {

                        $("#val_email").hide();

                        $("#divEmail").removeClass("has-error");

                    }

                });



            }

            if ($("#documento").val().trim() == '') {

                $("#val_doc").show().html("Preencher o campo DOCUMENTO");

                $("#divDoc").addClass("has-error");

                ret = false;

            } else {

                $("#val_doc").hide();

                $("#divDoc").removeClass("has-error");

            }

            if ($("#cidade").val().trim() == '') {

                $("#val_end").show().html("Selecione o campo CIDADE");

                $("#divEnd").addClass("has-error");

                ret = false;

            } else {

                $("#val_end").hide();

                $("#divEnd").removeClass("has-error");

            }

            if ($("#rua").val().trim() == '') {

                $("#val_rua").show().html("Preencher o campo RUA");

                $("#divRua").addClass("has-error");

                ret = false;

            } else {

                $("#val_rua").hide();

                $("#divRua").removeClass("has-error");

            }

            if ($("#bairro").val().trim() == '') {

                $("#val_bairro").show().html("Preencher  o campo BAIRRO");

                $("#divBairro").addClass("has-error");

                ret = false;

            } else {

                $("#val_bairro").hide();

                $("#divBairro").removeClass("has-error");

            }

            if ($("#numero").val().trim() == '') {

                $("#val_numero").show().html("Preencher  o campo NÚMERO");

                $("#divNumero").addClass("has-error");

                ret = false;

            } else {

                $("#val_numero").hide();

                $("#divNumero").removeClass("has-error");

            }

            if ($("#cep").val().trim() == '') {

                $("#val_cep").show().html("Preencher o campo CEP");

                $("#divCep").addClass("has-error");

                ret = false;

            } else {

                $("#val_cep").hide();

                $("#divCep").removeClass("has-error");

            }

            if ($("#responsavel").val().trim() == '') {

                $("#val_resp").show().html("Preencher o campo RESPONSÁVEL");

                $("#divResp").addClass("has-error");

                ret = false;

            } else {

                $("#val_resp").hide();

                $("#divResp").removeClass();

            }

            break;



        case 5://cadastro_pessoa && cadastro_jurico



            if ($("#nome").val().trim() == '') {

                $("#val_nome").show().html("Preencher o campo NOME");

                $("#divNome").addClass("has-error");

                ret = false;

            } else {

                $("#val_nome").hide();

                $("#divNome").removeClass("has-error");

            }

            if ($("#email").val().trim() == '') {

                $("#val_email").show().html("Preencher o campo E-MAIL");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");



                var email = $("#email").val().trim();

                $.post("assets/ajax/validar_email.php", {email_user: email, acao: 'I'}, function (ret) {

                    if (ret == '1') {

                        $("#val_email").show().html("E-mail já existente");

                        $("#divEmail").addClass("has-error");

                        ret = false;

                    } else {

                        $("#val_email").hide();

                        $("#divEmail").removeClass("has-error");

                    }

                });

            }

            if ($("#telefone").val().trim() == '') {

                $("#val_telefone").show().html("Preencher o campo TELEFONE");

                $("#divTelefone").addClass("has-error");

                ret = false;

            } else {

                $("#val_telefone").hide();

                $("#divTelefone").removeClass("has-error");

            }

            if ($("#cep").val().trim() == '') {

                $("#val_cep").show().html("Preencher o campo CEP");

                $("#divCep").addClass("has-error");

                ret = false;

            } else {

                $("#val_cep").hide();

                $("#divCep").removeClass("has-error");

            }

            if ($("#rua").val().trim() == '') {

                $("#val_rua").show().html("Preencher o campo RUA");

                $("#divRua").addClass("has-error");

                ret = false;

            } else {

                $("#val_rua").hide();

                $("#divRua").removeClass("has-error");

            }

            if ($("#bairro").val().trim() == '') {

                $("#val_bairro").show().html("Preencher o campo BAIRRO");

                $("#divBairro").addClass("has-error");

                ret = false;

            } else {

                $("#val_bairro").hide();

                $("#divBairro").removeClass("has-error");

            }

            if ($("#numero").val().trim() == '') {

                $("#val_numero").show().html("Preencher o campo NÚMERO");

                $("#divNumero").addClass("has-error");

                ret = false;

            } else {

                $("#val_numero").hide();

                $("#divNumero").removeClass("has-error");

            }

            if ($("#cidade").val().trim() == '') {

                $("#val_cidade").show().html("Selecionar o campo CIDADE");

                $("#divCidade").addClass("has-error");

                ret = false;

            } else {

                $("#val_cidade").hide();

                $("#divCidade").removeClass("has-error");

            }

            if ($("#senha").val().trim() == '') {

                $("#val_senha").show().html("Preencher o campo SENHA");

                $("#divSenha").addClass("has-error");

                ret = false;

            } else {

                $("#val_senha").hide();

                $("#divSenha").removeClass("has-error");

            }

            if ($("#redigiteSenha").val().trim() == '') {

                $("#val_repetir").show().html("Preencher o campo REPETIR SENHA");

                $("#divRepetir").addClass("has-error");

                ret = false;

            } else {

                $("#val_repetir").hide();

                $("#divRepetir").removeClass("has-error");

            }

            if ($("#senha").val().trim() != $("#redigiteSenha").val().trim()) {

                alert("Senha e repetir senha não conferem!");

                ret = false;

            }



            if ($("#tipo").val().trim() != 3) { //regra para cadastrar pessoa comum sem dar o problema//



                if ($("#resp").val().trim() == '') {

                    $("#val_resp").show().html("Preencher o campo RESPONSÁVEL");

                    $("#divResp").addClass("has-error");

                    ret = false;

                } else {

                    $("#val_resp").hide();

                    $("#divResp").removeClass("has-error");

                } 

            }

            break;

        case 6: ///dados_administrador

            if ($("#nome").val().trim() == '') {

                $("#val_nome").show().html("Preencher o campo NOME");

                $("#divNome").addClass("has-error");

                ret = false;

            } else {

                $("#val_nome").hide();

                $("#divNome").removeClass("has-error");

            }

            if ($("#telefone").val().trim() == '') {

                $("#val_telefone").show().html("Preencher o campo TELEFONE");

                $("#divTelefone").addClass("has-error");

                ret = false;

            } else {

                $("#val_telefone").hide();

                $("#divTelefone").removeClass("has-error");

            }

            if ($("#email").val().trim() == '') {

                $("#val_email").show().html("Preencher o campo E-MAIL");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");



                var email = $("#email").val().trim();

                $.post("assets/ajax/validar_email.php", {email_user: email, acao: 'I'}, function (ret) {

                    if (ret == '1') {

                        $("#val_email").show().html("E-mail já existente");

                        $("#divEmail").addClass("has-error");

                        ret = false;

                    } else {

                        $("#val_email").hide();

                        $("#divEmail").removeClass("has-error");

                    }

                });



            }

            break;



        case 7: ///dados_funcionario



            if ($("#nome").val().trim() == '') {

                $("#val_nome").show().html("Preencher o campo NOME");

                $("#divNome").addClass("has-error");

                ret = false;

            } else {

                $("#val_nome").hide();

                $("#divNome").removeClass("has-error");

            }

            if ($("#telefone").val().trim() == '') {

                $("#val_telefone").show().html("Preencher o campo TELEFONE");

                $("#divTelefone").addClass("has-error");

                ret = false;

            } else {

                $("#val_telefone").hide();

                $("#divTelefone").removeClass("has-error");

            }

            if ($("#email").val().trim() == '') {

                $("#val_email").show().html("Preencher o campo E-MAIL");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");



                var email = $("#email").val().trim();

                $.post("assets/ajax/validar_email.php", {email_user: email, acao: 'I'}, function (ret) {

                    if (ret == '1') {

                        $("#val_email").show().html("E-mail já existente");

                        $("#divEmail").addClass("has-error");

                        ret = false;

                    } else {

                        $("#val_email").hide();

                        $("#divEmail").removeClass("has-error");

                    }

                });

            }

            break;



        case 8: ///gerenciar_doaçoes



            if ($("#tipo_doador").val().trim() == '') {

                $("#val_situacao").show().html("Selecione a SITUAÇÃO");

                $("#divSituacao").addClass("has-error");

                ret = false;

            } else {

                $("#val_situacao").hide();

                $("#divSituacao").removeClass("has-error");

            }

            if ($("#data_inicial").val().trim() == '') {

                $("#val_data_inicial").show().html("Preencher a DATA INICIAL");

                $("#divDataInicial").addClass("has-error");

                ret = false;

            } else {

                $("#val_data_inicial").hide();

                $("#divDataInicial").removeClass("has-error");

            }

            if ($("#data_final").val().trim() == '') {

                $("#val_data_final").show().html("Preencher a DATA FINAL");

                $("#divDataFinal").addClass("has-error");

                ret = false;

            } else {

                $("#val_data_final").hide();

                $("#divDataFinal").removeClass("has-error");

            }

            ;



            break;



        case 9: ///consultar_trabalho_voluntario



            if ($("#tipo_voluntario").val().trim() == '') {

                $("#val_situacao").show().html("Selecione a SITUAÇÃO");

                $("#divTipo").addClass("has-error");

                ret = false;

            } else {

                $("#val_situacao").hide();

                $("#divSituacao").removeClass("has-error");

            }

            if ($("#data_inicial").val().trim() == '') {

                $("#val_dinicial").show().html("Preencher a DATA INICIAL");

                $("#divDinicial").addClass("has-error");

                ret = false;

            } else {

                $("#val_dinicial").hide();

                $("#divDinicial").removeClass("has-error");

            }

            if ($("#data_final").val().trim() == '') {

                $("#val_dfinal").show().html("Preencher a DATA FINAL");

                $("#divDfinal").addClass("has-error");

                ret = false;

            } else {

                $("#val_dfinal").hide();

                $("#divDfinal").removeClass("has-error");

            }

            ;



            break;



        case 10: ///relatorios



            if ($("#tipo_doador").val().trim() == '') {

                $("#val_tipo").show().html("Selecione o TIPO");

                $("#divTipo").addClass("has-error");

                ret = false;

            } else {

                $("#val_tipo").hide();

                $("#divTipo").removeClass("has-error");

            }

            if ($("#data_inicial").val().trim() == '') {

                $("#val_dinicial").show().html("Preencher a DATA INICIAL");

                $("#divDinicial").addClass("has-error");

                ret = false;

            } else {

                $("#val_dinicial").hide();

                $("#divDinicial").removeClass("has-error");

            }



            if ($("#data_final").val().trim() == '') {

                $("#val_dfinal").show().html("Preencher a DATA FINAL");

                $("#divDfinal").addClass("has-error");

                ret = false;

            } else {

                $("#data_final").hide();

                $("#divDfinal").removeClass("has-error");

            }

            break;



        case 11: //nova_senha

            if ($("#senha").val().trim() == '') {

                $("#val_senha").show().html("Preencher o campo SENHA");

                $("#divSenha").addClass("has-error");

                ret = false;

            } else {

                $("#val_senha").hide();

                $("#divSenha").removeClass("has-error");

            }

            if ($("#rsenha").val().trim() == '') {

                $("#val_repetir").show().html("Preencher o campo REPETIR SENHA");

                $("#divRepetir").addClass("has-error");

                ret = false;

            } else {

                $("#val_repetir").hide();

                $("#divRepetir").removeClass("has-error");

            }

            if ($("#senha").val().trim() != $("#rsenha").val().trim()) {

                alert("Senha e repetir senha não conferem!");

                ret = false;

            }

            break;



        case 12://recuperar_senha

            if ($("#email_usuario").val().trim() == '') {

                $("#val_email").show().html("Preencher o campo E-MAIL");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");

            }

            break;



    }

    return ret;

}



function ExibirTipo(tipo) {





    if (tipo == '') {



        $("#divGeral").hide();





    } else {

        $("#divGeral").show();

    }

}



function CadastrarPessoa(tipo) {



    if (tipo == 3) {

        $("#divNomeFunc").show();

        $("#divGeral").hide();

    } else if (tipo == 4) {

        $("#divNomeFunc").show();

        $("#divGeral").show();

    } else {

        $("#divNomeFunc").hide();

        $("#divGeral").hide();

    }

}



function ExibirEndereco(tipo) {



    if (tipo == 1) {

        $("#dadosEndereco").show();

        $("#divGeral").hide();

    } else if (tipo == 2) {

        $("#dadosEndereco").show();

        $("#divGeral").show();

    } else {

        $("#dadosEndereco").hide();

        $("#divGeral").hide();

    }

}



function ValidadarSenha() {



    var senha = $("#senhaAtual").val().trim();



    $.post("assets/ajax/validar_senha.php", {senha_user: senha}, function (ret) {



        if (ret == '0') {

            $("#val_senha").show().html("Não é a senha atual. Tentar novamente ?");

            $("#divSenha").addClass("has-error");

            $("#validaS").hide();

            $("#validaB").hide();

            ret = false;

        } else {

            $("#val_senha").hide();

            $("#divSenha").removeClass("has-error");

            $("#validaS").show();

            $("#validaB").show();

        }

    })

}



function ValidarEmail(acao) {



    if (acao == '1') {



        var email = $("#email").val().trim();



        $.post("assets/ajax/validar_email.php", {

            email_user: email,

            acao: 'I'

        }, function (ret) {



            if (ret == '1') {

                
                $("#val_email").show().html("E-mail já existente: " + email) ;

                $("#divEmail").addClass("has-error");

                $("#email").val('');

                ret = false;



            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");

            }

        });

    } else if (acao == '2') {

        $.post("assets/ajax/validar_email.php", {

            email_user: $("#email").val(),

            idUser: $('#cod').val(),

            acao: 'A'

        }, function (ret) {



            if (ret == '1') {

                $("#val_email").show().html("E-mail já existente");

                $("#divEmail").addClass("has-error");

                ret = false;

            } else {

                $("#val_email").hide();

                $("#divEmail").removeClass("has-error");

            }

        });

    }

}