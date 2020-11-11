<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Classes\ClassDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Files\SideEffectsSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff;
use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\Basic\Psr4Fixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalInternalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToReturnTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveIssetsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveUnsetsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoTrailingWhitespaceFixer;
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use SlevomatCodingStandard\Sniffs\TypeHints\TypeHintDeclarationSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\CognitiveComplexity\Rules\FunctionLikeCognitiveComplexityRule;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;
use Symplify\CodingStandard\Fixer\Commenting\RemoveSuperfluousDocBlockWhitespaceFixer;
use Symplify\CodingStandard\Fixer\Strict\BlankLineAfterStrictTypesFixer;
use Symplify\CodingStandard\Rules\NoDebugFuncCallRule;
use Symplify\CodingStandard\Sniffs\Debug\CommentedOutCodeSniff;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/clean-code.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/common.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/php70.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/php71.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/psr12.php');

    $services = $containerConfigurator->services();

    $services->set(AddArrayDefaultToArrayPropertyRector::class);

    $services->set(StandaloneLineInMultilineArrayFixer::class);

    $services->set(AbsolutizeRequireAndIncludePathRector::class);

    $services->set(BlankLineAfterStrictTypesFixer::class);

    $services->set(RemoveSuperfluousDocBlockWhitespaceFixer::class);

    $services->set(NoDebugFuncCallRule::class);

    $services->set(CommentedOutCodeSniff::class);

    $services->set(FinalInternalClassFixer::class);

    $services->set(MbStrFunctionsFixer::class);

    $services->set(Psr4Fixer::class);

    $services->set(ClassDeclarationSniff::class);

    $services->set(SideEffectsSniff::class);

    $services->set(CamelCapsMethodNameSniff::class);

    $services->set(LowercaseCastFixer::class);

    $services->set(ShortScalarCastFixer::class);

    $services->set(BlankLineAfterOpeningTagFixer::class);

    $services->set(NoLeadingImportSlashFixer::class);

    $services->set(OrderedImportsFixer::class)
        ->call('configure', [['imports_order' => ['class', 'const', 'function']]]);

    $services->set(DeclareEqualNormalizeFixer::class)
        ->call('configure', [['space' => 'none']]);

    $services->set(NewWithBracesFixer::class);

    $services->set(BracesFixer::class)
        ->call('configure', [['allow_single_line_closure' => false, 'position_after_functions_and_oop_constructs' => 'next', 'position_after_control_structures' => 'same', 'position_after_anonymous_constructs' => 'same']]);

    $services->set(NoBlankLinesAfterClassOpeningFixer::class);

    $services->set(VisibilityRequiredFixer::class)
        ->call('configure', [['elements' => ['const', 'method', 'property']]]);

    $services->set(TernaryOperatorSpacesFixer::class);

    $services->set(ReturnTypeDeclarationFixer::class);

    $services->set(NoTrailingWhitespaceFixer::class);

    $services->set(NoSinglelineWhitespaceBeforeSemicolonsFixer::class);

    $services->set(NoWhitespaceBeforeCommaInArrayFixer::class);

    $services->set(WhitespaceAfterCommaInArrayFixer::class);

    $services->set(CombineConsecutiveIssetsFixer::class);

    $services->set(CombineConsecutiveUnsetsFixer::class);

    $services->set(PhpdocToReturnTypeFixer::class);

    $services->set(FullyQualifiedStrictTypesFixer::class);

    $services->set(NoSuperfluousPhpdocTagsFixer::class);

    $services->set(OrderedClassElementsFixer::class)
        ->call('configure', [['order' => ['use_trait']]]);

    $services->set(BinaryOperatorSpacesFixer::class);

    $services->set(UnaryOperatorSpacesFixer::class);

    $services->set(ConcatSpaceFixer::class)
        ->call('configure', [['spacing' => 'one']]);

    $services->set(BlankLineBeforeStatementFixer::class)
        ->call('configure', [['statements' => ['return']]]);

    $services->set(FunctionLikeCognitiveComplexityRule::class)
        ->property('maximumCognitiveComplexity', 40);

    $services->set(TypeHintDeclarationSniff::class);

    $parameters = $containerConfigurator->parameters();

    $parameters->set('cache_directory', __DIR__ . '/var/cache/ecs');

    $parameters->set('paths', [__DIR__ . '/src', __DIR__ . '/tests']);

    $parameters->set('sets', ['clean-code', 'psr12', 'dead-code']);

    $parameters->set('skip', [AssignmentInConditionSniff::class => null, ClassAttributesSeparationFixer::class => null, OrderedClassElementsFixer::class => null, ConcatSpaceFixer::class => null, IncrementStyleFixer::class => null, UnaryOperatorSpacesFixer::class => null, TernaryToNullCoalescingFixer::class => null, PhpdocAnnotationWithoutDotFixer::class => null, PhpdocSummaryFixer::class => null, NoSuperfluousPhpdocTagsFixer::class => null, PhpUnitMethodCasingFixer::class => null, PhpUnitStrictFixer::class => null, ArrayIndentationFixer::class => null, 'SlevomatCodingStandard\Sniffs\Exceptions\ReferenceThrowableOnlySniff.ReferencedGeneralException' => null, 'SlevomatCodingStandard\Sniffs\TypeHints\TypeHintDeclarationSniff.MissingTraversableParameterTypeHintSpecification' => null, 'SlevomatCodingStandard\Sniffs\TypeHints\TypeHintDeclarationSniff.MissingTraversableReturnTypeHintSpecification' => null]);

    $parameters->set('only', [CamelCapsMethodNameSniff::class => ['src/*']]);
};
