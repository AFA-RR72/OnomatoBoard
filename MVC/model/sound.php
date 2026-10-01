<?php require_once(__DIR__ . '/../config/conexao.php');

function save_sound($sound_name, $sound_path, $user_id)
{
    $conn = conn();

    $stmt = $conn->prepare("INSERT INTO sounds (name, path, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param('ssi', $sound_name, $sound_path, $user_id);

    $stmt->execute();
    $stmt->close();

    return;
}

function get_sounds()
{
    $conn = conn();

    $stmt = $conn->prepare("SELECT * FROM sounds");
    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    return $result;
}

function get_sound_by_id($id)
{
    $conn = conn();

    $stmt = $conn->prepare("SELECT * FROM sounds WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $result;
}

function update_sound_name($id, $name, $user_id)
{
    $conn = conn();

    $stmt = $conn->prepare("UPDATE sounds SET name = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param('sii', $name, $id, $user_id);
    $stmt->execute();
    $stmt->close();

    return;
}

function delete_sound($id, $user_id)
{
    $conn = conn();

    $stmt = $conn->prepare("DELETE FROM sounds WHERE id = ? AND user_id = ?");
    $stmt->bind_param('ii', $id, $user_id);
    $stmt->execute();
    $stmt->close();

    return;
}
