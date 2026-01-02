
<style rel="stylesheet">

    img{
        border-radius:10px;
        cursor:pointer;
    }

    /*Visual da janela Modal*/
    .modalVisual{
        display:none; /*Esconder a janela por padrão*/
        position:fixed;/*Permanecer na posição fixa*/
        z-index:1; /*Posicionar no topo da pilha*/
        padding-top:100px;/*Margem interna superior*/
        left:0;
        top:0;
        width:100%; /*Largura total da tela*/
        height:100%; /*Altura total da tela*/
        overflow:auto; /*Barra de rolagem se necessário*/
        background-color:rgba(0,0,0,0.8); /*Cor de fundo e opacidade de 80%*/
    }

    /*Conteúdo da Janela Modal (imagem)*/
    .modalConteudo{
        margin:auto;
        display:block;
        width:100%;
        max-width:800px;
    }

    /*Texto da Imagem*/
    #txtImg{
        margin:auto;
        display:block;
        width:80%;
        max-width:700px;
        text-align:center;
        color:#ccc;
        padding:10px 0;
        height:150px;
    }

    /* Botão X para fechar */
    .fechar{
        position:absolute;
        top:15px;
        right:35px;
        color:#fff;
        font-size:40px;
        font-weight:bold;
        cursor:pointer;
    }

</style>