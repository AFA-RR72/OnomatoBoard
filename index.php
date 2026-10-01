<?php session_start();
require_once('MVC/config/init.php');
require_once('MVC/config/auth.php');
require_once('MVC/model/user.php');
require_once('MVC/model/sound.php');

check_login();

$sounds = get_sounds();

$user = get_user_by_id($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onomato-Board</title>
    <link rel="stylesheet"
        href="assets/fontawesome-free-7.3.1-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <header>
        <div>
            <h3>OnomatoBoard</h3>
            <form action="MVC/controller/search.php">
                <input type="text" name="search" id="search" placeholder="search" style="display: none;">
            </form>
        </div>
        <div class="menu">
            <?= $user['name'] ?>
            <a href="MVC/controller/log-out.php">Sair</a>
        </div>
    </header>
    <hr>
    <div class="main">
        <form action="MVC/controller/newsound.php" method="post" enctype="multipart/form-data">
            <div class="new-sound">
                <input type="file" name="sound" id="newsound" accept="audio/*">
                <label for="newsound">
                    <i class="fa-solid fa-circle-plus"></i>
                    <br>
                    Novo Som
                </label>
            </div>
            <dialog id="soundModal">
                <h2>Novo Som</h2>

                <label for="soundName">Nome do áudio:</label>
                <input type="text" name="sound_name" id="soundName" required>

                <button type="submit">Adicionar</button>
                <button type="button" id="cancelSound">Cancelar</button>
            </dialog>
        </form>
        <?php foreach ($sounds as $sound): ?>
            <?php if ($sound['user_id'] == $user['id']): ?>
                <div class="sound">
                    <audio src="<?= $sound['path']; ?>"></audio>

                    <button type="button" class="play-sound">
                        <i class="fa-solid fa-circle-play"></i>
                    </button>
                    <br>
                    <span><?= htmlspecialchars($sound['name']) ?></span>

                    <div class="sound-actions">
                        <button type="button" class="restart-sound" title="Reiniciar">
                            <i class="fa-solid fa-rotate-left"></i>
                        </button>

                        <button type="button" class="edit-sound" title="Alterar"
                            data-id="<?= $sound['id'] ?>"
                            data-name="<?= htmlspecialchars($sound['name']) ?>">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <form action="MVC/controller/delete-sound.php" method="post"
                            onsubmit="return confirm('Apagar este som?');">
                            <input type="hidden" name="id" value="<?= $sound['id'] ?>">
                            <button type="submit" class="delete-sound" title="Apagar">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <dialog id="editModal">
        <form action="MVC/controller/edit-sound.php" method="post">
            <h2>Alterar Som</h2>

            <input type="hidden" name="id" id="editId">

            <label for="editName">Nome do áudio:</label>
            <input type="text" name="sound_name" id="editName" required>

            <button type="submit">Salvar</button>
            <button type="button" id="cancelEdit">Cancelar</button>
        </form>
    </dialog>

    <script>
        const sound = document.getElementById('newsound');
        const modal = document.getElementById('soundModal');
        const soundName = document.getElementById('soundName');
        const cancelSound = document.getElementById('cancelSound');

        sound.addEventListener('change', () => {
            if (sound.files.length > 0) {
                modal.showModal();
                soundName.focus();
            }
        });

        cancelSound.addEventListener('click', () => {
            modal.close();
            sound.value = '';
            soundName.value = '';
        });
    </script>
    <script>
        const playButtons = document.querySelectorAll('.play-sound');

        playButtons.forEach(button => {
            const audio = button.parentElement.querySelector('audio');
            const icon = button.querySelector('i');

            button.addEventListener('click', () => {
                if (audio.paused) {
                    audio.play();

                    icon.classList.remove('fa-circle-play');
                    icon.classList.add('fa-circle-pause');
                } else {
                    audio.pause();

                    icon.classList.remove('fa-circle-pause');
                    icon.classList.add('fa-circle-play');
                }
            });

            const restartButton = button.parentElement.querySelector('.restart-sound');

            restartButton.addEventListener('click', () => {
                audio.currentTime = 0;
                audio.play();

                icon.classList.remove('fa-circle-play');
                icon.classList.add('fa-circle-pause');
            });

            audio.addEventListener('ended', () => {
                icon.classList.remove('fa-circle-pause');
                icon.classList.add('fa-circle-play');
            });
        });
    </script>
    <script>
        const editModal = document.getElementById('editModal');
        const editId = document.getElementById('editId');
        const editName = document.getElementById('editName');

        document.querySelectorAll('.edit-sound').forEach(button => {
            button.addEventListener('click', () => {
                editId.value = button.dataset.id;
                editName.value = button.dataset.name;
                editModal.showModal();
                editName.focus();
            });
        });

        document.getElementById('cancelEdit').addEventListener('click', () => {
            editModal.close();
        });
    </script>
</body>

</html>