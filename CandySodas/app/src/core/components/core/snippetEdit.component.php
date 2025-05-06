<?php 
  global $CONFIG;
  session_start();

  if($contentType == "page") {
    $edit = "page-update.html?id=".$registerId;
  }

  if (($_SESSION["user"])) { 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Flutuante</title>
    <style>
        /* Botão fixo na parte inferior esquerda com efeito vidro */
        .edit-button {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 300px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1); /* Transparência estilo vidro */
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            z-index: 1001;
            border-radius: 0;
            outline: none;
            box-shadow: none;
            backdrop-filter: blur(10px); 
        }

        /* Painel lateral com o mesmo efeito vidro */
        .edit-panel {
            position: fixed;
            bottom: 50px; /* Acima do botão */
            left: -300px; /* Começa escondido */
            width: 300px;
            height: calc(100vh - 50px); /* Altura total menos o botão */
            background: rgba(255, 255, 255, 0.1); /* Transparência estilo vidro */
            /* box-shadow: 2px 0 5px rgba(255, 255, 255, 0.2); */
            backdrop-filter: blur(10px); /* Efeito vidro */
            transition: left 0.3s ease;
            padding: 20px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .edit-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .edit-menu li:last-child {
            border-bottom: none;
        }

        .edit-menu a {
            display: block;
            padding: 12px;
            /* background: rgba(0, 0, 0, 0.6); */
            color: white;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
        }

        .edit-menu a:hover {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body>

    <!-- Painel de Edição Lateral -->
    <div id="editPanel" class="edit-panel">
        <ul class="edit-menu">
            <li>
              <a href="<?= $CONFIG['CONF']['adminCMS']; ?>">
              <img src="<?=$CONFIG['CONF']['adminCMS'];?>/assets/media/logos/logotipo-white.svg" alt="SGIX " height="60"/>
              </a>
          </li>
            <li><a href="<?= $CONFIG['CONF']['adminCMS']; ?>">Ir para Painel</a></li>
            <li><a href="<?= $CONFIG['CONF']['adminCMS'].'/'.$edit; ?>">Editar esta página</a></li>
            <li><a href="/nova-pagina">Adicionar Nova Página</a></li>
        </ul>
    </div>

    <!-- Botão de Edição -->
    <button id="editButton" class="edit-button">Editar</button>

    <script>
        document.getElementById('editButton').addEventListener('click', function () {
            const panel = document.getElementById('editPanel');
            panel.style.left = panel.style.left === '0px' ? '-300px' : '0px';
        });
    </script>

</body>
</html>
<?php } ?>
