<?php

require "../priv/fileload.php";

$fase = "checkout_form";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Checkout</title>

    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
    <?php
                
        include('header.php');
                    
    ?>  
    
    <div class="body">
        <div class="titulo">
            <a href="../publ/carrinho.php">
                <button>
                    <img src="../images/icons/voltar-icon.png" width="20" height="20"> 
                    Voltar
                </button>
            </a>
            <h1>Checkout</h1>
        </div>

        <div class="checkoutForm">
            <div class="left">
                <?php 
                
                    if(!isset($_GET['cc_method'])) {
                        
                        $id_utilizador = $_SESSION['id'];

                        $artigosString = generateCheckoutString($connection,$id_utilizador);
                        $valor = generateValor($connection,$id_utilizador);

                ?>
                        <form action="../priv/functions_data.php" method="POST">
                            <input type="hidden" name="id_utilizador" value="<?= $id_utilizador ?>">
                            <input type="hidden" name="artigos_compra" value="<?= $artigosString ?>">
                            <input type="hidden" name="valor_compra" value="<?= $valor ?>">
                            <div>    
                                <fieldset>
                                    <label>Nome</label>
                                    <br>
                                    <input type="text" name="nome" required>
                                </fieldset>
                                <fieldset>
                                    <label>Apelido</label>
                                    <br>
                                    <input type="text" name="apelido" required>
                                </fieldset>
                            </div>
                            <fieldset>
                                <label>Email</label>
                                <br>
                                <input type="email" name="email" required>
                            </fieldset>
                            <fieldset>
                                <label>Morada</label>
                                <br>
                                <input type="text" name="morada" required>
                            </fieldset>
                            <div>
                                <fieldset>
                                    <label>Distríto</label>
                                    <br>
                                    <select name="distrito" required>
                                        <option disabled selected value value="">...</option>
                                        <option value="Aveiro">Aveiro</option>
                                        <option value="Beja">Beja</option>
                                        <option value="Braga">Braga</option>
                                        <option value="Brangança">Brangança</option>
                                        <option value="Castelo Branco">Castelo Branco</option>
                                        <option value="Coimbra">Coimbra</option>
                                        <option value="Évora">Évora</option>
                                        <option value="Faro">Faro</option>
                                        <option value="Guarda">Guarda</option>
                                        <option value="Leiria">Leiria</option>
                                        <option value="Lisboa">Lisboa</option>
                                        <option value="Portalegre">Portalegre</option>
                                        <option value="Porto">Porto</option>
                                        <option value="Santanrém">Santanrém</option>
                                        <option value="Setúbal">Setúbal</option>
                                        <option value="Viana do Castelo">Viana do Castelo</option>
                                        <option value="Vila Real">Vila Real</option>
                                        <option value="Viseu">Viseu</option>
                                    </select> 
                                </fieldset>
                                <fieldset>
                                    <label>Código postal</label>
                                    <br>
                                    <input type="text" name="codigo_postal" placeholder="0000-000" required>
                                </fieldset>
                            </div>
                            <fieldset>
                                <label>Nº de telemovel</label>
                                <br>
                                <input type="text" name="telemovel" required>
                            </fieldset>
                            <fieldset>
                            <label>Método de pagamento</label>
                                <br>
                                <input type="radio" name="metodo_pagamento" value="VISA" required><img src="../images/icons/visa-icon.png" width="25px" height="25px">VISA</input>
                                <input type="radio" name="metodo_pagamento" value="PayPal"><img src="../images/icons/paypal-icon.png" width="25px" height="25px">PayPal</input>
                                <input type="radio" name="metodo_pagamento" value="MB Way"><img src="../images/icons/mbway-icon.png" width="35px" height="35px">MB Way</input>
                                <input type="radio" name="metodo_pagamento" value="Master Card"><img src="../images/icons/mastercard-icon.png" width="35px" height="35px">Master Card</input>
                            </fieldset>
                            <div>
                                <fieldset>
                                    <a href="../publ/checkout.php">Limpar formulário</a>
                                </fieldset>
                                <fieldset>
                                    <button type="submit" name="submit_checkout">Submeter</button>
                                </fieldset>
                            </div>
                        </form>

                <?php 
                
                    } else {

                ?>

                        <form action="../priv/functions_data.php" method="POST">
                            <fieldset>
                                <label>Nº do cartão</label>
                                <br>
                                <input type="text" name="numero_cartao" placeholder="0000  0000  0000  0000">
                            </fieldset>
                            <fieldset>
                                <label>Nome do titular</label>
                                <br>
                                <input type="text" name="nome_titular">
                            </fieldset>
                            <div>    
                                <fieldset>
                                    <label>Data de validade</label>
                                    <br>
                                    <input type="date" name="data_validade">
                                </fieldset>
                                <fieldset>
                                    <label>CCV / CVC</label>
                                    <br>
                                    <input type="text" name="CCV" placeholder="*  *  *">
                                </fieldset>
                            </div>
                            <div>
                                <fieldset>
                                    <a href="../publ/checkout.php">Limpar formulário</a>
                                </fieldset>
                                <fieldset>
                                    <button type="submit" name="submit_cc">Submeter</button>
                                </fieldset>
                            </div>
                        </form>

                <?php

                    }

                ?>
            </div>

            <div class="right">
                <div class="miniCarrinho">
                    <table>
                        <tr>
                            <th>Lista de artigos</th>
                            <th><img src="../images/icons/carrinho-icon.png" width="20" height="20"><?= $_SESSION['quantidadeCarrinho'] ?></th>
                        </tr>
                        <?php
                        
                        $query = "SELECT stock.nome, carrinho.quantidade
                                  FROM carrinho, stock 
                                  WHERE carrinho.id_artigo = stock.id_artigo 
                                  AND carrinho.id_utilizador = '$id_utilizador'
                                  GROUP BY stock.id_artigo";
                        $query_run = mysqli_query($connection,$query);

                        if($query_run) {

                            foreach($query_run as $miniCarrinho) {

                        ?>

                                <tr>
                                    <td><?= $miniCarrinho['nome'] ?></td>
                                    <td class="quantidade"><?= $miniCarrinho['quantidade'] ?></td>
                                </tr>

                        <?php

                            }

                        }

                        ?>
                    </table>
                    <?php 
            
                        if(isset($_SESSION['alerta'])) {

                            echo $_SESSION['alerta'];
                            unset($_SESSION['alerta']);

                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

        include('footer.php');

    ?>
</body>
</html>