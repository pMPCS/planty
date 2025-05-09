<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\StarRating",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class StarRating extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'StarIcon';
    }

    static function tag()
    {
        return 'div';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Star Rating';
    }

    static function className()
    {
        return 'bde-star-rating';
    }

    static function category()
    {
        return 'blocks';
    }

    static function badge()
    {
        return false;
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return ['content' => ['components' => ['stars_max' => '5', 'rating' => 3.6, 'icon_type' => 'fontawesome', 'show_label' => true, 'label_text' => 'Star Rating', 'stars' => '5', 'unmarked_style' => null]], 'design' => ['stars' => ['unmarked_color' => null]]];
    }

    static function defaultChildren()
    {
        return false;
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "stars",
        "Stars",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 12, 'max' => 256, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 50, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "stars_color",
        "Stars Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "unmarked_color",
        "Unmarked Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "label",
        "Label",
        [getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Label Typography",
      "label_typography",
       ['type' => 'popout']
     ), c(
        "label_position",
        "Label Position",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'before', 'text' => 'Before'], '1' => ['text' => 'After', 'value' => 'after']]],
        false,
        false,
        [],
      ), c(
        "vertical_layout",
        "Vertical Layout",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline', 'breakpointOptions' => ['enableNever' => true]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => ['path' => 'content.components.show_label', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "spacing",
        "Spacing",
        [getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Wrapper",
      "wrapper",
       ['type' => 'popout']
     ), c(
        "label_spacing",
        "Label Spacing",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px', '1' => 'em', '2' => 'rem', '3' => 'custom'], 'defaultType' => 'px'], 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      )];
    }

    static function contentControls()
    {
        return [c(
        "components",
        "Components",
        [c(
        "stars",
        "Stars",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'rangeOptions' => ['min' => 3, 'max' => 10, 'step' => 'undefined'], 'items' => ['0' => ['text' => 'One', 'value' => '1'], '1' => ['text' => 'Two', 'value' => '2'], '2' => ['text' => 'Three', 'label' => 'Label', 'value' => '3'], '3' => ['text' => 'Four', 'value' => '4'], '4' => ['text' => 'Five', 'value' => '5'], '5' => ['text' => 'Six', 'value' => '6'], '6' => ['text' => 'Seven', 'value' => '7'], '7' => ['text' => 'Eight', 'value' => '8'], '8' => ['text' => 'Nine', 'value' => '9'], '9' => ['text' => 'Ten', 'value' => '10']]],
        false,
        false,
        [],
      ), c(
        "rating",
        "Rating",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 10, 'step' => 0.1], 'items' => ['0' => ['value' => '0', 'text' => '0'], '1' => ['text' => '0.5', 'value' => '0.5'], '2' => ['text' => '1', 'value' => '1'], '3' => ['text' => '1.5', 'value' => '1.5'], '4' => ['text' => '2', 'value' => '2'], '5' => ['text' => '2.5', 'value' => '2.5'], '6' => ['text' => '3', 'value' => 'undefined'], '7' => ['text' => '3.5', 'value' => 'undefined'], '8' => ['text' => '4', 'value' => 'undefined'], '9' => ['text' => '4.5', 'value' => 'undefined'], '10' => ['text' => '5', 'value' => 'undefined']]],
        false,
        false,
        [],
      ), c(
        "icon_type",
        "Icon Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['text' => 'Font Awesome', 'label' => 'Label', 'value' => 'fontawesome'], '1' => ['text' => 'Icon Moon', 'value' => 'iconmoon'], '2' => ['text' => 'Custom', 'value' => 'custom']]],
        false,
        false,
        [],
      ), c(
        "custom_icon",
        "Custom Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical', 'condition' => ['path' => 'content.components.icon_type', 'operand' => 'equals', 'value' => 'custom']],
        false,
        false,
        [],
      ), c(
        "show_label",
        "Show Label",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "label_text",
        "Label Text",
        [],
        ['type' => 'text', 'layout' => 'inline', 'condition' => ['path' => 'content.components.show_label', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return false;
    }

    static function settings()
    {
        return false;
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return false;
    }

    static function nestingRule()
    {
        return ["type" => "final",   ];
    }

    static function spacingBars()
    {
        return ['0' => ['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.wrapper.margin_top.%%BREAKPOINT%%'], '1' => ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.wrapper.margin_bottom.%%BREAKPOINT%%']];
    }

    static function attributes()
    {
        return false;
    }

    static function experimental()
    {
        return false;
    }

    static function order()
    {
        return 750;
    }

    static function dynamicPropertyPaths()
    {
        return ['0' => ['accepts' => 'string', 'path' => 'content.components.label_text'], '1' => ['accepts' => 'string', 'path' => 'content.components.rating']];
    }

    static function additionalClasses()
    {
        return false;
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.label.vertical_layout'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
