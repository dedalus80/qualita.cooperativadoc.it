<?php
/**
 * Helper per la formattazione delle date nel formato italiano con fuso orario locale
 */
class DateTimeHelper
{
    /**
     * Formatta una data UTC nel formato italiano con fuso orario locale
     * @param string $utcDateTime
     * @param string $format Formato personalizzato (opzionale)
     * @return string
     */
    public static function formatItalian($utcDateTime, $format = null)
    {
        if (!$utcDateTime) {
            return '-';
        }
        
        // Imposta il fuso orario italiano
        //$timezone = new DateTimeZone('Europe/Rome');
        
        // Crea un oggetto DateTime dalla data UTC
        $date = new DateTime($utcDateTime, new DateTimeZone('UTC'));
        
        // Converte nel fuso orario italiano
        //$date->setTimezone($timezone);
        
        // Usa il formato personalizzato se fornito, altrimenti usa quello di default
        $defaultFormat = 'd/m/Y H:i:s';
        $finalFormat = $format ?: $defaultFormat;
        
        // Formatta nel formato richiesto
        return $date->format($finalFormat);
    }
    
    /**
     * Formatta una data UTC nel formato italiano breve (solo data)
     * @param string $utcDateTime
     * @return string
     */
    public static function formatItalianDate($utcDateTime)
    {
        return self::formatItalian($utcDateTime, 'd/m/Y');
    }
    
    /**
     * Formatta una data UTC nel formato italiano con ora (senza secondi)
     * @param string $utcDateTime
     * @return string
     */
    public static function formatItalianDateTime($utcDateTime)
    {
        return self::formatItalian($utcDateTime, 'd/m/Y H:i');
    }
    
    /**
     * Formatta una data UTC nel formato italiano completo (con secondi)
     * @param string $utcDateTime
     * @return string
     */
    public static function formatItalianDateTimeFull($utcDateTime)
    {
        return self::formatItalian($utcDateTime, 'd/m/Y H:i:s');
    }
} 