<?php
/**
 * Session Handler berbasis Database MySQL
 */

require_once __DIR__ . '/Koneksi.php';

// Buat tabel sessions jika belum ada
$createTable = "CREATE TABLE IF NOT EXISTS `sessions` (
    `id` VARCHAR(128) NOT NULL PRIMARY KEY,
    `data` TEXT NOT NULL,
    `last_access` INT UNSIGNED NOT NULL,
    INDEX (`last_access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
@mysqli_query($conn, $createTable);

// Custom session handler
if (!class_exists('DbSessionHandler')) {
    class DbSessionHandler implements SessionHandlerInterface
    {
        private $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function open($savePath, $sessionName): bool
        {
            return true;
        }

        public function close(): bool
        {
            return true;
        }

        public function read($id): string|false
        {
            $stmt = mysqli_prepare($this->conn, "SELECT `data` FROM `sessions` WHERE `id` = ?");
            if (!$stmt) return '';
            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return $row ? $row['data'] : '';
        }

        public function write($id, $data): bool
        {
            $time = time();
            $stmt = mysqli_prepare(
                $this->conn,
                "REPLACE INTO `sessions` (`id`, `data`, `last_access`) VALUES (?, ?, ?)"
            );
            if (!$stmt) return false;
            mysqli_stmt_bind_param($stmt, 'ssi', $id, $data, $time);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }

        public function destroy($id): bool
        {
            $stmt = mysqli_prepare($this->conn, "DELETE FROM `sessions` WHERE `id` = ?");
            if (!$stmt) return false;
            mysqli_stmt_bind_param($stmt, 's', $id);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }

        public function gc($maxlifetime): int|false
        {
            $old = time() - $maxlifetime;
            $stmt = mysqli_prepare($this->conn, "DELETE FROM `sessions` WHERE `last_access` < ?");
            if (!$stmt) return false;
            mysqli_stmt_bind_param($stmt, 'i', $old);
            mysqli_stmt_execute($stmt);
            $affected = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $affected;
        }
    }
}

// Daftarkan handler dan mulai session jika belum dimulai
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    $handler = new DbSessionHandler($conn);
    session_set_save_handler($handler, true);

    if (getenv('DB_HOST') && getenv('DB_HOST') !== 'localhost') {
        session_set_cookie_params([
            'lifetime' => 86400,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }

    session_start();
}
