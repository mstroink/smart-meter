<?php

namespace mstroink\SmartMeter\Test\Telegram;

use mstroink\SmartMeter\Telegram\Exception\InvalidTelegramException;
use mstroink\SmartMeter\Telegram\Obis\Mapper;
use mstroink\SmartMeter\Telegram\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    private $file;
    /**
     * @var Parser
     */
    private $parser;

    public function setup()
    {
        $this->parser = new Parser(new Mapper());
        $this->file = dirname(__DIR__) . '/raw-5.0.txt';
    }

    public function tearDown()
    {
        unset($this->parser);
    }

    public function testShouldVerifyValidTelegram()
    {
        $raw = file_get_contents($this->file);
        $this->assertCount(32, $this->parser->parse($raw));
    }

    public function testShouldVerifyInvalidTelegram()
    {
        $this->expectException(InvalidTelegramException::class);
        $raw = file_get_contents($this->file);
        $raw = str_replace('12345', 'INVALID', $raw); //remove a value
        $this->parser->parse($raw);
    }

    public function testShouldVerifyIncompleteTelegram()
    {
        $this->expectException(InvalidTelegramException::class);
        $raw = file_get_contents($this->file);
        $raw = str_replace('!9089', '', $raw); //remove checksum
        $this->parser->parse($raw);
    }

    /**
     * @dataProvider telegramLinesProvider
     */
    public function testShouldReturnCorrectValues($line, $expected)
    {
        $this->assertSame(
            $this->parser->parse($line, false),
            $expected
        );
    }

    public function telegramLinesProvider()
    {
        return [
            'dsmr_version' => [
                "1-3:0.2.8(50)", ['dsmr_version' => 50]
            ],
            'timestamp' => [
                "0-0:1.0.0(180713232150S)", ['timestamp' => '2018-07-13 23:21:50']
            ],
            'timestamp_2' => [
                "0-0:1.0.0(151110192959W)", ['timestamp' => '2015-11-10 19:29:59']
            ],
            'equipment_identifier' => [
                "0-0:96.1.1(123456)", ['equipment_identifier' => hex2bin('123456')]
            ],
            'electricity_delivered_1' => [
                "1-0:1.8.1(002075.293*kWh)", ['electricity_delivered_1' => 2075.293]
            ],
            'electricity_delivered_2' => [
                "1-0:1.8.2(001406.966*kWh)", ['electricity_delivered_2' => 1406.966]
            ],
            'electricity_returned_1' => [
                "1-0:2.8.1(000377.759*kWh)", ['electricity_returned_1' => 377.759]
            ],
            'electricity_returned_2' => [
                "1-0:2.8.2(000934.603*kWh)", ['electricity_returned_2' => 934.603]
            ],
            'electricity_tariff' => [
                "0-0:96.14.0(0001)", ['electricity_tariff' => 1]
            ],
            'electricity_currently_delivered' => [
                "1-0:1.7.0(00.544*kW)", ['electricity_currently_delivered' => 0.544]
            ],
            'electricity_currently_returned' => [
                "1-0:2.7.0(00.000*kW)", ['electricity_currently_returned' => 0.0]
            ],
            'power_failure_count' => [
                "0-0:96.7.21(00030)", ['power_failure_count' => 30]
            ],
            'long_power_failure_count' => [
                "0-0:96.7.9(00013)", ['long_power_failure_count' => 13]
            ],
            'switch_position_electricity' => [
                "0-0:96.3.10(1)", ['switch_position_electricity' => 1]
            ],
            'power_failure_log' => [
                "1-0:99.97.0()", ['power_failure_log' => null]
            ],
            'voltage_sag_count_l1' => [
                "1-0:32.32.0(00005)", ['voltage_sag_count_l1' => 5]
            ],
            'voltage_sag_count_l2' => [
                "1-0:52.32.0(00007)", ['voltage_sag_count_l2' => 7]
            ],
            'voltage_sag_count_l3' => [
                "1-0:72.32.0(00005)", ['voltage_sag_count_l3' => 5]
            ],
            'voltage_swell_count_l1' => [
                "1-0:32.36.0(00000)", ['voltage_swell_count_l1' => 0]
            ],
            'voltage_swell_count_l2' => [
                "1-0:52.36.0(00000)", ['voltage_swell_count_l2' => 0]
            ],
            'voltage_swell_count_l3' => [
                "1-0:72.36.0(00000)", ['voltage_swell_count_l3' => 0]
            ],
            'text_message_long' => [
                "0-0:96.13.0()", ['text_message_long' => null]
            ],
            'instantaneous_voltage_l1' => [
                "1-0:32.7.0(239.0*V)", ['instantaneous_voltage_l1' => 239.0]
            ],
            'instantaneous_voltage_l2' => [
                "1-0:52.7.0(239.0*V)", ['instantaneous_voltage_l2' => 239.0]
            ],
            'instantaneous_voltage_l3' => [
                "1-0:72.7.0(240.0*V)", ['instantaneous_voltage_l3' => 240.0]
            ],
            'instantaneous_current_l1' => [
                "1-0:31.7.0(001*A)", ['instantaneous_current_l1' => 1]
            ],
            'instantaneous_current_l2' => [
                "1-0:51.7.0(001*A)", ['instantaneous_current_l2' => 1]
            ],
            'instantaneous_current_l3' => [
                "1-0:71.7.0(000*A)", ['instantaneous_current_l3' => 0]
            ],
            'instantaneous_active_power_l1_delivered' => [
                "1-0:21.7.0(00.152*kW)", ['instantaneous_active_power_l1_delivered' => 0.152]
            ],
            'instantaneous_active_power_l2_delivered' => [
                "1-0:41.7.0(00.391*kW)", ['instantaneous_active_power_l2_delivered' => 0.391]
            ],
            'instantaneous_active_power_l3_delivered' => [
                "1-0:61.7.0(00.000*kW)", ['instantaneous_active_power_l3_delivered' => 0.0]
            ],
            'instantaneous_active_power_l1_received' => [
                "1-0:22.7.0(00.000*kW)", ['instantaneous_active_power_l1_received' => 0.0]
            ],
            'instantaneous_active_power_l2_received' => [
                "1-0:42.7.0(00.000*kW)", ['instantaneous_active_power_l2_received' => 0.0]
            ],
            'instantaneous_active_power_l3_received' => [
                "1-0:62.7.0(00.000*kW)", ['instantaneous_active_power_l3_received' => 0.0]
            ],
            'gas_device_type' => [
                "0-1:24.1.0(003)", ['gas_device_type' => 3]
            ],
            'gas_equipment_identifier' => [
                "0-1:96.1.0(123456)", ['gas_equipment_identifier' => hex2bin('123456')]
            ],
            'gas_delivered' => [
                "0-1:24.2.1(151110190000W)(00845.206*m3)", [
                    'gas_delivered' => [
                        0 => '2015-11-10 19:00:00',
                        1 => 845.206,
                    ]
                ]
            ]
        ];
    }
}
