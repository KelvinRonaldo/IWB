// SCRIPT JS QUE PREENCHE OS CAMPOS DO ENDEREÇO DA LOJA AUTOMATICAMENTE

// VARIAVEL QUE RECEBE CAMPO DO CEP
var caixaCep = document.getElementById('cep');
// FUNCAO QUE CHAMA ARQUIVO PHP QUE TRAZ CIDADE E ESTADO DO VANCO SEGUNDO CEP DIGITADO PELO USUARIO
function getAddress(){
    
    let numCep = caixaCep.value;
    if(numCep != ""){

        $.ajax({
            type: 'GET',
            url: `https://viacep.com.br/ws/${numCep}/json/`,
            success: function(data) {
                selectAddress(data);
            }
        });
            
        const selectAddress = (endereco) =>{
            // console.log(endereco);
            $.ajax({
                type: 'get',
                url: 'gerarEnderecos.php',
                data: {modo: 'select',endereco: endereco},
                complete: function(response){
                    let infoEndereco = JSON.parse(response.responseText);
                    preencherCampos(infoEndereco);
                    console.log(infoEndereco);
                }, 
                error: function(){

                }
            });
        }
    }else{
        // alert("Nao");
    }
}

// FUNCAO QUE PREENCHE OS CAMPOS COM DADOS DO BANCO E TRAZIDOS PELA API NO ARQUIVO PHP
function preencherCampos(endereco){
    // VARIÁVEIS QUE RECEBEM CAMPOS DO ENDERECO
    var caixaLogradouro = document.getElementById('logradouro');
    var caixaBairro = document.getElementById('bairro');
    var caixaCidade = document.getElementById('cidade');
    var caixaEstado = document.getElementById('estado');
    
    caixaLogradouro.value = endereco.logradouro;
    caixaBairro.value = endereco.bairro;
    caixaCidade.value = endereco.nome_cidade;
    caixaCidade.style.textTransform = "capitalize";
    caixaCidade.dataset.codCidade = endereco.cod_cidade;
    caixaEstado.value = endereco.nome_estado;
    caixaEstado.dataset.codEstado = endereco.cod_estado;
    // alert(endereco.cep);
}

caixaCep.addEventListener('change', getAddress);