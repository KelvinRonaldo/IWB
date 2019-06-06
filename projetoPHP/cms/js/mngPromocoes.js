var rangePercentual = document.getElementById("rng-percentual");
var txtPrecoAtual = document.getElementById("txt-preco-atual");
var sltProduto = document.getElementById("slt-produto");
var txtValorDesconto = document.getElementById("valor-desconto");
var txtPrecoDesconto = document.getElementById("txt-preco-desconto");
var txtNumParcelas = document.getElementById('txt-numero-parcelas');
var txtMetodoPagamento = document.getElementById('txt-metodo-pagamento');
var txtDescricaoPagamento = document.getElementById('txt-descricao-pagamento');

var precoAtual = "";
var valorRange = "";

function mostrarPercentual(){
    valorRange = rangePercentual.value;
    txtValorDesconto.textContent = valorRange+'%';
}
function calcular(){
    precoAtual = txtPrecoAtual.textContent;
    precoAtual = parseFloat(precoAtual.replace("R$", ""));
    let novoPreco =  precoAtual-(precoAtual*(valorRange/100));
    txtPrecoDesconto.value = novoPreco.toFixed(2).replace(".", ",");
}

function showPreco(){
    precoAtual = parseFloat(sltProduto.options[sltProduto.selectedIndex].dataset.preco);
    txtPrecoAtual.textContent = precoAtual != undefined ?`R$${precoAtual.toFixed(2).replace(".", ",")}`: "";
    calcular();
    enableDisableRange();
}

function enableDisableRange(){
    if(txtPrecoAtual.textContent == "" && txtPrecoAtual.textContent != undefined){
        rangePercentual.disabled = true;
        rangePercentual.value = 0;
        txtValorDesconto.textContent = "__";
        txtPrecoDesconto.value = `00,00`;
    }else{
        rangePercentual.disabled = false;
        rangePercentual.value = 0;
        calcular();
        mostrarPercentual();
    }
}

function descreverPagamento(){
    if(txtNumParcelas.value != "" && txtMetodoPagamento.value != "" && txtPrecoDesconto.value != '00,00'){
        let numParcelas = parseFloat(txtNumParcelas.value);
        let metodoPagamento = txtMetodoPagamento.value;
        let precoDesconto = (txtPrecoDesconto.value).replace(",", ".");
        precoDesconto = parseFloat(precoDesconto);

        txtDescricaoPagamento.value = `${numParcelas}x de R$${(precoDesconto/numParcelas).toFixed(2)} - ${metodoPagamento}`;
    }
}

txtNumParcelas.addEventListener('input', descreverPagamento);
txtMetodoPagamento.addEventListener('input', descreverPagamento);
rangePercentual.addEventListener('input', mostrarPercentual);
rangePercentual.addEventListener('input', calcular);
rangePercentual.addEventListener('input', descreverPagamento);
sltProduto.addEventListener('change', showPreco);
sltProduto.addEventListener('change', enableDisableRange);
enableDisableRange();
descreverPagamento();
