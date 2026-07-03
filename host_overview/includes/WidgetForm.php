<?php

/*
 * MIT License
 * Copyright (c) 2026 ObviousAIChicken
 * github.com/obviousaichicken/zabbix_widgets
 */

namespace Modules\HostOverview\Includes;

use Zabbix\Widgets\CWidgetField;
use Zabbix\Widgets\CWidgetForm;
use Zabbix\Widgets\Fields\CWidgetFieldCheckBoxList;
use Zabbix\Widgets\Fields\CWidgetFieldColor;
use Zabbix\Widgets\Fields\CWidgetFieldIntegerBox;
use Zabbix\Widgets\Fields\CWidgetFieldCheckBox;
use Zabbix\Widgets\Fields\CWidgetFieldMultiSelectHost;
use Zabbix\Widgets\Fields\CWidgetFieldMultiSelectOverrideHost;
use Zabbix\Widgets\Fields\CWidgetFieldRadioButtonList;
use Zabbix\Widgets\Fields\CWidgetFieldTextBox;

class WidgetForm extends CWidgetForm
{
    public const COLOR_SCHEME_THRESHOLD = 0;
    public const COLOR_SCHEME_SOLID     = 1;

    public const CORNERS_ROUNDED = 0;
    public const CORNERS_SQUARE  = 1;

    public const LABELS_FULL  = 0;
    public const LABELS_SHORT = 1;

    public const DEFAULT_BAR_HEIGHT = 8;

    public const INTERFACES_UNIT_KBPS = 0;
    public const INTERFACES_UNIT_MBPS = 1;
    public const INTERFACES_UNIT_GBPS = 2;

    public const METRIC_CPU        = 0;
    public const METRIC_RAM        = 1;
    public const METRIC_LOAD       = 2;
    public const METRIC_SWAP       = 3;
    public const METRIC_INTERFACES = 4;
    public const METRIC_DISKS      = 5;
    public const METRIC_PARTITIONS = 6;

    public const DEFAULT_COLOR_FILL             = '458ADC';
    public const DEFAULT_COLOR_THRESHOLD_HIGH   = 'FF4136';
    public const DEFAULT_COLOR_THRESHOLD_MEDIUM = 'FF851B';
    public const DEFAULT_COLOR_THRESHOLD_LOW    = '4C9F38';

    public const DEFAULT_THRESHOLD_HIGH        = 85;
    public const DEFAULT_THRESHOLD_MEDIUM      = 70;
    public const DEFAULT_THRESHOLD_SWAP_HIGH   = 10;
    public const DEFAULT_THRESHOLD_SWAP_MEDIUM = 5;
    public const DEFAULT_FRESHNESS_WARN        = 90;
    public const DEFAULT_FRESHNESS_STALE       = 300;

    public const DEFAULT_LOAD_HIGH       = 2;
    public const DEFAULT_INTERFACES_HIGH = 1;

    public const DEFAULT_ITEM_CPU      = 'CPU utilization';
    public const DEFAULT_ITEM_RAM      = 'Memory utilization';
    public const DEFAULT_ITEM_LOAD     = 'Load average (5m avg)';
    public const DEFAULT_ITEM_SWAP     = 'Free swap space in %';

    public const DEFAULT_ITEM_DISK        = '*Disk utilization';
    public const DEFAULT_ITEM_PARTITION   = 'FS [*]: Space: Used, in %';
    public const DEFAULT_ITEM_INTERFACE   = 'Interface *: Bits *';

    private const THRESHOLD_METRIC_FIELDS = [
        'cpu',
        'ram',
        'load',
        'swap',
        'iface',
        'disk',
        'partition',
    ];

