<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Telegram\Obis;

/**
 * References to the OBIS (Object Identification System)
 */
interface ReferencesInterface
{
    /**
     * Telegram line endings
     * @var string
     */
    const LINE_SEPERATOR = "\r\n";
    /**
     * Version information for P1 output
     * @var string
     */
    const VERSION_INFORMATION = '1-3:0.2.8';
    /**
     * Date-time stamp of the P1 message
     * @var string
     */
    const DATETIME_STAMP = '0-0:1.0.0';
    /**
     * Equipment identifier
     * @var string
     */
    const EQUIPMENT_IDENTIFIER = '0-0:96.1.1';
    /**
     * Meter Reading electricity delivered to client (Tariff 1) in 0,001 kWh
     * @var string
     */
    const ELECTRICITY_DELIVERED_TO_CLIENT_TARIFF_1 = '1-0:1.8.1';
    /**
     * Meter Reading electricity delivered to client (Tariff 2) in 0,001 kWh
     * @var string
     */
    const ELECTRICITY_DELIVERED_TO_CLIENT_TARIFF_2 = '1-0:1.8.2';
    /**
     * Meter Reading electricity delivered by client (Tariff 1) in 0,001 kWh
     * @var string
     */
    const ELECTRICITY_DELIVERED_BY_CLIENT_TARIFF_1 = '1-0:2.8.1';
    /**
     * Meter Reading electricity delivered by client (Tariff 2) in 0,001 kWh
     * @var string
     */
    const ELECTRICITY_DELIVERED_BY_CLIENT_TARIFF_2 = '1-0:2.8.2';
    /**
     * Tariff indicator electricity. The tariff indicator can also be used
     * to switch tariffdependent loads e.g boilers.
     * This is the responsibility of the P1 user
     * @var string
     */
    const TARIFF_ELECTRICITY_INDICATOR = '0-0:96.14.0';
    /**
     * Actual electricity power delivered (+P) in 1 Watt resolution
     * @var string
     */
    const ACTUAL_ELECTRICITY_DELIVERED = '1-0:1.7.0';
    /**
     * Actual electricity power received (-P) in 1 Watt resolution
     * @var string
     */
    const ACTUAL_ELECTRICITY_RECEIVED = '1-0:2.7.0';
    /**
     * Switch position Electricity (in/out/enabled) DSM 4.0
     * @var string
     */
    const SWITCH_POSITION_ELECTRICITY = '0-0:96.3.10';
    /**
     * Number of power failures in any phase
     * @var string
     */
    const NUMBER_POWER_FAILURES = '0-0:96.7.21';
    /**
     * Number of long power failures in any phase
     * @var string
     */
    const NUMBER_LONG_POWER_FAILURE = '0-0:96.7.9';
    /**
     * Power Failure Event Log (long power failures)
     * @var string
     */
    const POWER_FAILURE_EVENT_LOG = '1-0:99.97.0';
    /**
     * Number of voltage sags in phase L1
     * @var string
     */
    const NUMBER_VOLTAGE_SAGS_PHASE_L1 = '1-0:32.32.0';
    /**
     * Number of voltage sags in phase L2
     * @var string
     */
    const NUMBER_VOLTAGE_SAGS_PHASE_L2 = '1-0:52.32.0';
    /**
     * Number of voltage sags in phase L3
     * @var string
     */
    const NUMBER_VOLTAGE_SAGS_PHASE_L3 = '1-0:72.32.0';
    /**
     * Number of voltage swells in phase L1
     * @var string
     */
    const NUMBER_VOLTAGE_SWELLS_PHASE_L1 = '1-0:32.36.0';
    /**
     * Number of voltage swells in phase L2
     * @var string
     */
    const NUMBER_VOLTAGE_SWELLS_PHASE_L2 = '1-0:52.36.0';
    /**
     * Number of voltage swells in phase L3
     * @var string
     */
    const NUMBER_VOLTAGE_SWELLS_PHASE_L3 = '1-0:72.36.0';
    /**
     * Text message max 1024 characters.
     * @var string
     */
    const TEXT_MESSAGE = '0-0:96.13.0';
    /**
     * Instantaneous voltage L1 in V resolution
     * @var string
     */
    const INSTANTANEOUS_VOLTAGE_L1 = '1-0:32.7.0';
    /**
     * Instantaneous voltage L2 in V resolution
     * @var string
     */
    const INSTANTANEOUS_VOLTAGE_L2 = '1-0:52.7.0';
    /**
     * Instantaneous voltage L3 in V resolution
     * @var string
     */
    const INSTANTANEOUS_VOLTAGE_L3 = '1-0:72.7.0';
    /**
     * Instantaneous current L1 in A resolution
     * @var string
     */
    const INSTANTANEOUS_CURRENT_L1 = '1-0:31.7.0';
    /**
     * Instantaneous current L2 in A resolution
     * @var string
     */
    const INSTANTANEOUS_CURRENT_L2 = '1-0:51.7.0';
    /**
     * Instantaneous current L3 in A resolution
     * @var string
     */
    const INSTANTANEOUS_CURRENT_L3 = '1-0:71.7.0';
    /**
     * Instantaneous active power L1 (+P) in W resolution
     * @var string
     */
    const INSTANTANEOUS_ACTIVE_POWER_L1_POSITIVE = '1-0:21.7.0';
    /**
     * Instantaneous active power L2 (+P) in W resolution
     * @var string
     */
    const INSTANTANEOUS_ACTIVE_POWER_L2_POSITIVE = '1-0:41.7.0';
    /**
     * Instantaneous active power L3 (+P) in W resolution
     * @var string
     */
    const INSTANTANEOUS_ACTIVE_POWER_L3_POSITIVE = '1-0:61.7.0';
    /**
     * Instantaneous active power L1 (-P) in W resolution
     * @var string
     */
    const INSTANTANEOUS_ACTIVE_POWER_L1_NEGATIVE = '1-0:22.7.0';
    /**
     * Instantaneous active power L2 (-P) in W resolution
     * @var string
     */
    const INSTANTANEOUS_ACTIVE_POWER_L2_NEGATIVE = '1-0:42.7.0';
    /**
     * Instantaneous active power L3 (-P) in W resolution
     * @var string
     */
    const INSTANTANEOUS_ACTIVE_POWER_L3_NEGATIVE = '1-0:62.7.0';
    /**
     * M-Bus Device Type
     * @var string
     */
    const DEVICE_TYPE = '0-n:24.1.0';
    /**
     * M-Bus Device - Equipment identifier
     * @var string
     */
    const DEVICE_EQUIPMENT_IDENTIFIER = '0-n:96.1.0';
    /**
     * M-Bus Device - Last 5-minute Meter reading and capture time
     * @var string
     */
    const DEVICE_DELIVERED_TO_CLIENT = '0-n:24.2.1';

    /**
     * Get reference by id
     * @param string $id the reference id
     * @return array|null Reference options
     */
    public function getReference(string $id): ?array;
}
