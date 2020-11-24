<?php

// based on https://github.com/mailpoet/mailpoet/blob/master/prefixer/fix-twig.php
// at 24.11.2020 for twig v. 3.1.1
// but with additions, like these functions : twig_compare, twig_call_macro, twig_to_array, twig_constant_is_defined

$vendorsNamespace = 'WpThemeBones\\\\Vendors';
$pathToTwig       = __DIR__ . '/../Vendors/vendor/twig';

$replacements = [
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/GetAttrExpression.php',
		'find'    => [
			'\'twig_get_attribute(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_get_attribute(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/NotInBinary.php',
		'find'    => [
			'\'!twig_in_filter(\'',
		],
		'replace' => [
			'\'!\\\\' . $vendorsNamespace . '\\\\twig_in_filter(\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/InBinary.php',
		'find'    => [
			'\'twig_in_filter(\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_in_filter(\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Extension/CoreExtension.php',
		'find'    => [
			'\'twig_date_format_filter\'',
			'\'twig_date_modify_filter\'',
			'\'twig_replace_filter\'',
			'\'twig_number_format_filter\'',
			'\'twig_round\'',
			'\'twig_urlencode_filter\'',
			'\'twig_convert_encoding\'',
			'\'twig_title_string_filter\'',
			'\'twig_capitalize_string_filter\'',
			'\'twig_upper_filter\'',
			'\'twig_lower_filter\'',
			'\'twig_trim_filter\'',
			'\'twig_spaceless\'',
			'\'twig_join_filter\'',
			'\'twig_split_filter\'',
			'\'twig_sort_filter\'',
			'\'twig_array_merge\'',
			'\'twig_array_batch\'',
			'\'twig_array_column\'',
			'\'twig_array_filter\'',
			'\'twig_array_map\'',
			'\'twig_array_reduce\'',
			'\'twig_reverse_filter\'',
			'\'twig_length_filter\'',
			'\'twig_slice\'',
			'\'twig_first\'',
			'\'twig_last\'',
			'\'_twig_default_filter\'',
			'\'twig_get_array_keys_filter\'',
			'\'twig_constant\'',
			'\'twig_cycle\'',
			'\'twig_random\'',
			'\'twig_date_converter\'',
			'\'twig_include\'',
			'\'twig_source\'',
			'\'twig_test_empty\'',
			'\'twig_test_iterable\'',
			'\'twig_compare\'',
			'\'twig_call_macro\'',
			'\'twig_to_array\'',
			'\'twig_constant_is_defined\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_date_format_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_date_modify_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_replace_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_number_format_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_round\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_urlencode_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_convert_encoding\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_title_string_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_capitalize_string_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_upper_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_lower_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_trim_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_spaceless\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_join_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_split_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_sort_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_array_merge\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_array_batch\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_array_column\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_array_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_array_map\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_array_reduce\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_reverse_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_length_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_slice\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_first\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_last\'',
			'\'\\\\' . $vendorsNamespace . '\\\\_twig_default_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_get_array_keys_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_constant\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_cycle\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_random\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_date_converter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_include\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_source\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_test_empty\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_test_iterable\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_call_macro\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_to_array\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_constant_is_defined\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Extension/DebugExtension.php',
		'find'    => [
			'\'twig_var_dump\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_var_dump\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Extension/EscaperExtension.php',
		'find'    => [
			'\'twig_escape_filter\'',
			'\'twig_escape_filter_is_safe\'',
			'\'twig_raw_filter\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_escape_filter\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_escape_filter_is_safe\'',
			'\'\\\\' . $vendorsNamespace . '\\\\twig_raw_filter\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Extension/StringLoaderExtension.php',
		'find'    => [
			'\'twig_template_from_string\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_template_from_string\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/ForNode.php',
		'find'    => [
			'= twig_ensure_traversable("',
		],
		'replace' => [
			'= \\\\' . $vendorsNamespace . '\\\\twig_ensure_traversable("',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/CheckSecurityNode.php',
		'find'    => [
			'\'\\\\Twig\\\\Extension\\\\SandboxExtension\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\Twig\\\\Extension\\\\SandboxExtension\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Environment.php',
		'find'    => [
			'\'\\\\Twig\\\\Template\'',
			'\'Twig\\\\Extension\\\\AbstractExtension\'',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\Twig\\\\Template\'',
			'\'' . $vendorsNamespace . '\\\\Twig\\\\Extension\\\\AbstractExtension\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Token.php',
		'find'    => [
			'\'Twig\\\\Token::\'',
		],
		'replace' => [
			'\'' . $vendorsNamespace . '\\\\Twig\\\\Token::\'',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Profiler/Node/EnterProfileNode.php',
		'find'    => [
			'\\\\Twig\\\\Profiler\\\\Profile',
		],
		'replace' => [
			'\\\\' . $vendorsNamespace . '\\\\Twig\\\\Profiler\\\\Profile',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/ModuleNode.php',
		'find'    => [
			'"use Twig\\\\Environment;',
			'"use Twig\\\\Markup;',
			'"use Twig\\\\Source;',
			'"use Twig\\\\Template;',
			'"use Twig\\\\Error\\\\LoaderError;',
			'"use Twig\\\\Error\\\\RuntimeError;',
			'"use Twig\\\\Sandbox\\\\SecurityError;',
			'"use Twig\\\\Sandbox\\\\SecurityNotAllowedTagError;',
			'"use Twig\\\\Sandbox\\\\SecurityNotAllowedFilterError;',
			'"use Twig\\\\Sandbox\\\\SecurityNotAllowedFunctionError;',
			'"use Twig\\\\Extension\\\\SandboxExtension;',
		],
		'replace' => [
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Environment;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Markup;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Source;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Template;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Error\\\\LoaderError;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Error\\\\RuntimeError;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Sandbox\\\\SecurityError;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Sandbox\\\\SecurityNotAllowedTagError;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Sandbox\\\\SecurityNotAllowedFilterError;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Sandbox\\\\SecurityNotAllowedFunctionError;',
			'"use ' . $vendorsNamespace . '\\\\Twig\\\\Extension\\\\SandboxExtension;',
		],
	],
	//// new
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/NotEqualBinary.php',
		'find'    => [
			'\'twig_compare(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/LessEqualBinary.php',
		'find'    => [
			'\'twig_compare(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/LessBinary.php',
		'find'    => [
			'\'twig_compare(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/GreaterEqualBinary.php',
		'find'    => [
			'\'twig_compare(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/GreaterBinary.php',
		'find'    => [
			'\'twig_compare(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/Binary/EqualBinary.php',
		'find'    => [
			'\'twig_compare(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_compare(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/MethodCallExpression.php',
		'find'    => [
			'\'twig_call_macro(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_call_macro(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/IncludeNode.php',
		'find'    => [
			'\'twig_to_array(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_to_array(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/WithNode.php',
		'find'    => [
			'\'twig_to_array(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_to_array(',
		],
	],
	[
		'file'    => $pathToTwig . '/twig/src/Node/Expression/FunctionExpression.php',
		'find'    => [
			'\'twig_constant_is_defined(',
		],
		'replace' => [
			'\'\\\\' . $vendorsNamespace . '\\\\twig_constant_is_defined(',
		],
	],

];

foreach ( $replacements as $singleFile ) {

	$data = file_get_contents( $singleFile['file'] );
	$data = str_replace( $singleFile['find'], $singleFile['replace'], $data );
	file_put_contents( $singleFile['file'], $data );

}