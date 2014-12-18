<?php
/**
 * Date and Time Locale object
 *
 * @package WordPress
 * @subpackage i18n
 */

/**
 * Class that loads the calendar locale.
 *
 * @since 2.1.0
 */
class WP_Locale {
	/**
	 * Stores the translated strings for the full weekday names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $weekday;

	/**
	 * Stores the translated strings for the one character weekday names.
	 *
	 * There is a hack to make sure that Antradienis and Ketvirtadienis, as well
	 * as Sekmadienis and Šeštadienis don't conflict. See init() method for more.
	 *
	 * @see WP_Locale::init() for how to handle the hack.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $weekday_initial;

	/**
	 * Stores the translated strings for the abbreviated weekday names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $weekday_abbrev;

	/**
	 * Stores the translated strings for the full month names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $month;

	/**
	 * Stores the translated strings for the abbreviated month names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $month_abbrev;

	/**
	 * Stores the translated strings for 'am' and 'pm'.
	 *
	 * Also the capalized versions.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $meridiem;

	/**
	 * The text direction of the locale language.
	 *
	 * Default is left to right 'ltr'.
	 *
	 * @since 2.1.0
	 * @var string
	 * @access private
	 */
	var $text_direction = 'ltr';

	/**
	 * Imports the global version to the class property.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $locale_vars = array('text_direction');

	/**
	 * Sets up the translated strings and object properties.
	 *
	 * The method creates the translatable strings for various
	 * calendar elements. Which allows for specifying locale
	 * specific calendar names and text direction.
	 *
	 * @since 2.1.0
	 * @access private
	 */
	function init() {
		// The Weekdays
		$this->weekday[0] = /* translators: weekday */ __('Sekmadienis');
		$this->weekday[1] = /* translators: weekday */ __('Pirmadienis');
		$this->weekday[2] = /* translators: weekday */ __('Antradienis');
		$this->weekday[3] = /* translators: weekday */ __('Trečiadienis');
		$this->weekday[4] = /* translators: weekday */ __('Ketvirtadienis');
		$this->weekday[5] = /* translators: weekday */ __('Penktadienis');
		$this->weekday[6] = /* translators: weekday */ __('Šeštadienis');

		// The first letter of each day.  The _%day%_initial suffix is a hack to make
		// sure the day initials are unique.
		$this->weekday_initial[__('Sekmadienis')]    = /* translators: one-letter abbreviation of the weekday */ __('S_Sekmadienis_initial');
		$this->weekday_initial[__('Pirmadienis')]    = /* translators: one-letter abbreviation of the weekday */ __('M_Pirmadienis_initial');
		$this->weekday_initial[__('Antradienis')]   = /* translators: one-letter abbreviation of the weekday */ __('T_Antradienis_initial');
		$this->weekday_initial[__('Trečiadienis')] = /* translators: one-letter abbreviation of the weekday */ __('W_Trečiadienis_initial');
		$this->weekday_initial[__('Ketvirtadienis')]  = /* translators: one-letter abbreviation of the weekday */ __('T_Ketvirtadienis_initial');
		$this->weekday_initial[__('Penktadienis')]    = /* translators: one-letter abbreviation of the weekday */ __('F_Penktadienis_initial');
		$this->weekday_initial[__('Šeštadienis')]  = /* translators: one-letter abbreviation of the weekday */ __('S_Šeštadienis_initial');

		foreach ($this->weekday_initial as $weekday_ => $weekday_initial_) {
			$this->weekday_initial[$weekday_] = preg_replace('/_.+_initial$/', '', $weekday_initial_);
		}

		// Abbreviations for each day.
		$this->weekday_abbrev[__('Sekmadienis')]    = /* translators: three-letter abbreviation of the weekday */ __('Sun');
		$this->weekday_abbrev[__('Pirmadienis')]    = /* translators: three-letter abbreviation of the weekday */ __('Mon');
		$this->weekday_abbrev[__('Antradienis')]   = /* translators: three-letter abbreviation of the weekday */ __('Tue');
		$this->weekday_abbrev[__('Trečiadienis')] = /* translators: three-letter abbreviation of the weekday */ __('Wed');
		$this->weekday_abbrev[__('Ketvirtadienis')]  = /* translators: three-letter abbreviation of the weekday */ __('Thu');
		$this->weekday_abbrev[__('Penktadienis')]    = /* translators: three-letter abbreviation of the weekday */ __('Fri');
		$this->weekday_abbrev[__('Šeštadienis')]  = /* translators: three-letter abbreviation of the weekday */ __('Sat');

		// The Months
		$this->month['01'] = /* translators: month name */ __('Sausis');
		$this->month['02'] = /* translators: month name */ __('Vasaris');
		$this->month['03'] = /* translators: month name */ __('Kovas');
		$this->month['04'] = /* translators: month name */ __('Balandis');
		$this->month['05'] = /* translators: month name */ __('Gegužė');
		$this->month['06'] = /* translators: month name */ __('Birželis');
		$this->month['07'] = /* translators: month name */ __('Liepa');
		$this->month['08'] = /* translators: month name */ __('Rugpjūtis');
		$this->month['09'] = /* translators: month name */ __('Rugsėjis');
		$this->month['10'] = /* translators: month name */ __('Spalis');
		$this->month['11'] = /* translators: month name */ __('Lapkritis');
		$this->month['12'] = /* translators: month name */ __('Gruodis');

		// Abbreviations for each month. Uses the same hack as above to get around the
		// 'Gegužė' duplication.
		$this->month_abbrev[__('Sausis')] = /* translators: three-letter abbreviation of the month */ __('Jan_Sausis_abbreviation');
		$this->month_abbrev[__('Vasaris')] = /* translators: three-letter abbreviation of the month */ __('Feb_Vasaris_abbreviation');
		$this->month_abbrev[__('Kovas')] = /* translators: three-letter abbreviation of the month */ __('Mar_Kovas_abbreviation');
		$this->month_abbrev[__('Balandis')] = /* translators: three-letter abbreviation of the month */ __('Apr_Balandis_abbreviation');
		$this->month_abbrev[__('Gegužė')] = /* translators: three-letter abbreviation of the month */ __('Gegužė_Gegužė_abbreviation');
		$this->month_abbrev[__('Birželis')] = /* translators: three-letter abbreviation of the month */ __('Jun_Birželis_abbreviation');
		$this->month_abbrev[__('Liepa')] = /* translators: three-letter abbreviation of the month */ __('Jul_Liepa_abbreviation');
		$this->month_abbrev[__('Rugpjūtis')] = /* translators: three-letter abbreviation of the month */ __('Aug_Rugpjūtis_abbreviation');
		$this->month_abbrev[__('Rugsėjis')] = /* translators: three-letter abbreviation of the month */ __('Sep_Rugsėjis_abbreviation');
		$this->month_abbrev[__('Spalis')] = /* translators: three-letter abbreviation of the month */ __('Oct_Spalis_abbreviation');
		$this->month_abbrev[__('Lapkritis')] = /* translators: three-letter abbreviation of the month */ __('Nov_Lapkritis_abbreviation');
		$this->month_abbrev[__('Gruodis')] = /* translators: three-letter abbreviation of the month */ __('Dec_Gruodis_abbreviation');

		foreach ($this->month_abbrev as $month_ => $month_abbrev_) {
			$this->month_abbrev[$month_] = preg_replace('/_.+_abbreviation$/', '', $month_abbrev_);
		}

		// The Meridiems
		$this->meridiem['am'] = __('am');
		$this->meridiem['pm'] = __('pm');
		$this->meridiem['AM'] = __('AM');
		$this->meridiem['PM'] = __('PM');

		// Numbers formatting
		// See http://php.net/number_format

		/* translators: $thousands_sep argument for http://php.net/number_format, default is , */
		$trans = __('number_format_thousands_sep');
		$this->number_format['thousands_sep'] = ('number_format_thousands_sep' == $trans) ? ',' : $trans;

		/* translators: $dec_point argument for http://php.net/number_format, default is . */
		$trans = __('number_format_decimal_point');
		$this->number_format['decimal_point'] = ('number_format_decimal_point' == $trans) ? '.' : $trans;

		// Import global locale vars set during inclusion of $locale.php.
		foreach ( (array) $this->locale_vars as $var ) {
			if ( isset($GLOBALS[$var]) )
				$this->$var = $GLOBALS[$var];
		}

	}

