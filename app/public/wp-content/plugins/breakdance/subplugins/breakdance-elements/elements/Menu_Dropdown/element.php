<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "EssentialElements\\MenuDropdown",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class MenuDropdown extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg aria-hidden="true" focusable="false"   class="svg-inline--fa fa-caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M287.1 192H32c-28.37 0-42.74 34.5-22.62 54.63l127.1 128c12.5 12.5 32.75 12.5 45.25 0l127.1-128C330.7 226.5 316.5 192 287.1 192zM159.1 352L32.01 224h255.9L159.1 352z"></path></svg>';
    }

    static function tag()
    {
        return 'li';
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
        return 'Menu Dropdown';
    }

    static function className()
    {
        return 'bde-menu-dropdown';
    }

    static function category()
    {
        return 'site';
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
        return ['content' => ['content' => ['text' => 'Dropdown', 'columns' => [['title' => 'Get Started', 'links' => [['text' => 'Prebuilt checkout'], ['text' => 'Libraries and SDKs'], ['text' => 'Plugins'], ['text' => 'Code samples']]], ['title' => 'Guides', 'links' => [['text' => 'Accept online payments'], ['text' => 'Manage subscriptions'], ['text' => 'Send payments'], ['text' => 'Set up in-person payments']]]]]]];
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
        "wrapper",
        "Wrapper",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
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
     ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['step' => 50, 'min' => 100, 'max' => 1140], 'condition' => [[['path' => 'design.desktop_menu.dropdowns.wrapper.placement', 'operand' => 'not equals', 'value' => 'full-width']]]],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\AtomV1MenuDropdownLinkDesign",
      "Links",
      "links",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\AtomV1MenuColumnDesign",
      "Columns",
      "columns",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\AtomV1MenuAdditionalSectionDesign",
      "Additional Section",
      "additional_section",
       ['type' => 'popout']
     ), c(
        "advanced",
        "Advanced",
        [c(
        "disable_desktop_styles_at",
        "Disable Desktop Styles At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'vertical', 'breakpointOptions' => ['enableNever' => true]],
        false,
        false,
        [],
      ), c(
        "warning",
        "Warning",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'warning', 'content' => '<p>It\'s recommended to set the same breakpoint that the Menu Builder mobile menu is enabled for.</p>']],
        false,
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
        "content",
        "Content",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "link",
        "Link",
        [],
        ['type' => 'link', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "alert",
        "Alert",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Setting a top-level link for a dropdown toggle is not advisable due to poor ux on mobile devices. Breakdance does not recommend making top-level dropdowns links.</p>'], 'condition' => [[['path' => 'content.content.link', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "columns",
        "Columns",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "links",
        "Links",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
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
        "url",
        "URL",
        [],
        ['type' => 'link', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "icon_or_image",
        "Icon or Image",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['text' => 'Icon', 'value' => 'icon', 'icon' => 'IconsIcon'], ['text' => 'Image', 'value' => 'image', 'icon' => 'ImageIcon']]],
        false,
        false,
        [],
      ), c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.icon_or_image', 'operand' => 'equals', 'value' => 'image']],
        false,
        false,
        [],
      ), c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.icon_or_image', 'operand' => 'equals', 'value' => 'icon']],
        false,
        false,
        [],
      ), c(
        "advanced",
        "Advanced",
        [getPresetSection(
      "EssentialElements\\AtomV1MenuDropdownLinkGraphicDesign",
      "Graphic",
      "graphic",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'Link', 'buttonName' => 'Add Link', 'defaultNewValue' => ['text' => 'Link']]],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{title}', 'defaultTitle' => 'Column', 'buttonName' => 'Add Column']],
        false,
        false,
        [],
      ), c(
        "show_another_section",
        "Show Another Section",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "columns_2",
        "Columns 2",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "links",
        "Links",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
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
        "url",
        "URL",
        [],
        ['type' => 'link', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "icon_or_image",
        "Icon or Image",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => [['text' => 'Icon', 'value' => 'icon', 'icon' => 'IconsIcon'], ['text' => 'Image', 'value' => 'image', 'icon' => 'ImageIcon']]],
        false,
        false,
        [],
      ), c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.icon_or_image', 'operand' => 'equals', 'value' => 'image']],
        false,
        false,
        [],
      ), c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical', 'condition' => ['path' => '%%CURRENTPATH%%.icon_or_image', 'operand' => 'equals', 'value' => 'icon']],
        false,
        false,
        [],
      ), c(
        "advanced",
        "Advanced",
        [getPresetSection(
      "EssentialElements\\AtomV1MenuDropdownLinkGraphicDesign",
      "Graphic",
      "graphic",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'vertical', 'sectionOptions' => ['type' => 'popout']],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'Link', 'buttonName' => 'Add Link', 'defaultNewValue' => ['text' => 'Link']]],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{title}', 'defaultTitle' => 'Column', 'buttonName' => 'Add Column'], 'condition' => ['path' => 'content.content.show_another_section', 'operand' => 'is set', 'value' => '']],
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
        return [

'onMountedElement' => [['script' => 'const element = document.querySelector(\'[data-node-id="%%ID%%"]\');
const menuElement = element.closest(\'.bde-menu\');
const menuId = menuElement ? menuElement.dataset.nodeId : null;

if (
  menuId &&
  window.breakdanceMenus &&
  window.breakdanceMenus[menuId]
) {
  window.breakdanceMenus[menuId].refresh();
}
',
],],

'onPropertyChange' => [['script' => 'const element = document.querySelector(\'[data-node-id="%%ID%%"]\');
const menuElement = element.closest(\'.bde-menu\');
const menuId = menuElement ? menuElement.dataset.nodeId : null;

if (
  menuId &&
  window.breakdanceMenus &&
  window.breakdanceMenus[menuId]
) {
  window.breakdanceMenus[menuId].refresh();
}',
],['script' => 'const element = document.querySelector(\'[data-node-id="%%ID%%"]\');
const menuElement = element.closest(\'.bde-menu\');
const menuId = menuElement ? menuElement.dataset.nodeId : null;

if (
  menuId &&
  window.breakdanceMenus &&
  window.breakdanceMenus[menuId]
) {
  const dropdown = document.querySelector(\'%%SELECTOR%% .breakdance-dropdown\');

  if (dropdown) {
    window.breakdanceMenus[menuId].openDropdown(dropdown);
  }
}','dependencies' => ['design'],
],],];
    }

    static function nestingRule()
    {
        return ["type" => "final", "restrictedToBeADirectChildOf" => ['EssentialElements\MenuBuilder'],  ];
    }

    static function spacingBars()
    {
        return [];
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
        return 0;
    }

    static function dynamicPropertyPaths()
    {
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.content.columns[].title'], ['accepts' => 'string', 'path' => 'content.content.columns[].links[].text'], ['accepts' => 'string', 'path' => 'content.content.columns[].links[].description'], ['accepts' => 'image_url', 'path' => 'content.content.columns[].links[].image'], ['accepts' => 'url', 'path' => 'content.content.columns[].links[].url']];
    }

    static function additionalClasses()
    {
        return [['name' => 'breakdance-menu-item', 'template' => 'yes']];
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return ['design.advanced.disable_desktop_styles_at'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
