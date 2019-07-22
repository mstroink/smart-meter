<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Telegram\Obis;

/**
 * @inheritDoc
 */
class Mapper implements ReferencesInterface
{
    /**
     * OBIS References with parse options
     * @var array
     */
    protected const REFERENCES = [
        self::VERSION_INFORMATION => [
            "key" => "dsmr_version",
            "transform" => "integer"
        ],
        self::DATETIME_STAMP => [
            "key" => "timestamp",
            "transform" => "timestamp"
        ],
        self::EQUIPMENT_IDENTIFIER => [
            "key" => "equipment_identifier",
            "transform" => "hex",
        ],
        self::ELECTRICITY_DELIVERED_TO_CLIENT_TARIFF_1 => [
            "key" => 'electricity_delivered_1',
            "transform" => "float",
        ],
        self::ELECTRICITY_DELIVERED_TO_CLIENT_TARIFF_2 => [
            "key" => "electricity_delivered_2",
            "transform" => "float",
        ],
        self::ELECTRICITY_DELIVERED_BY_CLIENT_TARIFF_1 => [
            "key" => "electricity_returned_1",
            "transform" => "float",
        ],
        self::ELECTRICITY_DELIVERED_BY_CLIENT_TARIFF_2 => [
            "key" => "electricity_returned_2",
            "transform" => "float",
        ],
        self::TARIFF_ELECTRICITY_INDICATOR => [
            "key" => "electricity_tariff",
            "transform" => "integer",
        ],
        self::ACTUAL_ELECTRICITY_DELIVERED => [
            "key"   => "electricity_currently_delivered",
            "transform" => "float",
        ],
        self::ACTUAL_ELECTRICITY_RECEIVED => [
            "key" => "electricity_currently_returned",
            "transform" => "float",
        ],
        self::SWITCH_POSITION_ELECTRICITY => [
            "key" => "switch_position_electricity",
            "transform" => ["integer"],
        ],
        self::POWER_FAILURE_EVENT_LOG => [
            "key" => "power_failure_log",
            "transform" => ["integer", 'timestamp', "integer"],
        ],
        self::NUMBER_POWER_FAILURES => [
            "key" => "power_failure_count",
            "transform" => "integer",
        ],
        self::NUMBER_LONG_POWER_FAILURE => [
            "key" => 'long_power_failure_count',
            "transform" => "integer",
        ],
        self::NUMBER_VOLTAGE_SAGS_PHASE_L1 => [
            "key" => 'voltage_sag_count_l1',
            "transform" => "integer",
        ],
        self::NUMBER_VOLTAGE_SAGS_PHASE_L2 => [
            "key" => 'voltage_sag_count_l2',
            "transform" => "integer",
        ],
        self::NUMBER_VOLTAGE_SAGS_PHASE_L3 => [
            "key" => 'voltage_sag_count_l3',
            "transform" => "integer",
        ],
        self::NUMBER_VOLTAGE_SWELLS_PHASE_L1 => [
            "key" => 'voltage_swell_count_l1',
            "transform" => "integer",
        ],
        self::NUMBER_VOLTAGE_SWELLS_PHASE_L2 => [
            "key" => 'voltage_swell_count_l2',
            "transform" => "integer",
        ],
        self::NUMBER_VOLTAGE_SWELLS_PHASE_L3 => [
            "key" => 'voltage_swell_count_l3',
            "transform" => "integer",
        ],
        self::TEXT_MESSAGE => [
            "key" => 'text_message_long',
            "transform" => ["hex"],
        ],
        self::INSTANTANEOUS_VOLTAGE_L1 => [
            "key" => 'instantaneous_voltage_l1',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_VOLTAGE_L2 => [
            "key" => 'instantaneous_voltage_l2',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_VOLTAGE_L3 => [
            "key" => 'instantaneous_voltage_l3',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_CURRENT_L1 => [
            "key" => 'instantaneous_current_l1',
            "transform" => "integer",
        ],
        self::INSTANTANEOUS_CURRENT_L2 => [
            "key" => 'instantaneous_current_l2',
            "transform" => "integer",
        ],
        self::INSTANTANEOUS_CURRENT_L3 => [
            "key" => 'instantaneous_current_l3',
            "transform" => "integer",
        ],
        self::INSTANTANEOUS_ACTIVE_POWER_L1_POSITIVE => [
            "key" => 'instantaneous_active_power_l1_delivered',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_ACTIVE_POWER_L2_POSITIVE => [
            "key" => 'instantaneous_active_power_l2_delivered',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_ACTIVE_POWER_L3_POSITIVE => [
            "key" => 'instantaneous_active_power_l3_delivered',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_ACTIVE_POWER_L1_NEGATIVE => [
            "key" => 'instantaneous_active_power_l1_received',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_ACTIVE_POWER_L2_NEGATIVE => [
            "key" => 'instantaneous_active_power_l2_received',
            "transform" => "float",
        ],
        self::INSTANTANEOUS_ACTIVE_POWER_L3_NEGATIVE => [
            "key" => 'instantaneous_active_power_l3_received',
            "transform" => "float",
        ],
        self::DEVICE_TYPE => [
            "key" => 'gas_device_type',
            "transform" => "integer",
        ],
        self::DEVICE_EQUIPMENT_IDENTIFIER => [
            "key" => 'gas_equipment_identifier',
            "transform" => "hex",
        ],
        self::DEVICE_DELIVERED_TO_CLIENT => [
            "key" => 'gas_delivered',
            "transform" => ["timestamp", "float"],
        ],
    ];

    /**
     * @inheritDoc
     */
    public function getReference(string $id): ?array
    {
        //Only a single M-Bus device is supported. Replace 0-[1-4] with 0-n
        $id = preg_replace('/(0-)[1-4](:(?:24|96))/', '$1n$2', $id);

        return (self::REFERENCES)[$id] ?? null;
    }
}
