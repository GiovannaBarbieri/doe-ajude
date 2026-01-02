<?php

function ExibirMsg($ret) {
    switch ($ret) {
        case -4:
            echo '<center><div class="alert alert-danger">
                Usuário ou senha inválido.
                </div></center>';
            break;
        case -3:
            echo '<center><div class="alert alert-danger">
                O campo nova senha e redigite senha são diferentes.
                </div></center>';
            break;
        case -2:
            echo '<center><div class="alert alert-danger">
                Não foi possível excluir o registro, porque está em uso.
                </div></center>';
            break;
        case -1:
            echo '<center><div class="alert alert-danger">
                Ocorreu um erro na operação. Tente mais tarde.
                </div></center>';
            break;
        case 0:
            echo '<center><div class="alert alert-warning">
                Preencher todos os campos obrigatórios.
                </div></center>';
            break;
        case 1:
            echo '<center><div class="alert alert-success">
                Salvo com sucesso.
                </div></center>';
            break;
        case 2:
            echo '<center><div class="alert alert-info">
                Excluído com sucesso.
                </div></center>';
            break;
        case 3:
            echo '<center><div class="alert alert-info">
                Não existe registro.
                </div></center>';
            break;
        case 4:
            echo '<center><div class="alert alert-danger">
                Não foi encontrado esse usuário.
                </div></center>';
            break;
        case 5:
            echo '<center><div class="alert alert-danger">
                Imagem inválida, somemente jpg.
                </div></center>';
            break;
        case 6:
            echo '<center><div class="alert alert-danger">
                O campo imagem não pode ser vazio.
                </div></center>';
            break;
        case -7: 
            echo '<center><div class="alert alert-danger">
                 Não foi possivel redefinir sua senha, por gentileza solicite novamente a redefinição de senha!
                 </div></center>';
            break;
        case -8:
            echo '<center><div class="alert alert-warning">
                 O campo senha ou repetir senha não atendem o mínimo de 6 caracteres!
                 </div></center>';
            break;
        case -9:
            echo '<center><div class="alert alert-warning">
                 O campo senha é diferente do repetir senha!
                 </div></center>';
            break;
        case 10:
            echo '<center><div class="alert alert-success" id="success-alert">
                 Senha redefinida com sucesso!
                 </div></center>';
            break;
        case 11:
            echo '<center><div class="alert alert-success" id="success-alert">
                 Para redefinir a senha, entre no seu e-mail e clique no link para ser feita a Redefinição de e-mail!
                 </div></center>';
            break;
        case 12:
            echo '<center><div class="alert alert-success" id="success-alert">
                 Para redefinir a senha, entre no seu e-mail e clique no link para ser feita a Redefinição de senha!
                 </div></center>';
            break;
        case 13:
            echo '<center><div class="alert alert-success" id="success-alert">
                 Doação cadastrada com sucesso. Estaremos avaliando e entraremos em contato em breve. Caso queira acompanhar a situação da doação clique em <a href="consultar_doacoes.php">CONSULTAR DOAÇÃO</a>
                 </div></center>';
            break;
        case 14:
            echo '<center><div class="alert alert-success" id="success-alert">
                 Doação cadastrada com sucesso. Estaremos avaliando e entraremos em contato em breve. Caso queira acompanhar a situação da doação clique em <a href="consultar_doacoes_parceiro.php">CONSULTAR DOAÇÕES</a>
                 </div></center>';
            break;
    }
}
