<?php
class Session {
    private static $started = false;

    public static function start(): void {
        if (!self::$started) {
            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Lax'
            ]);

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            self::$started = true;
        }
    }

    public static function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public static function destroy(): void {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $p = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $p['path'],
                $p['domain'] ?? '',
                $p['secure'] ?? false,
                $p['httponly'] ?? true
            );
        }

        session_destroy();
        self::$started = false;
    }


    public static function isLoggedIn(): bool {
        return isset($_SESSION['tipo']);
    }


    public static function isAdmin(): bool {
        return isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'administrador';
    }


    public static function canManageCidade(): bool {
    return self::isAdmin();
}

}
