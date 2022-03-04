<?php

declare(strict_types=1);

/**
 * List of available rules: https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/3.0/doc/rules/index.rst
 */
$rules = [
    '@PSR12' => true,
    '@PHP81Migration' => true,
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => [
            '=' => 'align_single_space_minimal',
            '=>' => 'align_single_space_minimal',
            '|' => 'no_space'
        ],
    ],
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'continue',
            'declare',
            'return',
            'throw',
            'try',
        ],
    ],
    'cast_spaces' => true,
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'one',
            'method' => 'one',
            'property' => 'one',
        ],
    ],
    'class_definition' => ['space_before_parenthesis' => false],
    'concat_space' => ['spacing' => 'none'],
    'declare_strict_types' => true,
    'echo_tag_syntax' => ['format' => 'long'],
    'final_internal_class' => true,
    'fully_qualified_strict_types' => true,
    'function_typehint_space' => true,
    'heredoc_to_nowdoc' => true,
    'include' => true,
    'increment_style' => ['style' => 'pre'],
    'linebreak_after_opening_tag' => true,
    'magic_method_casing' => true,
    'magic_constant_casing' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    'native_function_casing' => true,
    'no_alias_functions' => true,
    'no_blank_lines_after_phpdoc' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra',
            'throw',
            'use',
            'use_trait',
        ],
    ],
    'no_leading_namespace_whitespace' => true,
    'no_mixed_echo_print' => ['use' => 'echo'],
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_short_bool_cast' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_spaces_around_offset' => [
        'positions' => ['inside'],
    ],
    'no_trailing_comma_in_list_call' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_unneeded_control_parentheses' => [
        'statements' => [
            'break',
            'clone',
            'continue',
            'echo_print',
            'return',
            'switch_case',
            'yield',
        ],
    ],
    'no_unreachable_default_argument_value' => true,
    'no_unused_imports' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'no_whitespace_before_comma_in_array' => true,
    'normalize_index_brace' => true,
    'not_operator_with_successor_space' => true,
    'object_operator_without_whitespace' => true,
    'ordered_imports' => [
        'imports_order' => ['class', 'function', 'const'],
        'sort_algorithm' => 'alpha',
    ],
    'php_unit_strict' => true,
    'php_unit_test_class_requires_covers' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_align' => false,
    'phpdoc_indent' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_order' => true,
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'psr_autoloading' => true,
    'self_accessor' => true,
    'semicolon_after_instruction' => true,
    'simplified_null_return' => true,
    'single_class_element_per_statement' => [
        'elements' => [
            'const',
            'property',
        ],
    ],
    'single_line_comment_style' => [
        'comment_types' => ['hash'],
    ],
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'strict_comparison' => true,
    'strict_param' => true,
    'trailing_comma_in_multiline' => [
        'elements' => ['arrays'],
    ],
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,
];

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(getcwd())
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('index.php')
    ->notName('server.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/.php-cs-fixer.cache')
    ->setUsingCache(true);
