<?php

	namespace Publixe\XML;
	use Publixe;


/**
 * DOM Document derivate with extra methods:
 *	- getElementByClassName()
 * 	- getInnerHTML()
 *
 * @author	Pavex
 */
	class DOMDocument extends \DOMDocument
	{





/**
 * @param Array<Element>
 * @param Element
 * @param string
 */
		private function findElementByClass(&$elements, $element, $className)
		{
			if (isset($element -> tagName)) {
				$class = $element -> getAttribute('class');
				if ($class == $className) {
					$elements[] = $element;
					return;
				}
				if ($element -> hasChildNodes()) {
					foreach ($element -> childNodes as $child) {
						$this -> findElementByClass($elements, $child, $className);
					}
				}
			}
		}





/**
 * @param string
 * @return Array<Element>
 */
		public function getElementByClassName($className)
		{
			$elements = [];
			$this -> findElementByClass($elements, $this -> documentElement, $className);
			return $elements;
		}





/**
 * Great tip from Haim Evgi
 * https://stackoverflow.com/questions/2087103/how-to-get-innerhtml-of-domnode
 * @param DOMNode
 * @return string
 */
		public static function innerHTML($element)
		{
			$html = ''; 
			$children = $element -> childNodes;
			foreach ($children as $child) { 
				$html .= $element -> ownerDocument -> saveHTML($child);
			}
			return $html;
		}





	}