	/**
	 * Retrieve the full translated weekday word.
	 *
	 * Week starts on translated Sekmadienis and can be fetched
	 * by using 0 (zero). So the week starts with 0 (zero)
	 * and ends on Šeštadienis with is fetched by using 6 (six).
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param int $weekday_number 0 for Sekmadienis through 6 Šeštadienis
	 * @return string Full translated weekday
	 */
	function get_weekday($weekday_number) {
		return $this->weekday[$weekday_number];
	}

	/**
	 * Retrieve the translated weekday initial.
	 *
	 * The weekday initial is retrieved by the translated
	 * full weekday word. When translating the weekday initial
	 * pay attention to make sure that the starting letter does
	 * not conflict.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $weekday_name
	 * @return string
	 */
	function get_weekday_initial($weekday_name) {
		return $this->weekday_initial[$weekday_name];
	}

	/**
	 * Retrieve the translated weekday abbreviation.
	 *
	 * The weekday abbreviation is retrieved by the translated
	 * full weekday word.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $weekday_name Full translated weekday word
	 * @return string Translated weekday abbreviation
	 */
	function get_weekday_abbrev($weekday_name) {
		return $this->weekday_abbrev[$weekday_name];
	}

	/**
	 * Retrieve the full translated month by month number.
	 *
	 * The $month_number parameter has to be a string
	 * because it must have the '0' in front of any number
	 * that is less than 10. Starts from '01' and ends at
	 * '12'.
	 *
	 * You can use an integer instead and it will add the
	 * '0' before the numbers less than 10 for you.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string|int $month_number '01' through '12'
	 * @return string Translated full month name
	 */
	function get_month($month_number) {
		return $this->month[zeroise($month_number, 2)];
	}

