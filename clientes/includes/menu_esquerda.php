        <p class="text-center"><img src="img/sem_foto.jpg" alt="" class="img-circle img-responsive"></p>
                
        <br>
        
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"<?php if ($pg_atual == "/clientes/index.php" || $pg_atual == '') { echo "class=\"active\""; } ?>>
            	<a href="index.php"><img src="img/menu_home.png"> Início</a>
            </li>
            <li role="presentation"<?php if ($pg_atual == "/clientes/dados.php") { echo " class=\"active\""; } ?>>
            	<a href="dados.php"><img src="img/menu_dados.png"> Meus Dados</a>
            </li>
            <li role="presentation"<?php if ($pg_atual == "/clientes/projetos.php") { echo " class=\"active\""; } ?>>
            	<a href="projetos.php"><img src="img/menu_projetos.png"> Projetos</a>
            </li>
            <li role="presentation"<?php if ($pg_atual == "/clientes/catalogos.php") { echo " class=\"active\""; } ?>>
            	<a href="catalogos.php"><img src="img/menu_catalogos.png"> Catálogos</a>
            </li>
            <li role="presentation"<?php if ($pg_atual == "/clientes/promocoes.php") { echo " class=\"active\""; } ?>>
            	<a href="promocoes.php"><img src="img/menu_promocoes.png"> Promoções</a>
            </li>
        </ul>