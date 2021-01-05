<?php
/**
 * Clase para manejar variables de sesión.
 */
class Session
{    
    /**
     * Iniciar la sesión.
     */
    public static function start()
    {
        session_start();
    }
    
    /**
     * Obtener una variable de sesión.
     * @param string $key Nombre de la variable.
     * @param string $subkey Si $key es un array, $subkey es un índice de $key.
     * @return mixed
     */
    public static function get($key, $subkey=null)
    {
        if ($subkey === null) {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }            
        } else {
            if (is_array($_SESSION[$key])) {
                return $_SESSION[$key][$subkey];
            }            
        }        
        return null;
    }
    
    /**
     * Asignar una variable de sesión.
     * @param string $key Nombre de la variable.
     * @param mixed $value Valor de la variable.
     * @param string $subkey Si $key es un array, $subkey es un índice de $key.
     */
    public static function set($key, $value, $subkey=null)
    {
        if ($subkey === null) {
            $_SESSION[$key] = $value;
        } else {
            if (!is_array($_SESSION[$key])) {
                $_SESSION[$key] = array();
            }            
            $_SESSION[$key][$subkey] = $value;
        }
    }
    
    /**
     * Eliminar una variable de sesión.
     * @param string $key Nombre de la variable.
     * @param string $subkey Si $key es un array, $subkey es un índice de $key.
     */
    public static function destroy($key, $subkey=null)
    {
        if ($subkey === null) {
            unset($_SESSION[$key]);    
        } else {
            if (is_array($_SESSION[$key])) {
                unset($_SESSION[$key][$subkey]);    
            }            
        }       
    }
    
    /**
     * Verificar si existe una variable de sesión.
     * @param string $key Nombre de la variable.
     * @param string $subkey Si $key es un array, $subkey es un índice de $key.
     * @return boolean
     */
    public static function has($key, $subkey=null)
    {
        if ($subkey === null) {
            return !is_null(self::get($key));
        } else {
            if (is_array($_SESSION[$key])) {
                return !is_null(self::get($key, $subkey));
            }            
        }  
        return false;
    }
    
    public static function debug()
    {
        print '<pre>';
        var_dump($_SESSION);
        print '</pre>';
    }
}
