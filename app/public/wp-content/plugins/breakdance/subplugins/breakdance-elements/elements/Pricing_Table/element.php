<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\PricingTable",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class PricingTable extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg aria-hidden="true" focusable="false"   class="svg-inline--fa fa-square-dollar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M228.4 240.6L220 238.2C182.7 227.2 173.3 219.1 176.6 200.4c3.75-21.88 33.44-27.31 61.25-22.94c7.625 1.188 16.81 3.703 28.94 7.891c8.375 2.891 17.47-1.547 20.34-9.891c2.875-8.359-1.531-17.47-9.906-20.36c-13.94-4.812-24.88-7.766-34.44-9.266C241.8 145.7 240.9 145.7 240 145.6V112C240 103.2 232.8 96 224 96S208 103.2 208 112v32.71C173.1 148.2 149.1 166.4 145 194.9C136.1 246.9 184.8 261.2 211 268.9l8.562 2.469c42.75 12.22 55.47 19.38 51.84 40.28c-3.75 21.91-33.44 27.27-61.34 22.92C198.3 332.8 184.3 327.8 172 323.3l-6.656-2.375C157 318 147.9 322.3 144.9 330.7c-2.938 8.344 1.438 17.48 9.75 20.42l6.5 2.328c13.72 4.953 29.28 10.55 44.06 12.78C206.2 366.3 207 366.3 208 366.4V400c0 8.844 7.156 16 16 16s16-7.156 16-16v-32.74c34.04-3.52 58.02-21.65 62.94-50.18C312.1 264.5 263.7 250.7 228.4 240.6zM384 32H64C28.65 32 0 60.66 0 96v320c0 35.34 28.65 64 64 64h320c35.35 0 64-28.66 64-64V96C448 60.66 419.3 32 384 32zM416 416c0 17.64-14.36 32-32 32H64c-17.64 0-32-14.36-32-32V96c0-17.64 14.36-32 32-32h320c17.64 0 32 14.36 32 32V416z"></path></svg>';
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
        return 'Pricing Table';
    }

    static function className()
    {
        return 'bde-pricing-table';
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
        return ['content' => ['content' => ['title' => 'Breakdance', 'description' => 'Everything you need to succeed.', 'features' => ['0' => ['text' => 'Use on unlimited websites', 'not_included' => false], '1' => ['text' => 'WooCommerce integration', 'not_included' => false], '2' => ['text' => 'Design library', 'not_included' => false], '3' => ['text' => 'No bloat', 'not_included' => true]], 'icon' => ['slug' => 'icon-pencil', 'name' => 'pencil', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" id="icon-pencil" viewBox="0 0 32 32">
<path d="M27 0c2.761 0 5 2.239 5 5 0 1.126-0.372 2.164-1 3l-2 2-7-7 2-2c0.836-0.628 1.874-1 3-1zM2 23l-2 9 9-2 18.5-18.5-7-7-18.5 18.5zM22.362 11.362l-14 14-1.724-1.724 14-14 1.724 1.724z"/>
</svg>'], 'button' => ['text' => 'Get Breakdance', 'link' => ['type' => 'url', 'url' => 'https://breakdance.com/']], 'price' => ['before_price' => 'normally $349', 'amount' => '149', 'currency_symbol' => '$', 'per_period' => 'per year', 'fractional_amount' => '', 'badge' => 'limited time offer'], 'accent' => true, 'accent_text' => 'popular']], 'design' => ['box' => ['width' => ['breakpoint_base' => ['number' => 340, 'unit' => 'px', 'style' => '340px']], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'top' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'bottom' => ['number' => 40, 'unit' => 'px', 'style' => '40px']]]], 'content_alignment' => ['breakpoint_base' => 'center'], 'border' => ['radius' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'shadow' => ['shadows' => ['0' => ['color' => '#00000021', 'x' => '0', 'y' => '0', 'blur' => '30', 'spread' => '0', 'position' => 'outset']], 'style' => '0px 0px 30px 0px #00000021'], 'borders' => ['shadow' => ['breakpoint_base' => ['shadows' => ['0' => ['color' => '#00000040', 'x' => '0', 'y' => '12', 'blur' => '42', 'spread' => '0', 'position' => 'outset']], 'style' => '0px 12px 42px 0px #00000040']]]], 'price' => ['position' => null, 'amount' => null, 'badge' => null], 'spacing' => ['after_icon' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'after_title' => ['breakpoint_base' => ['number' => 35, 'unit' => 'px', 'style' => '35px']], 'after_price_area' => ['breakpoint_base' => ['number' => 35, 'unit' => 'px', 'style' => '35px']], 'after_description' => ['breakpoint_base' => ['number' => 25, 'unit' => 'px', 'style' => '25px']], 'after_features' => ['breakpoint_base' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'price_area' => ['amount_period' => null, 'before_amount' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']], 'before_badge' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'typography' => ['features' => ['color' => null]], 'features' => ['icons' => ['included_icon' => null, 'not_included_icon' => ['slug' => 'icon-times.', 'name' => 'times', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><!-- Font Awesome Free 5.15.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>'], 'background' => true, 'included_color' => '#27A216FF', 'not_included_color' => '#AD1111FF', 'padding' => ['breakpoint_base' => ['number' => 4, 'unit' => 'px', 'style' => '4px']], 'icon_size' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']], 'radius' => ['breakpoint_base' => ['number' => 3, 'unit' => 'px', 'style' => '3px']], 'excluded_color' => '#000000FF'], 'text_indent' => null, 'space_between_items' => null, 'center' => false], 'button' => ['display_as' => null, 'style' => 'primary']]];
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
        "container",
        "Container",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => [], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "content_alignment",
        "Content Alignment",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'left', 'text' => 'Left', 'icon' => 'AlignLeftIcon'], '1' => ['text' => 'Center', 'value' => 'center', 'icon' => 'AlignCenterIcon'], '2' => ['text' => 'Right', 'value' => 'right', 'icon' => 'AlignRightIcon']]],
        true,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "accent",
        "Accent",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "label_radius",
        "Label Radius",
        [],
        ['type' => 'border_radius', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "border_width",
        "Border Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 24, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Typography",
      "typography",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'condition' => ['path' => 'content.content.accent', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "icon",
        "Icon",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => ['path' => 'content.content.icon', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 16, 'max' => 128, 'step' => 1]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "price",
        "Price",
        [c(
        "position",
        "Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'after-title', 'text' => 'After Title'], '1' => ['text' => 'After Features', 'value' => 'after-features']]],
        false,
        false,
        [],
      ), c(
        "amount",
        "Amount",
        [c(
        "period_position",
        "Period Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'vertical', 'text' => 'Vertical'], '1' => ['text' => 'Horizontal', 'value' => 'horizontal']]],
        false,
        false,
        [],
      ), c(
        "currency_position",
        "Currency Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'preprend', 'text' => 'Prepend'], '1' => ['text' => 'Append', 'value' => 'append']], 'buttonBarOptions' => ['size' => 'small']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "badge",
        "Badge",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'colorOptions' => ['type' => 'solidAndGradient']],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border Radius",
        [],
        ['type' => 'border_radius', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Typography",
      "typography",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "nudge",
        "Nudge",
        [c(
        "currency_x",
        "Currency X",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "currency_y",
        "Currency Y",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "period_x",
        "Period X",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "period_y",
        "Period Y",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "fraction_x",
        "Fraction X",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "fraction_y",
        "Fraction Y",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "features",
        "Features",
        [c(
        "force_left_alignment",
        "Force Left Alignment",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "icons",
        "Icons",
        [c(
        "icon_size",
        "Icon Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "included_color",
        "Included Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "excluded_color",
        "Excluded Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "included_icon",
        "Included Icon",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => ['path' => 'design.features.icons.background', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "excluded_icon",
        "Excluded Icon",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => ['path' => 'design.features.icons.background', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "padding",
        "Padding",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.background', 'operand' => 'is set', 'value' => null]],
        true,
        false,
        [],
      ), c(
        "radius",
        "Radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => '%%CURRENTPATH%%.background', 'operand' => 'is set', 'value' => '']],
        true,
        false,
        [],
      ), c(
        "custom_icons",
        "Custom Icons",
        [c(
        "included_icon",
        "Included Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "not_included_icon",
        "Not Included Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "nudge",
        "Nudge",
        [c(
        "icon_y_nudge",
        "Icon Y Nudge",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 1, 'max' => 20, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px']]],
        true,
        false,
        [],
      ), c(
        "icon_x_nudge",
        "Icon X Nudge",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 1, 'max' => 20, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px']]],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "text_indent",
        "Text Indent",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "space_between_items",
        "Space Between Items",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\AtomV1ButtonDesign",
      "Button",
      "button",
       ['type' => 'popout']
     ), c(
        "typography",
        "Typography",
        [getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Title",
      "title",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Label",
      "label",
       ['type' => 'popout']
     ), c(
        "price",
        "Price",
        [getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Before Price",
      "before_price",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Price",
      "price",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Currency",
      "currency",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Fractional Part",
      "fractional_part",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Period",
      "period",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Description",
      "description",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Features",
      "features",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "spacing",
        "Spacing",
        [c(
        "after_icon",
        "After Icon",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_title",
        "After Title",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_price_area",
        "After Price Area",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_description",
        "After Description",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_features",
        "After Features",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "price_area",
        "Price Area",
        [c(
        "before_amount",
        "Before Amount",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "amount_period",
        "Amount / Period",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "before_badge",
        "Before Badge",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Wrapper",
      "wrapper",
       ['type' => 'popout']
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
        "content",
        "Content",
        [c(
        "accent",
        "Accent",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "accent_text",
        "Accent Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => ['path' => 'content.content.accent', 'operand' => 'is set', 'value' => '']],
        false,
        false,
        [],
      ), c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "price",
        "Price",
        [c(
        "before_price",
        "Before Price",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "amount",
        "Amount",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "per_period",
        "Per Period",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "currency_symbol",
        "Currency Symbol",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "fractional_amount",
        "Fractional Amount",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "badge",
        "Badge",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "description",
        "Description",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
        false,
        false,
        [],
      ), c(
        "features",
        "Features",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "not_included",
        "Not Included",
        [],
        ['type' => 'toggle', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'Feature', 'buttonName' => 'Add Feature']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\AtomV1ButtonContent",
      "Button",
      "button",
       ['type' => 'popout']
     ), c(
        "html_tags",
        "HTML Tags",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'div', 'text' => 'div'], '1' => ['value' => 'h1', 'text' => 'h1'], '2' => ['value' => 'h2', 'text' => 'h2'], '3' => ['value' => 'h3', 'text' => 'h3'], '4' => ['value' => 'h4', 'text' => 'h4'], '5' => ['value' => 'h5', 'text' => 'h5'], '6' => ['value' => 'h6', 'text' => 'h6']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
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
        return ['proOnly' => true];
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
        return 550;
    }

    static function dynamicPropertyPaths()
    {
        return ['0' => ['accepts' => 'string', 'path' => 'content.content.title'], '1' => ['accepts' => 'string', 'path' => 'content.content.description'], '2' => ['accepts' => 'string', 'path' => 'content.content.price.before_price'], '3' => ['accepts' => 'string', 'path' => 'content.content.price.amount'], '4' => ['accepts' => 'string', 'path' => 'content.content.price.per_period'], '5' => ['accepts' => 'string', 'path' => 'content.content.price.currency_symbol'], '6' => ['accepts' => 'string', 'path' => 'content.content.price.fractional_amount'], '7' => ['accepts' => 'string', 'path' => 'content.content.price.badge'], '8' => ['accepts' => 'string', 'path' => 'content.content.features[].text'], '9' => ['accepts' => 'string', 'path' => 'content.content.button.text'], '10' => ['accepts' => 'url', 'path' => 'content.content.button.link']];
    }

    static function additionalClasses()
    {
        return [['name' => 'bde-pricing-table--featured', 'template' => '{% if content.content.accent %}
yes
{% endif %}']];
    }

    static function projectManagement()
    {
        return ['looksGood' => 'yes', 'optionsGood' => 'yes', 'optionsWork' => 'yes', 'notes' => ''];
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.button.custom.size.full_width_at', 'design.button.style'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
