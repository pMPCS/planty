<?php

namespace EssentialElements;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

\Breakdance\Elements\PresetSections\PresetSectionsController::getInstance()->register(
    "EssentialElements\\LayoutV2",
    c(
        "layout_v2",
        "Layout",
        [c(
        "layout",
        "Layout",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'vertical', 'text' => 'Vertical', 'icon' => 'EllipsisStrokeVerticalIcon'], '1' => ['text' => 'Horizontal', 'value' => 'horizontal', 'icon' => 'EllipsisStrokeIcon'], '2' => ['text' => 'Grid', 'value' => 'grid', 'icon' => 'Grid2Icon'], '3' => ['icon' => 'CogsIcon', 'text' => 'Advanced', 'value' => 'advanced']], 'buttonBarOptions' => ['size' => 'small', 'layout' => 'default']],
        false,
        false,
        [],
      ), c(
        "v_align",
        "Align",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Left', 'icon' => 'FlexAlignLeftIcon'], '1' => ['text' => 'Center', 'value' => 'center', 'icon' => 'FlexAlignCenterHorizontalIcon'], '2' => ['text' => 'Right', 'value' => 'flex-end', 'icon' => 'FlexAlignRightIcon']], 'buttonBarOptions' => ['size' => 'small'], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'vertical']]]],
        true,
        false,
        [],
      ), c(
        "v_vertical_align",
        "Vertical Align",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Top', 'icon' => 'FlexAlignTopIcon'], '1' => ['text' => 'Middle', 'value' => 'center', 'icon' => 'FlexAlignCenterVerticalIcon'], '2' => ['text' => 'Bottom', 'value' => 'flex-end', 'icon' => 'FlexAlignBottomIcon']], 'buttonBarOptions' => ['size' => 'small'], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'vertical']]]],
        true,
        false,
        [],
      ), c(
        "v_gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'vertical']]]],
        true,
        false,
        [],
      ), c(
        "h_align",
        "Align",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Left', 'icon' => 'FlexAlignLeftIcon'], '1' => ['value' => 'center', 'text' => 'Center', 'icon' => 'FlexAlignCenterHorizontalIcon'], '2' => ['value' => 'flex-end', 'text' => 'Right', 'icon' => 'FlexAlignRightIcon'], '3' => ['text' => 'Space Around', 'value' => 'space-around', 'icon' => 'DistributeSpacingHorizontalIcon'], '4' => ['text' => 'Space Between', 'value' => 'space-between', 'icon' => 'DistributeSpacingHorizontalIcon']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'horizontal']]], 'buttonBarOptions' => ['layout' => 'default', 'size' => 'small']],
        true,
        false,
        [],
      ), c(
        "h_vertical_align",
        "Vertical Align",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Top', 'icon' => 'FlexAlignTopIcon'], '1' => ['value' => 'center', 'text' => 'Middle', 'icon' => 'FlexAlignCenterVerticalIcon'], '2' => ['value' => 'flex-end', 'text' => 'Bottom', 'icon' => 'FlexAlignBottomIcon']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'horizontal']]]],
        true,
        false,
        [],
      ), c(
        "h_gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'horizontal']]]],
        true,
        false,
        [],
      ), c(
        "h_vertical_at",
        "Vertical At",
        [],
        ['type' => 'breakpoint_dropdown', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'horizontal']]]],
        false,
        false,
        [],
      ), c(
        "h_alignment_when_vertical",
        "Alignment When Vertical",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Left', 'icon' => 'FlexAlignLeftIcon'], '1' => ['text' => 'Center', 'value' => 'center', 'icon' => 'FlexAlignCenterHorizontalIcon'], '2' => ['text' => 'Right', 'value' => 'flex-end', 'icon' => 'FlexAlignRightIcon']], 'buttonBarOptions' => ['size' => 'small'], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.h_vertical_at', 'operand' => 'is set', 'value' => ''], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'horizontal']]]],
        false,
        false,
        [],
      ), c(
        "g_items_per_row",
        "Items Per Row",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "g_space_between_items",
        "Space Between Items",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "advanced",
        "Advanced",
        [c(
        "item_vertical_alignment",
        "Item Vertical Alignment",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['text' => 'Stretch', 'value' => 'stretch'], '1' => ['text' => 'Start', 'value' => 'start'], '2' => ['value' => 'center', 'text' => 'Center'], '3' => ['text' => 'End', 'value' => 'end']], 'buttonBarOptions' => ['size' => 'small', 'layout' => 'default']],
        true,
        false,
        [],
      ), c(
        "item_horizontal_alignment",
        "Item Horizontal Alignment",
        [],
        ['type' => 'button_bar', 'layout' => 'vertical', 'items' => ['0' => ['text' => 'Stretch', 'value' => 'stretch'], '1' => ['text' => 'Start', 'value' => 'start'], '2' => ['value' => 'center', 'text' => 'Center'], '3' => ['text' => 'End', 'value' => 'end']], 'buttonBarOptions' => ['size' => 'small', 'layout' => 'default']],
        true,
        false,
        [],
      ), c(
        "use_original_item_dimensions",
        "Use Original Item Dimensions",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'inline', 'sectionOptions' => ['type' => 'popout'], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'grid']]]],
        false,
        false,
        [],
      ), c(
        "a_display",
        "Display",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => ['0' => ['text' => 'flex', 'value' => 'flex'], '1' => ['value' => 'grid', 'text' => 'grid']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]]],
        false,
        false,
        [],
      ), c(
        "a_f_flex_direction",
        "Flex Direction",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'column', 'text' => 'Column'], '1' => ['value' => 'row', 'text' => 'Row'], '2' => ['value' => 'column-reverse', 'text' => 'Column Reverse'], '3' => ['value' => 'row-reverse', 'text' => 'Row Reverse']]],
        true,
        false,
        [],
      ), c(
        "a_f_align_items",
        "Align Items",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'stretch', 'text' => 'Stretch'], '1' => ['value' => 'flex-start', 'text' => 'Flex Start'], '2' => ['text' => 'Flex End', 'value' => 'flex-end'], '3' => ['text' => 'Center', 'value' => 'center'], '4' => ['text' => 'Baseline', 'value' => 'baseline']]],
        true,
        false,
        [],
      ), c(
        "a_f_justify_content",
        "Justify Content",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Flex Start'], '1' => ['text' => 'Flex End', 'value' => 'flex-end'], '2' => ['text' => 'Center', 'value' => 'center'], '3' => ['text' => 'Space Between', 'value' => 'space-between'], '4' => ['text' => 'Space Around', 'value' => 'space-around'], '5' => ['text' => 'Space Evenly', 'value' => 'space-evenly']]],
        true,
        false,
        [],
      ), c(
        "a_f_flex_wrap",
        "Flex Wrap",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'nowrap', 'text' => 'No Wrap'], '1' => ['value' => 'wrap', 'text' => 'Wrap'], '2' => ['value' => 'wrap-reverse', 'text' => 'Wrap Reverse']]],
        true,
        false,
        [],
      ), c(
        "a_f_align_content",
        "Align Content",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'flex-start', 'text' => 'Flex Start'], '1' => ['text' => 'Flex End', 'value' => 'flex-end'], '2' => ['text' => 'Center', 'value' => 'center'], '3' => ['text' => 'Space Between', 'value' => 'space-between'], '4' => ['text' => 'Space Around', 'value' => 'space-around'], '5' => ['text' => 'Stretch', 'value' => 'stretch'], '6' => ['text' => 'Baseline', 'value' => 'baseline']]],
        true,
        false,
        [],
      ), c(
        "a_f_gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]]],
        true,
        false,
        [],
      ), c(
        "a_f_row_gap",
        "Row Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]]],
        true,
        false,
        [],
      ), c(
        "a_f_text_align",
        "Text Align",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'flex'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'left', 'text' => 'Left', 'icon' => 'AlignLeftIcon'], '1' => ['value' => 'center', 'text' => 'Center', 'icon' => 'AlignCenterIcon'], '2' => ['value' => 'right', 'text' => 'Right', 'icon' => 'AlignRightIcon']]],
        true,
        false,
        [],
      ), c(
        "a_g_grid",
        "Grid",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'textOptions' => ['multiline' => true, 'format' => 'plain']],
        true,
        false,
        [],
      ), c(
        "a_g_grid_template",
        "Grid Template",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]], 'textOptions' => ['multiline' => true, 'format' => 'plain']],
        true,
        false,
        [],
      ), c(
        "a_g_gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "a_g_row_gap",
        "Row Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "a_g_justify_items",
        "Justify Items",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]], 'items' => ['0' => ['value' => 'start', 'text' => 'Start'], '1' => ['text' => 'End', 'value' => 'end'], '2' => ['text' => 'Center', 'value' => 'center'], '3' => ['text' => 'Stretch', 'value' => 'stretch']]],
        true,
        false,
        [],
      ), c(
        "a_g_align_items",
        "Align Items",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]], 'items' => ['0' => ['value' => 'start', 'text' => 'Start'], '1' => ['text' => 'End', 'value' => 'end'], '2' => ['text' => 'Center', 'value' => 'center'], '3' => ['text' => 'Stretch', 'value' => 'stretch'], '4' => ['text' => 'Baseline', 'value' => 'baseline']]],
        true,
        false,
        [],
      ), c(
        "a_g_justify_content",
        "Justify Content",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]], 'items' => ['0' => ['value' => 'start', 'text' => 'Start'], '1' => ['text' => 'End', 'value' => 'end'], '2' => ['text' => 'Center', 'value' => 'center'], '3' => ['text' => 'Stretch', 'value' => 'stretch'], '4' => ['value' => 'space-around', 'text' => 'Space Around'], '5' => ['value' => 'space-between', 'text' => 'Space Between'], '6' => ['text' => 'Space Evenly', 'value' => 'space-evenly']]],
        true,
        false,
        [],
      ), c(
        "a_g_align_content",
        "Align Content",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'start', 'text' => 'Start'], '1' => ['value' => 'end', 'text' => 'End'], '2' => ['value' => 'center', 'text' => 'Center'], '3' => ['value' => 'stretch', 'text' => 'Stretch'], '4' => ['value' => 'space-around', 'text' => 'Space Around'], '5' => ['value' => 'space-between', 'text' => 'Space Between'], '6' => ['value' => 'space-evenly', 'text' => 'Space Evenly']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "a_g_grid_auto_columns",
        "Grid Auto Columns",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "a_g_grid_auto_rows",
        "Grid Auto Rows",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "a_g_grid_auto_flow",
        "Grid Auto Flow",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => ['0' => ['value' => 'row', 'text' => 'Row'], '1' => ['text' => 'Column', 'value' => 'column'], '2' => ['text' => 'Row Dense', 'value' => 'row dense'], '3' => ['value' => 'column dense', 'text' => 'Column Dense']], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced'], '1' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid']]]],
        true,
        false,
        [],
      ), c(
        "a_g_text_align",
        "Text Align",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'variableOptions' => ['enabled' => false], 'condition' => ['0' => ['0' => ['path' => '%%CURRENTPATH%%.a_display', 'operand' => 'equals', 'value' => 'grid'], '1' => ['path' => '%%CURRENTPATH%%.layout', 'operand' => 'equals', 'value' => 'advanced']]], 'items' => ['0' => ['value' => 'left', 'text' => 'Left', 'icon' => 'AlignLeftIcon'], '1' => ['value' => 'center', 'text' => 'Center', 'icon' => 'AlignCenterIcon'], '2' => ['value' => 'right', 'text' => 'Right', 'icon' => 'AlignRightIcon']]],
        true,
        false,
        [],
      )],
        ['type' => 'section', 'sectionOptions' => ['preset' => ['slug' => 'EssentialElements\\LayoutV2']]],
        false,
        false,
        [],
      ),
    true,
    ['relativePropertyPathsToWhitelistInFlatProps' => ['0' => 'layout', '1' => 'h_vertical_at', '2' => 'h_alignment_when_vertical', '3' => 'a_display']]
);

