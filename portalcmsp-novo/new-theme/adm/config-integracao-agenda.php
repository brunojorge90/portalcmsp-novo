<?php

if(!is_user_logged_in()) exit();

$url = get_option("url_integracao");

if($_POST['url_integracao']) {
    update_option("url_integracao", $_POST["url_integracao"]);
}
?>

<div class="wrap">
    <h1>Configurações de integração da Agenda</h1>
    <form id="your-profile" method="post" novalidate="novalidate" enctype="multipart/form-data" encoding="multipart/form-data">
        <h2>Configurações</h2>
        <table class="form-table" role="presentation">
            <tbody>
            <tr class="user-first-name-wrap">
                <th><label for="first_name">URL de integração</label></th>
                <td>
                    <input type="text" name="url_integracao" id="url_integracao" value="<?php echo $url?>" class="regular-text">
                    <p>Adicione o parâmetro <strong>{data}</strong> para substituir a data.</p>
                </td>

            </tr>

            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                                 value="Atualizar"></p>
    </form>
</div>