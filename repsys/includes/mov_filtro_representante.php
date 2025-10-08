<form method="get" action="moveleiro-gerenciar-pedidos.php" class="form-horizontal">
    <fieldset>
        <legend>Filtro</legend>
        
        <div class="form-group form-group-sm">
            <label for="inputDataFiltro" class="col-sm-3 control-label">Data</label>
            <div class="col-sm-5">
                <input type="date" name="filtro_data1" class="form-control" id="inputDataFiltro" value="<?php if (isset($_GET['filtro_data1']) && $_GET['filtro_data1'] != "") { echo $_GET['filtro_data1']; } else { echo $data_filtro_bd; } ?>" required>
                <br>
                <input type="date" name="filtro_data2" class="form-control" id="inputDataFiltro" value="<?php if (isset($_GET['filtro_data2']) && $_GET['filtro_data2'] != "") { echo $_GET['filtro_data2']; } else { echo $data_atual_bd; } ?>" max="<?php echo $data_atual_bd; ?>" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="selectCliente" class="col-sm-3 control-label">Cliente</label>
            <div class="col-sm-4">
                <input type="text" name="filtro_cliente" class="form-control" value="<?php echo $_GET['filtro_cliente']; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="selectStatus" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-5">
                <select name="filtro_status" id="selectStatus" class="form-control">
                    <option></option>
                    <option value="D"<?php if (isset($_GET['filtro_status']) && $_GET['filtro_status'] == "D") { echo " selected"; } ?>>Digitação</option>
                    <option value="P"<?php if (isset($_GET['filtro_status']) && $_GET['filtro_status'] == "P") { echo " selected"; } ?>>Pendente</option>
                    <option value="R"<?php if (isset($_GET['filtro_status']) && $_GET['filtro_status'] == "R") { echo " selected"; } ?>>Recebido</option>
                    <option value="X"<?php if (isset($_GET['filtro_status']) && $_GET['filtro_status'] == "X") { echo " selected"; } ?>>Recusado</option>
                </select>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
            </div>
        </div>
              
        <?php
        if (isset($_GET['filtro_requerente']) || isset($_GET['filtro_cliente']) || isset($_GET['filtro_status']))	{
        ?>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <a href="moveleiro-gerenciar-pedidos.php" class="btn btn-sm btn-danger" title="Fechar Filtro"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <?php
        }
        ?>
    </fieldset>
</form>