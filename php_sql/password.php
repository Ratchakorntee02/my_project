<?php
function hashPassword($password) {
    return hash('sha512', $password);
}
function verifyPassword($inputPassword, $storedPassword) {
    return hash('sha512', $inputPassword) === $storedPassword;
}
?>
