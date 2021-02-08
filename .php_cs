<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2'                                     => true,
        'array_syntax'                              => ['syntax' => 'short'],
        'combine_consecutive_unsets'                => true,
        'class_attributes_separation'               => false,
        'multiline_whitespace_before_semicolons'    => true,
        'single_quote'                              => true,
        'binary_operator_spaces' => [
            'default' => 'align_single_space_minimal',
        ],
        'blank_line_after_opening_tag'  => true,
        'blank_line_before_statement'   => true,
        'braces'                        => [
            'allow_single_line_closure' => true,
        ],
        'cast_spaces'               => true,
        'class_definition'          => ['singleLine' => true],
        'concat_space'              => ['spacing' => 'one'],
        'declare_equal_normalize'   => true,
        'function_typehint_space'   => true,
        'single_line_comment_style' => true,
        'include'                   => true,
        'lowercase_cast'            => true,
        'ordered_imports' => [
            'sortAlgorithm' => 'alpha'
        ],
        'no_extra_blank_lines' => [
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ],
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_spaces_around_offset' => true,
        'no_unused_imports'                    => true,
        'no_whitespace_before_comma_in_array'    => true,
        'no_whitespace_in_blank_line'            => true,
        'object_operator_without_whitespace' => true,
        'single_blank_line_before_namespace' => true,
        'ternary_operator_spaces' => true,
        'trim_array_spaces'               => true,
        'unary_operator_spaces'           => true,
        'whitespace_after_comma_in_array' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude([
                'vendor',
                'node_modules',
                'bootstrap',
                'storage/framework',
            ])
            ->notName('*.md')
            ->notName('*.xml')
            ->notName('*.yml')
            ->notName('*.lock')
    );