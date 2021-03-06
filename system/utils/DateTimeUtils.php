<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/23 0023
 * Time: 16:51
 *
 * example:
 * DateTimeUtils::getFormatDate();
 * DateTimeUtils::getFormatDateQuote();
 * DateTimeUtils::getFormatTime();
 * DateTimeUtils::getFormatTimeQuote();
 * DateTimeUtils::getWeekOfEn();
 * DateTimeUtils::getWeekOfCn();
 * DateTimeUtils::getWeekN();
 * DateTimeUtils::getDayOfYear();
 * DateTimeUtils::getDayOfMonth();
 * DateTimeUtils::getYear();
 * DateTimeUtils::getMonth();
 * DateTimeUtils::getDay();
 * DateTimeUtils::getHour();
 * DateTimeUtils::getMinute();
 * DateTimeUtils::getSecond();
 *
 */

namespace App\System\Utils;


use App\System\Basic\CompactUtils;

class DateTimeUtils extends CompactUtils
{
    const DATETIME_FULL_QUOTE = "Y-m-d H:i:s";
    const DATETIME_DATE_QUOTE = "Y-m-d";
    const DATETIME_TIME_QUOTE = "H:i:s";

    const DATETIME_FULL = "YmdHis";
    const DATETIME_DATE = "Ymd";
    const DATETIME_TIME = "His";

    const DATETIME_WEEK_L = "l";
    const DATETIME_WEEK_N = "N";
    const DATETIME_WEEK_W = "W";

    protected static $weeks = [
        1 => '星期一',
        2 => '星期二',
        3 => '星期三',
        4 => '星期四',
        5 => '星期五',
        6 => '星期六',
        7 => '星期日',
    ];

    /**
     * @return int
     */
    public static function getTime(){
        return time() - date('Z');
    }

    /**
     * @param int $time
     * @param string $format
     * @return string
     */
    public static function formatTime($time = 0,$format = self::DATETIME_FULL_QUOTE) {
        static::checkTime($time);
        return date($format, $time + date('Z'));
    }

    /**
     * @param string $strTime
     * @return int
     */
    public static function strToTime($strTime = "") {
        if(TextUtils::isEmpty($strTime)){
            return self::getTime();
        }

        $time = strtotime($strTime);

        return $time > (int)date('Z') ? $time - (int)date('Z') : $time;
    }

    /**
     * @param int $time
     * @param string $format
     * @return string
     */
    public static function getFormatDate($time = 0,$format = self::DATETIME_DATE) {
        static::checkTime($time);
        return self::formatTime($time,$format);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getFormatDateQuote($time = 0) {
        return self::getFormatDate($time,self::DATETIME_DATE_QUOTE);
    }

    /**
     * @param int $time
     * @param string $format
     * @return string
     */
    public static function getFormatTime($time = 0,$format = self::DATETIME_TIME) {
        static::checkTime($time);
        return self::formatTime($time,$format);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getFormatTimeQuote($time = 0) {
        return self::getFormatTime($time,self::DATETIME_TIME_QUOTE);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getWeekOfEn($time = 0) {
        static::checkTime($time);
        return self::formatTime($time,self::DATETIME_WEEK_L);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getWeekN($time = 0) {
        static::checkTime($time);
        return self::formatTime($time,self::DATETIME_WEEK_N);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getWeekOfCn($time = 0) {
        static::checkTime($time);
        return static::$weeks[self::formatTime($time,self::DATETIME_WEEK_N)];
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getWeekOfYear($time = 0) {
        static::checkTime($time);
        return self::formatTime($time,self::DATETIME_WEEK_W);
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getDayOfYear($time = 0){
        static::checkTime($time);
        return self::formatTime($time,"z");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getDayOfMonth($time = 0){
        static::checkTime($time);
        return self::formatTime($time,"d");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getYear($time = 0){
        static::checkTime($time);
        return self::formatTime($time,"Y");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getMonth($time = 0) {
        static::checkTime($time);
        return self::formatTime($time,"m");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getDay($time = 0) {
        static::checkTime($time);
        return self::formatTime($time,"d");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getHour($time = 0){
        static::checkTime($time);
        return self::formatTime($time,"H");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getMinute($time = 0){
        static::checkTime($time);
        return self::formatTime($time,"i");
    }

    /**
     * @param int $time
     * @return string
     */
    public static function getSecond($time = 0){
        static::checkTime($time);
        return self::formatTime($time,"s");
    }

    /**
     * @param int $time
     */
    protected static function checkTime(&$time){
        if ($time <= 0){
            $time = self::getTime();
        }
    }

}