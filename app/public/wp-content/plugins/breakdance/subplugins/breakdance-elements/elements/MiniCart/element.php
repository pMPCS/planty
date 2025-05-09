<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\MiniCart",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class MiniCart extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'CartShoppingIcon';
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
        return 'Mini Cart';
    }

    static function className()
    {
        return 'bde-mini-cart';
    }

    static function category()
    {
        return 'woocommerce';
    }

    static function badge()
    {
        return ['backgroundColor' => 'var(--brandWooCommerceBackground)', 'textColor' => 'var(--brandWooCommerce)', 'label' => 'Woo'];
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
        return false;
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
        "link",
        "Link",
        [c(
        "container",
        "Container",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders_without_shadows",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "borders_hover",
        "Borders Hover",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
      ), c(
        "shadow",
        "Shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical'],
        false,
        true,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
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
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 64, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
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
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "subtotal",
        "Subtotal",
        [getPresetSection(
      "EssentialElements\\typography_with_effects_with_hoverable_color_and_effects",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "space_after",
        "Space After",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 40, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "quantity",
        "Quantity",
        [c(
        "overlap",
        "Overlap",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "space_before",
        "Space Before",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['path' => 'design.link.quantity.overlap', 'operand' => 'is not set', 'value' => ''], 'rangeOptions' => ['min' => 0, 'max' => 40, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        false,
        false,
        [],
      ), c(
        "top_nudge",
        "Top Nudge",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 40, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        false,
        false,
        [],
      ), c(
        "right_nudge",
        "Right Nudge",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'rangeOptions' => ['min' => 0, 'max' => 40, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_hoverable_color",
      "Typography",
      "typography",
       ['type' => 'popout']
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
        "cart",
        "Cart",
        [c(
        "style",
        "Style",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'dropdown', 'text' => 'Dropdown'], '1' => ['text' => 'Sidebar', 'value' => 'sidebar']], 'buttonBarOptions' => ['size' => 'small', 'layout' => 'default']],
        false,
        false,
        [],
      ), c(
        "dropdown_position",
        "Dropdown Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'left', 'text' => 'Left'], '1' => ['text' => 'Center', 'value' => 'center'], '2' => ['text' => 'Right', 'value' => 'right']], 'condition' => ['path' => 'design.cart.style', 'operand' => 'not equals', 'value' => 'sidebar']],
        false,
        false,
        [],
      ), c(
        "sidebar_position",
        "Sidebar Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'left', 'text' => 'Left'], '1' => ['text' => 'Right', 'value' => 'right']], 'condition' => ['path' => 'design.cart.style', 'operand' => 'equals', 'value' => 'sidebar']],
        false,
        false,
        [],
      ), c(
        "full_screen_at",
        "Full Screen At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline', 'breakpointOptions' => ['enableNever' => true]],
        false,
        false,
        [],
      ), c(
        "full_screen_position",
        "Full Screen Position",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'left', 'text' => 'Left'], '1' => ['text' => 'Right', 'value' => 'right']], 'condition' => ['path' => 'design.cart.full_screen_at', 'operand' => 'is set', 'value' => 'sidebar']],
        false,
        false,
        [],
      ), c(
        "container",
        "Container",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1000, 'step' => 1]],
        true,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "top_bar",
        "Top Bar",
        [getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "close_button",
        "Close Button",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'rangeOptions' => ['min' => 12, 'max' => 40, 'step' => 1]],
        true,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'left', 'text' => 'Left'], '1' => ['text' => 'Right', 'value' => 'right']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "contents",
        "Contents",
        [c(
        "max_height",
        "Max Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 80, 'max' => 615, 'step' => 10]],
        false,
        false,
        [],
      ), c(
        "rows",
        "Rows",
        [c(
        "spacing",
        "Spacing",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 40, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "separator_color",
        "Separator Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "separator_height",
        "Separator Height",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 4, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "thumbnails",
        "Thumbnails",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px'], 'rangeOptions' => ['min' => 10, 'max' => 100, 'step' => 1]],
        true,
        false,
        [],
      ), c(
        "opacity",
        "Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        true,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "remove_icon",
        "Remove Icon",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 4, 'max' => 40, 'step' => 1], 'unitOptions' => ['types' => ['0' => 'px'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        true,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_hoverable_color",
      "Product Title",
      "product_title",
       ['type' => 'popout']
     ), c(
        "attributes",
        "Attributes",
        [getPresetSection(
      "EssentialElements\\typography",
      "Name",
      "name",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Value",
      "value",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Quantity",
      "quantity",
       ['condition' => ['path' => 'dummy_element', 'operand' => 'equals', 'value' => 'dummy'], 'type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Price",
      "price",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "subtotal",
        "Subtotal",
        [getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Label",
      "label",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects",
      "Amount",
      "amount",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "actions",
        "Actions",
        [getPresetSection(
      "EssentialElements\\AtomV1CustomButtonDesign",
      "Button",
      "button",
       ['type' => 'popout']
     ), c(
        "continue_shopping",
        "Continue Shopping",
        [getPresetSection(
      "EssentialElements\\typography_with_effects_with_hoverable_everything",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "icon",
        "Icon",
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
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "spacing",
        "Spacing",
        [c(
        "after_top_bar",
        "After Top Bar",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_contents",
        "After Contents",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_subtotal",
        "After Subtotal",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "after_button",
        "After Button",
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
      ), getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Spacing",
      "spacing",
       ['type' => 'popout']
     ), c(
        "advanced",
        "Advanced",
        [getPresetSection(
      "EssentialElements\\WooGlobalStylerOverride",
      "Override Global Styles",
      "override_global_styles",
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
        "link",
        "Link",
        [c(
        "hide_count",
        "Hide Count",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hide_count_when_empty",
        "Hide Count When Empty",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'content.content.link.hide_count', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "hide_subtotal",
        "Hide Subtotal",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hide_subtotal_when_empty",
        "Hide Subtotal When Empty",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => 'content.content.link.hide_subtotal', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "attributes",
        "Attributes",
        [c(
        "name",
        "Name",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "value",
        "Value",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'inline_repeater', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "cart",
        "Cart",
        [c(
        "top_bar",
        "Top Bar",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'enable', 'text' => 'Enable'], '1' => ['text' => 'Disable', 'value' => 'disable']]],
        false,
        false,
        [],
      ), c(
        "primary_button",
        "Primary Button",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'cart', 'text' => 'Cart'], '1' => ['text' => 'Checkout', 'value' => 'checkout']]],
        false,
        false,
        [],
      ), c(
        "continue_shopping_link",
        "Continue Shopping Link",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => ['0' => ['text' => 'Disabled', 'value' => 'disabled'], '1' => ['value' => 'homepage', 'text' => 'Homepage'], '2' => ['text' => 'Shop Page', 'value' => 'shop'], '3' => ['text' => 'Custom', 'value' => 'custom']]],
        false,
        false,
        [],
      ), c(
        "url",
        "URL",
        [],
        ['type' => 'url', 'layout' => 'vertical', 'condition' => ['path' => 'content.content.cart.continue_shopping_link', 'operand' => 'equals', 'value' => 'custom']],
        false,
        false,
        [],
      ), c(
        "open_cart_on_add",
        "Open Cart On Add",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hide_quantity_input",
        "Hide Quantity Input",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), c(
        "after_title_bar",
        "After Title Bar",
        [],
        ['type' => 'global_block_chooser', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "after_footer",
        "After Footer",
        [],
        ['type' => 'global_block_chooser', 'layout' => 'vertical'],
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
        return ['0' =>  ['scripts' => ['%%BREAKDANCE_ELEMENTS_PLUGIN_URL%%elements/MiniCart/mini-cart.js'],],'1' =>  ['inlineScripts' => ['new BreakdanceMiniCart(\'%%SELECTOR%%\', 
    {
      ...{{ content.content|json_encode }},
      style: \'{{ design.cart.style|default("dropdown") }}\',
      full_screen_at: \'{{ design.cart.full_screen_at|default("breakpoint_phone_landscape") }}\'
    }
);'],'builderCondition' => 'return false;',],];
    }

    static function settings()
    {
        return ['requiredPlugins' => ['0' => 'WooCommerce'], 'proOnly' => true];
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return [

'onPropertyChange' => [['script' => '(function() {
  if (window.BreakdanceMiniCartInstances && window.BreakdanceMiniCartInstances[%%ID%%]) {
    window.BreakdanceMiniCartInstances[%%ID%%].destroy();
  }

  window.BreakdanceMiniCartInstances[%%ID%%] = new BreakdanceMiniCart(\'%%SELECTOR%%\', 
    {
      ...{{ content.content|json_encode }},
      style: \'{{ design.cart.style|default("dropdown") }}\',
      full_screen_at: \'{{ design.cart.full_screen_at|default("breakpoint_phone_landscape") }}\'
    }
);
}());',
],],

'onMountedElement' => [['script' => '(function() {
    if (!window.BreakdanceMiniCartInstances) window.BreakdanceMiniCartInstances = {};

    if (window.BreakdanceMiniCartInstances && window.BreakdanceMiniCartInstances[%%ID%%]) {
      window.BreakdanceMiniCartInstances[%%ID%%].destroy();
    }

    window.BreakdanceMiniCartInstances[%%ID%%] = new BreakdanceMiniCart(\'%%SELECTOR%%\', 
    {
      ...{{ content.content|json_encode }},
      style: \'{{ design.cart.style|default("dropdown") }}\',
      full_screen_at: \'{{ design.cart.full_screen_at|default("breakpoint_phone_landscape") }}\'
    }
);
  }());',
],],

'onMovedElement' => [['script' => '(function() {
  if (window.BreakdanceMiniCartInstances && window.BreakdanceMiniCartInstances[%%ID%%]) {
    window.BreakdanceMiniCartInstances[%%ID%%].update();
  }
}());',
],],

'onBeforeDeletingElement' => [['script' => '  (function() {
    if (window.BreakdanceMiniCartInstances && window.BreakdanceMiniCartInstances[%%ID%%]) {
      window.BreakdanceMiniCartInstances[%%ID%%].destroy();
      delete window.BreakdanceMiniCartInstances[%%ID%%];
    }
  }());',
],],];
    }

    static function nestingRule()
    {
        return ["type" => "final",   ];
    }

    static function spacingBars()
    {
        return ['0' => ['location' => 'outside-top', 'cssProperty' => 'margin-top', 'affectedPropertyPath' => 'design.spacing.margin_top.%%BREAKPOINT%%'], '1' => ['location' => 'outside-bottom', 'cssProperty' => 'margin-bottom', 'affectedPropertyPath' => 'design.spacing.margin_bottom.%%BREAKPOINT%%']];
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
        return 1000;
    }

    static function dynamicPropertyPaths()
    {
        return false;
    }

    static function additionalClasses()
    {
        return [['name' => 'breakdance-woocommerce', 'template' => 'yes']];
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.cart.actions.button.styles.size.full_width_at', 'design.cart.actions.button.styles', 'design.cart.full_screen_position', 'design.cart.full_screen_at', 'design.cart.dropdown_position', 'design.cart.sidebar_position', 'design.cart.style'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return ['content.content.type', 'content.content.cart', 'design.cart.style', 'design.cart.dropdown_position', 'content.content.after_title_bar', 'content.content.after_footer', 'content.content.link.attributes'];
    }
}
