    <!-- ITEM DO MENU -->
    <div id="container-categoria-menu" class="container-categoria-menu">
                    <!-- MENU À ESQUERDA DA PAGINA -->
                        <div id="menu-esq" class="menu-categoria-close">
                            <div onclick="buscarPorProdutosFiltros(0, 0)" class="item-menu-esq-clean">
                                <h3>Limpar Filtros</h3>
                                <div class="icon-subcategorias">
                                    <figure>
                                        <img src="./imgs/eraser.png" class="icon-clean-categories">
                                    </figure>
                                </div>
                            </div>
                            <?php
                                $sqlCategoria = "SELECT * FROM tbl_categoria WHERE status = 'ativado'";
                                $selectCategoria = mysqli_query($conexao, $sqlCategoria);

                                while($rsCategorias = mysqli_fetch_array($selectCategoria)){
                                $codCategoria = $rsCategorias['cod_categoria'];
                                $categoria = $rsCategorias['categoria'];
                            ?>
                            <div class="item-menu-esq">
                                <h3 onclick="buscarPorProdutosFiltros(<?= $codCategoria?>, 0)"><?php echo $categoria; ?></h3>
                                <div class="icon-subcategorias">
                                    <figure>
                                        <img src="./imgs/plus.png" class="icon-show-categories">
                                    </figure>
                                </div>

                                <ul class="caixa-subitem-menu-esq esconder">
                                    <?php
                                        $sqlSubcategoria = "SELECT distinct s.subcategoria,s.cod_subcategoria
                                        FROM tbl_categoria AS c
                                        INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
                                        ON c.cod_categoria = tpsc.cod_categoria
                                        INNER JOIN tbl_subcategoria AS s
                                        ON tpsc.cod_subcategoria = s.cod_subcategoria
                                        WHERE c.status = 'ativado' AND s.status = 'ativado'
                                        AND c.cod_categoria = ".$codCategoria;

                                        $selectSubcategoria = mysqli_query($conexao, $sqlSubcategoria);

                                        while($rsSubcategorias = mysqli_fetch_array($selectSubcategoria)){
                                        $codSubategoria = $rsSubcategorias['cod_subcategoria'];
                                        $subcategoria = $rsSubcategorias['subcategoria'];
                                    ?>
                                    <li class="subitem-menu-esq">
                                        <h3 class="subitem-menu-esq-h3" onclick="buscarPorProdutosFiltros(<?= $codCategoria.', '.$codSubategoria; ?>)"><?= $subcategoria?></h3>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>
                    