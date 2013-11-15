<?php
	/**
	 * QProgressbarGen File
	 * 
	 * The abstract QProgressbarGen class defined here is
	 * code-generated and contains options, events and methods scraped from the
	 * JQuery UI documentation Web site. It is not generated by the typical
	 * codegen process, but rather is generated periodically by the core QCubed
	 * team and checked in. However, the code to generate this file is
	 * in the assets/_core/php/_devetools/jquery_ui_gen/jq_control_gen.php file
	 * and you can regenerate the files if you need to.
	 *
	 * The comments in this file are taken from the JQuery UI site, so they do
	 * not always make sense with regard to QCubed. They are simply provided
	 * as reference. Note that this is very low-level code, and does not always
	 * update QCubed state variables. See the QProgressbarBase 
	 * file, which contains code to interface between this generated file and QCubed.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the QProgressbar class file.
	 *
	 */

	/* Custom event classes for this control */
	
	
	/**
	 * Triggered when the value of the progressbar
	 * 		changes.<ul><li><strong>event</strong> Type: <a>Event</a> </li>
	 * 		<li><strong>ui</strong> Type: <a>Object</a> </li></ul><p><em>Note: The
	 * 		<code>ui</code> object is empty but included for consistency with other
	 * 		events.</em></p>
	 */
	class QProgressbar_ChangeEvent extends QJqUiEvent {
		const EventName = 'progressbarchange';
	}
	/**
	 * Triggered when the value of the progressbar reaches the maximum
	 * 		value.<ul><li><strong>event</strong> Type: <a>Event</a> </li>
	 * 		<li><strong>ui</strong> Type: <a>Object</a> </li></ul><p><em>Note: The
	 * 		<code>ui</code> object is empty but included for consistency with other
	 * 		events.</em></p>
	 */
	class QProgressbar_CompleteEvent extends QJqUiEvent {
		const EventName = 'progressbarcomplete';
	}
	/**
	 * Triggered when the progressbar is created.<ul><li><strong>event</strong>
	 * 		Type: <a>Event</a> </li> <li><strong>ui</strong> Type: <a>Object</a>
	 * 		</li></ul><p><em>Note: The <code>ui</code> object is empty but included for
	 * 		consistency with other events.</em></p>
	 */
	class QProgressbar_CreateEvent extends QJqUiEvent {
		const EventName = 'progressbarcreate';
	}

	/* Custom "property" event classes for this control */

	/**
	 * Generated QProgressbarGen class.
	 * 
	 * This is the QProgressbarGen class which is automatically generated
	 * by scraping the JQuery UI documentation website. As such, it includes all the options
	 * as listed by the JQuery UI website, which may or may not be appropriate for QCubed. See
	 * the QProgressbarBase class for any glue code to make this class more
	 * usable in QCubed.
	 * 
	 * @see QProgressbarBase
	 * @package Controls\Base
	 * @property boolean $Disabled Disables the progressbar if set to <code>true</code>.
	 * @property integer $Max The maximum value of the progressbar.
	 * @property mixed $Value The value of the progressbar.<strong>Multiple types
	 * 		supported:</strong><ul><li><strong>Number</strong>:  					A value between
	 * 		<code>0</code> and the <a><code>max</code></a>.</li>
	 * 		<li><strong>Boolean</strong>:  					Value can be set to <code>false</code>
	 * 		to create an indeterminate progressbar.</li></ul>
	 */

	class QProgressbarGen extends QPanel	{
		protected $strJavaScripts = __JQUERY_EFFECTS__;
		protected $strStyleSheets = __JQUERY_CSS__;
		/** @var boolean */
		protected $blnDisabled = null;
		/** @var integer */
		protected $intMax = null;
		/** @var mixed */
		protected $mixValue;
		
		protected function makeJsProperty($strProp, $strKey) {
			$objValue = $this->$strProp;
			if (null === $objValue) {
				return '';
			}

			return $strKey . ': ' . JavaScriptHelper::toJsObject($objValue) . ', ';
		}

		protected function makeJqOptions() {
			$strJqOptions = '';
			$strJqOptions .= $this->makeJsProperty('Disabled', 'disabled');
			$strJqOptions .= $this->makeJsProperty('Max', 'max');
			$strJqOptions .= $this->makeJsProperty('Value', 'value');
			if ($strJqOptions) $strJqOptions = substr($strJqOptions, 0, -2);
			return $strJqOptions;
		}

		public function getJqSetupFunction() {
			return 'progressbar';
		}

		public function GetControlJavaScript() {
			return sprintf('jQuery("#%s").%s({%s})', $this->getJqControlId(), $this->getJqSetupFunction(), $this->makeJqOptions());
		}

		public function GetEndScript() {
			$str = '';
			if ($this->getJqControlId() !== $this->ControlId) {
				// #845: if the element receiving the jQuery UI events is different than this control
				// we need to clean-up the previously attached event handlers, so that they are not duplicated 
				// during the next ajax update which replaces this control.
				$str = sprintf('jQuery("#%s").off(); ', $this->getJqControlId());
			}
			$str .= $this->GetControlJavaScript();
			if ($strParentScript = parent::GetEndScript()) {
				$str .= '; ' . $strParentScript;
			}
			return $str;
		}
		
		/**
		 * Call a JQuery UI Method on the object. 
		 * 
		 * A helper function to call a jQuery UI Method. Takes variable number of arguments.
		 *
		 * @param boolean $blnAttribute true if the method is modifying an option, false if executing a command
		 * @param string $strMethodName the method name to call
		 * @internal param $mixed [optional] $mixParam1
		 * @internal param $mixed [optional] $mixParam2
		 */
		protected function CallJqUiMethod($blnAttribute, $strMethodName /*, ... */) {
			$args = func_get_args();
			array_shift ($args);

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").%s(%s)',
				$this->getJqControlId(),
				$this->getJqSetupFunction(),
				substr($strArgs, 1, strlen($strArgs)-2));	// params without brackets
			if ($blnAttribute) {
				$this->AddAttributeScript($strJs);
			} else {
				QApplication::ExecuteJavaScript($strJs);
			}
		}


		/**
		 * Removes the progressbar functionality completely. This will return the
		 * element back to its pre-init state.<ul><li>This method does not accept any
		 * arguments.</li></ul>
		 */
		public function Destroy() {
			$this->CallJqUiMethod(false, "destroy");
		}
		/**
		 * Disables the progressbar.<ul><li>This method does not accept any
		 * arguments.</li></ul>
		 */
		public function Disable() {
			$this->CallJqUiMethod(false, "disable");
		}
		/**
		 * Enables the progressbar.<ul><li>This method does not accept any
		 * arguments.</li></ul>
		 */
		public function Enable() {
			$this->CallJqUiMethod(false, "enable");
		}
		/**
		 * Gets the value currently associated with the specified
		 * <code>optionName</code>.<ul><li><strong>optionName</strong> Type:
		 * <a>String</a> The name of the option to get.</li></ul>
		 * @param $optionName
		 */
		public function Option($optionName) {
			$this->CallJqUiMethod(false, "option", $optionName);
		}
		/**
		 * Gets an object containing key/value pairs representing the current
		 * progressbar options hash.<ul><li>This signature does not accept any
		 * arguments.</li></ul>
		 */
		public function Option1() {
			$this->CallJqUiMethod(false, "option");
		}
		/**
		 * Sets the value of the progressbar option associated with the specified
		 * <code>optionName</code>.<ul><li><strong>optionName</strong> Type:
		 * <a>String</a> The name of the option to set.</li>
		 * <li><strong>value</strong> Type: <a>Object</a> A value to set for the
		 * option.</li></ul>
		 * @param $optionName
		 * @param $value
		 */
		public function Option2($optionName, $value) {
			$this->CallJqUiMethod(false, "option", $optionName, $value);
		}
		/**
		 * Sets one or more options for the
		 * progressbar.<ul><li><strong>options</strong> Type: <a>Object</a> A map of
		 * option-value pairs to set.</li></ul>
		 * @param $options
		 */
		public function Option3($options) {
			$this->CallJqUiMethod(false, "option", $options);
		}
		/**
		 * Gets the current value of the progressbar.<ul><li>This signature does not
		 * accept any arguments.</li></ul>
		 */
		public function Value() {
			$this->CallJqUiMethod(false, "value");
		}
		/**
		 * Sets the current value of the progressbar.<ul><li><strong>value</strong>
		 * Type: <a>Number</a> or <a>Boolean</a> The value to set. See the
		 * <a><code>value</code></a> option for details on valid values.</li></ul>
		 * @param $value
		 */
		public function Value1($value) {
			$this->CallJqUiMethod(false, "value", $value);
		}


		public function __get($strName) {
			switch ($strName) {
				case 'Disabled': return $this->blnDisabled;
				case 'Max': return $this->intMax;
				case 'Value': return $this->mixValue;
				default: 
					try { 
						return parent::__get($strName); 
					} catch (QCallerException $objExc) { 
						$objExc->IncrementOffset(); 
						throw $objExc; 
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'Disabled':
					try {
						$this->blnDisabled = QType::Cast($mixValue, QType::Boolean);
						if ($this->OnPage) {
							$this->CallJqUiMethod(true, 'option', 'disabled', $this->blnDisabled);
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Max':
					try {
						$this->intMax = QType::Cast($mixValue, QType::Integer);
						if ($this->OnPage) {
							$this->CallJqUiMethod(true, 'option', 'max', $this->intMax);
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Value':
					$this->mixValue = $mixValue;
				
					if ($this->OnPage) {
						$this->CallJqUiMethod(true, 'option', 'value', $mixValue);
					}
					break;


				case 'Enabled':
					$this->Disabled = !$mixValue;	// Tie in standard QCubed functionality
					parent::__set($strName, $mixValue);
					break;
					
				default:
					try {
						parent::__set($strName, $mixValue);
						break;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

?>
