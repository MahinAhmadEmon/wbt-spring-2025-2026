<?php
// ================================================================
// MODELS - All DB access using procedural mysqli + prepared stmts
// ================================================================

/* ------------------- Admin ------------------- */
function authAdmin($conn, $username, $password) {
    $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM admins WHERE username = ?");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return ($row && password_verify($password, $row['password'])) ? $row : false;
}

/* ----------------- Staff ----------------- */
function getStaff($conn) {
    $r = mysqli_query($conn, "SELECT id, name, contact, username FROM staff ORDER BY id DESC");
    return mysqli_fetch_all($r, MYSQLI_ASSOC);
}

function getStaffMember($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, contact, username FROM staff WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row;
}

function addStaff($conn, $name, $contact, $username, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn,
        "INSERT INTO staff (name, contact, username, password) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $contact, $username, $hash);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function updateStaff($conn, $id, $name, $contact, $username) {
    $stmt = mysqli_prepare($conn,
        "UPDATE staff SET name = ?, contact = ?, username = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'sssi', $name, $contact, $username, $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function deleteStaff($conn, $id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM staff WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function searchStaff($conn, $term) {
    $like = '%' . $term . '%';
    $stmt = mysqli_prepare($conn,
        "SELECT id, name, contact, username FROM staff
         WHERE name LIKE ? OR username LIKE ? OR contact LIKE ?
         ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, 'sss', $like, $like, $like);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}

function authStaff($conn, $username, $password) {
    $stmt = mysqli_prepare($conn,
        "SELECT id, name, username, password FROM staff WHERE username = ?");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return ($row && password_verify($password, $row['password'])) ? $row : false;
}

function staffUsernameExists($conn, $username, $excludeId = null) {
    if ($excludeId) {
        $stmt = mysqli_prepare($conn, "SELECT id FROM staff WHERE username = ? AND id != ?");
        mysqli_stmt_bind_param($stmt, 'si', $username, $excludeId);
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM staff WHERE username = ?");
        mysqli_stmt_bind_param($stmt, 's', $username);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $exists = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    return $exists;
}

/* ------------------- Game ------------------- */
function getGames($conn) {
    $r = mysqli_query($conn, "SELECT id, title, platform, quantity, price FROM games ORDER BY id DESC");
    return mysqli_fetch_all($r, MYSQLI_ASSOC);
}

function getGame($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT id, title, platform, quantity, price FROM games WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row;
}

function addGame($conn, $title, $platform, $quantity, $price, $staffId) {
    $stmt = mysqli_prepare($conn,
        "INSERT INTO games (title, platform, quantity, price, staff_id) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssidi', $title, $platform, $quantity, $price, $staffId);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function updateGame($conn, $id, $title, $platform, $quantity, $price) {
    $stmt = mysqli_prepare($conn,
        "UPDATE games SET title = ?, platform = ?, quantity = ?, price = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ssidi', $title, $platform, $quantity, $price, $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function deleteGame($conn, $id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM games WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function searchGames($conn, $term) {
    $like = '%' . $term . '%';
    $stmt = mysqli_prepare($conn,
        "SELECT id, title, platform, quantity, price FROM games
         WHERE title LIKE ? OR platform LIKE ?
         ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, 'ss', $like, $like);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $rows;
}
?>