	/**
	 * Retrieve translated version of month abbreviation string.
	 *
	 * The $month_name parameter is expected to be the translated or
	 * translatable version of the month.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $month_name Translated month to get abbreviated version
	 * @return string Translated abbreviated month
	 */
	function get_month_abbrev($month_name) {
		return $this->month_abbrev[$month_name];
	}

	/**
	 * Retrieve translated version of meridiem string.
	 *
	 * The $meridiem parameter is expected to not be translated.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $meridiem Either 'am', 'pm', 'AM', or 'PM'. Not translated version.
	 * @return string Translated version
	 */
	function get_meridiem($meridiem) {
		return $this->meridiem[$meridiem];
	}

	/**
	 * Global variables are deprecated. For backwards compatibility only.
	 *
	 * @deprecated For backwards compatibility only.
	 * @access private
	 *
	 * @since 2.1.0
	 */
	function register_globals() {
		$GLOBALS['weekday']         = $this->weekday;
		$GLOBALS['weekday_initial'] = $this->weekday_initial;
		$GLOBALS['weekday_abbrev']  = $this->weekday_abbrev;
		$GLOBALS['month']           = $this->month;
		$GLOBALS['month_abbrev']    = $this->month_abbrev;
	}

	/**
	 * PHP4 style constructor which calls helper methods to set up object variables
	 *
	 * @uses WP_Locale::init()
	 * @uses WP_Locale::register_globals()
	 * @since 2.1.0
	 *
	 * @return WP_Locale
	 */
	function WP_Locale() {
		$this->init();
		$this->register_globals();
	}
	/**
	 * Checks if current locale is RTL.
	 *
	 * @since 3.0.0
	 * @return bool Whether locale is RTL.
	 */
	 function is_rtl() {
	 	return 'rtl' == $this->text_direction;
	 }
}

/**
 * Checks if current locale is RTL.
 *
 * @since 3.0.0
 * @return bool Whether locale is RTL.
 */
function is_rtl() {
	global $wp_locale;
	return $wp_locale->is_rtl();
}

?>
