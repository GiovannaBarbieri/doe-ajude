<?php

class Doacao_sql {

    public static function ConsultarDoacao() {
        $sql = 'select 
                        doador.nome_usuario,
                        doacao.id_doacao,
                        doacao.nome_objeto,
                        doacao.imagem_objeto,
                        doacao.estado_objeto,
                        doacao.descricao_objeto,
                        doacao.cep_objeto,
                        doacao.endereco_objeto,
                        doacao.bairro_objeto,
                        doacao.numero_objeto,
			            doacao.telefone_objeto,
                        doacao.data_objeto,
                        situacao.situacao_status
                        
                    from
                            tb_doacao as doacao
                            
                            inner join  
                            
                            tb_doador as doador 
                            
                            on 
                            
                            doador.id_doador = doacao.id_doador
                            
                            inner join
                                
                            tb_status as situacao
                                
                            on 
                                
                            situacao.id_status = doacao.id_status
                            

';
        return $sql;
    }

}