    public function addFields(): self
    {
        return $this
            ->addField(
                (new CWidgetFieldMultiSelectHost('hostid', _('Host')))
                    ->setMultiple(false)
            )
            ->addField(
                new CWidgetFieldMultiSelectOverrideHost()
            )
            ->addField(
                (new CWidgetFieldBadgesList('badges'))
            )
            ->addField(
                (new CWidgetFieldTextBox('badge_uptime_item_name', _('Uptime item')))
                    ->setDefault(CWidgetFieldBadgesList::DEFAULT_ITEM_UPTIME)
            )
            ->addField(
                (new CWidgetFieldTextBox('badge_liveliness_item_name', _('Liveliness item')))
                    ->setDefault(CWidgetFieldBadgesList::DEFAULT_ITEM_LIVELINESS)
            )
            ->addField(
                (new CWidgetFieldCheckBox('problems_hide_acknowledged', _('Hide acknowledged problems')))
                    ->setDefault(0)
            )
            ->addField(
                (new CWidgetFieldColor('fill_color', _('Solid')))
                    ->setDefault(self::DEFAULT_COLOR_FILL)
            )
            ->addField(
                (new CWidgetFieldColor('th_color_1', null))
                    ->setDefault(self::DEFAULT_COLOR_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldColor('th_color_2', null))
                    ->setDefault(self::DEFAULT_COLOR_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldColor('th_color_3', _('Regular')))
                    ->setDefault(self::DEFAULT_COLOR_THRESHOLD_LOW)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_num_1', null, 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_num_2', null, 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_cpu_1', _('Processor high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_cpu_2', _('Processor medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_ram_1', _('Memory high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_ram_2', _('Memory medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_load_1', _('Load high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_load_2', _('Load medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_swap_1', _('Swap high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_SWAP_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_swap_2', _('Swap medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_SWAP_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_iface_1', _('Interfaces high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_iface_2', _('Interfaces medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_disk_1', _('Disk high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_disk_2', _('Disk medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_partition_1', _('Partition high'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('th_partition_2', _('Partition medium'), 1, 100))
                    ->setDefault(self::DEFAULT_THRESHOLD_MEDIUM)
            )
            ->addField(
                (new CWidgetFieldCheckBoxList('metrics_show', _('Metrics'), [
                    self::METRIC_CPU        => _('Processor'),
                    self::METRIC_RAM        => _('Memory'),
                    self::METRIC_LOAD       => _('Load'),
                    self::METRIC_SWAP       => _('Swap'),
                    self::METRIC_INTERFACES => _('Interfaces'),
                    self::METRIC_DISKS      => _('Disk util.'),
                    self::METRIC_PARTITIONS => _('Partitions'),
                ]))
                    ->setDefault([
                        self::METRIC_CPU,
                        self::METRIC_RAM,
                        self::METRIC_LOAD,
                        self::METRIC_SWAP,
                        self::METRIC_INTERFACES,
                        self::METRIC_DISKS,
                        self::METRIC_PARTITIONS,
                    ])
            )
            ->addField(
                (new CWidgetFieldIntegerBox('load_high', _('Load ceiling'), 1, 1000))
                    ->setDefault(self::DEFAULT_LOAD_HIGH)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('interfaces_high', _('Interface ceiling'), 1, 10000))
                    ->setDefault(self::DEFAULT_INTERFACES_HIGH)
            )
            ->addField(
                (new CWidgetFieldRadioButtonList('interfaces_unit', null, [
                    self::INTERFACES_UNIT_KBPS => _('Kbps'),
                    self::INTERFACES_UNIT_MBPS => _('Mbps'),
                    self::INTERFACES_UNIT_GBPS => _('Gbps'),
                ]))
                    ->setDefault(self::INTERFACES_UNIT_GBPS)
            )
            ->addField(
                (new CWidgetFieldRadioButtonList('color_scheme', _('Color Scheme'), [
                    self::COLOR_SCHEME_THRESHOLD => _('Threshold'),
                    self::COLOR_SCHEME_SOLID     => _('Solid'),
                ]))
                    ->setDefault(self::COLOR_SCHEME_THRESHOLD)
            )
            ->addField(
                (new CWidgetFieldRadioButtonList('corners', _('Corners'), [
                    self::CORNERS_ROUNDED => _('Rounded'),
                    self::CORNERS_SQUARE  => _('Square'),
                ]))
                    ->setDefault(self::CORNERS_ROUNDED)
            )
            ->addField(
                (new CWidgetFieldRadioButtonList('label_length', _('Labels'), [
                    self::LABELS_FULL  => _('Full'),
                    self::LABELS_SHORT => _('Short'),
                ]))
                    ->setDefault(self::LABELS_FULL)
            )
            ->addField(
                (new CWidgetFieldRadioButtonList('bar_height', _('Bar height'), [
                    4  => '4px',
                    5  => '5px',
                    6  => '6px',
                    7  => '7px',
                    8  => '8px',
                    9  => '9px',
                    10 => '10px',
                ]))
                    ->setDefault(self::DEFAULT_BAR_HEIGHT)
            )
            ->addField(
                (new CWidgetFieldCheckBox('open_links_same_window', _('Open in same tab')))
                    ->setDefault(0)
            )
            ->addField(
                (new CWidgetFieldCheckBox('problems_pulse', _('Pulse problems badge')))
                    ->setDefault(1)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('freshness_warn', _('Liveliness warn'), 1, 86400))
                    ->setDefault(self::DEFAULT_FRESHNESS_WARN)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('freshness_stale', _('Liveliness stale'), 1, 86400))
                    ->setDefault(self::DEFAULT_FRESHNESS_STALE)
            )
            ->addField(
                (new CWidgetFieldCheckBox('problems_hide_suppressed', _('Hide suppressed problems')))
                    ->setDefault(0)
            )
            ->addField(
                (new CWidgetFieldTextBox('interfaces_exclude', _('Interface filter')))
                    ->setDefault('')
            )
            ->addField(
                (new CWidgetFieldTextBox('disks_exclude', _('Disk filter')))
                    ->setDefault('')
            )
            ->addField(
                (new CWidgetFieldTextBox('partitions_exclude', _('Partition filter')))
                    ->setDefault('')
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_cpu', _('Processor item')))
                    ->setDefault(self::DEFAULT_ITEM_CPU)
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_ram', _('Memory item')))
                    ->setDefault(self::DEFAULT_ITEM_RAM)
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_load', _('Load item')))
                    ->setDefault(self::DEFAULT_ITEM_LOAD)
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_swap', _('Swap item')))
                    ->setDefault(self::DEFAULT_ITEM_SWAP)
            )
            ->addField(
                (new CWidgetFieldCheckBox('item_swap_invert', _('Invert swap')))
                    ->setDefault(1)
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_disk', _('Disk pattern')))
                    ->setDefault(self::DEFAULT_ITEM_DISK)
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_partition', _('Partition pattern')))
                    ->setDefault(self::DEFAULT_ITEM_PARTITION)
            )
            ->addField(
                (new CWidgetFieldTextBox('item_name_interface', _('Interface pattern')))
                    ->setDefault(self::DEFAULT_ITEM_INTERFACE)
            );
    }

    protected function normalizeValues(array $values): array
    {
        foreach (self::THRESHOLD_METRIC_FIELDS as $metric) {
            $high_field = 'th_' . $metric . '_1';
            $medium_field = 'th_' . $metric . '_2';

            if (!array_key_exists($high_field, $values) && array_key_exists('th_num_1', $values)) {
                $values[$high_field] = $values['th_num_1'];
            }

            if (!array_key_exists($medium_field, $values) && array_key_exists('th_num_2', $values)) {
                $values[$medium_field] = $values['th_num_2'];
            }
        }

        return parent::normalizeValues($values);
    }

    public function validate(bool $strict = false): array
    {
        $errors = parent::validate($strict);
        $enabled_metrics = array_map('intval', (array) $this->getFieldValue('metrics_show'));

        if (!self::hasConfiguredValue($this->getFieldValue('hostid'))
                && !self::hasConfiguredValue($this->getFieldValue('override_hostid'))) {
            $this->addFieldError($errors, 'hostid', _('cannot be empty'));
        }

        foreach ([
            self::METRIC_CPU => 'item_name_cpu',
            self::METRIC_RAM => 'item_name_ram',
            self::METRIC_LOAD => 'item_name_load',
            self::METRIC_SWAP => 'item_name_swap',
        ] as $metric => $field_name) {
            if (in_array($metric, $enabled_metrics, true)) {
                $this->validateRequiredTextField($errors, $field_name);
            }
        }

        if (in_array(self::METRIC_DISKS, $enabled_metrics, true)) {
            $this->validateWildcardPatternField($errors, 'item_name_disk', 1);
        }

        if (in_array(self::METRIC_PARTITIONS, $enabled_metrics, true)) {
            $this->validateWildcardPatternField($errors, 'item_name_partition', 1);
        }

        if (in_array(self::METRIC_INTERFACES, $enabled_metrics, true)) {
            $this->validateWildcardPatternField($errors, 'item_name_interface', 2);
        }

        if ($this->hasBadgeType(CWidgetFieldBadgesList::BADGE_UPTIME)) {
            $this->validateRequiredTextField($errors, 'badge_uptime_item_name');
        }

        if ($this->hasBadgeType(CWidgetFieldBadgesList::BADGE_LIVELINESS)) {
            $this->validateRequiredTextField($errors, 'badge_liveliness_item_name');
        }

        return $errors;
    }

    private function validateRequiredTextField(array &$errors, string $field_name): void
    {
        if (trim((string) $this->getFieldValue($field_name)) === '') {
            $this->addFieldError($errors, $field_name, _('cannot be empty'));
        }
    }

    private function validateWildcardPatternField(array &$errors, string $field_name, int $required_wildcards): void
    {
        $value = trim((string) $this->getFieldValue($field_name));

        if ($value === '') {
            $this->addFieldError($errors, $field_name, _('cannot be empty'));
            return;
        }

        if (substr_count($value, '*') < $required_wildcards) {
            $message = $required_wildcards === 1
                ? _('must contain at least one "*" wildcard')
                : _s('must contain at least %1$s "*" wildcards', $required_wildcards);

            $this->addFieldError($errors, $field_name, $message);
        }
    }

    private function addFieldError(array &$errors, string $field_name, string $message): void
    {
        $errors[] = _s(
            'Invalid parameter "%1$s": %2$s.',
            $this->getField($field_name)->getErrorLabel(),
            $message
        );
    }

    private static function hasConfiguredValue($value): bool
    {
        if (is_array($value)) {
            if (array_key_exists(CWidgetField::FOREIGN_REFERENCE_KEY, $value)) {
                return trim((string) $value[CWidgetField::FOREIGN_REFERENCE_KEY]) !== '';
            }

            foreach ($value as $entry) {
                if ((string) $entry !== '') {
                    return true;
                }
            }

            return false;
        }

        return trim((string) $value) !== '';
    }

    private function hasBadgeType(int $type): bool
    {
        $badges_field = $this->getField('badges');
        $badges = $badges_field instanceof CWidgetFieldBadgesList ? $badges_field->getBadges() : [];

        foreach ($badges as $badge) {
            if ((int) ($badge['type'] ?? -1) === $type) {
                return true;
            }
        }

        return false;
    }
}
