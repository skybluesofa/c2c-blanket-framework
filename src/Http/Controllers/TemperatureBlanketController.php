<?php

namespace SkyBlueSofa\C2CBlanketFramework\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use SkyBlueSofa\C2CBlanketFramework\Facades\OpenMeteo;
use SkyBlueSofa\C2CBlanketFramework\Facades\TemperatureBlanketConfig;

class TemperatureBlanketController extends BaseController
{
    protected ?Carbon $date;

    protected array $weatherData = [
        'previous_row' => null,
        'current_row' => null,
    ];

    public function __construct(Request $request)
    {
        $this->date = new Carbon($request->get('date') ?? null);
    }

    public function show()
    {
        $this->getWeatherData();

        return $this->getJsonOutput();
    }

    protected function getWeatherData(): array
    {
        $yesterday = $this->date->clone()->subDay(1);
        $tomorrow = $this->date->clone()->addDay(1);
        $this->weatherData['current_row'] = collect([
            $yesterday->format('Y-m-d') => OpenMeteo::get($yesterday) ?? null,
            $this->date->format('Y-m-d') => OpenMeteo::get($this->date) ?? null,
            $tomorrow->format('Y-m-d') => OpenMeteo::get($tomorrow) ?? null,
        ]);

        $yesterdayPreviousRowDate = $yesterday->clone()->subDay(TemperatureBlanketConfig::get('columns'));
        $todayPreviousRowDate = $this->date->clone()->subDay(TemperatureBlanketConfig::get('columns'));
        $tomorrowPreviousRowDate = $tomorrow->clone()->subDay(TemperatureBlanketConfig::get('columns'));
        $this->weatherData['previous_row'] = collect([
            $yesterdayPreviousRowDate->format('Y-m-d') => OpenMeteo::get($yesterdayPreviousRowDate) ?? null,
            $todayPreviousRowDate->format('Y-m-d') => OpenMeteo::get($todayPreviousRowDate) ?? null,
            $tomorrowPreviousRowDate->format('Y-m-d') => OpenMeteo::get($tomorrowPreviousRowDate) ?? null,
        ]);

        return $this->weatherData;
    }

    protected function getJsonOutput()
    {
        return [
            'meta' => [
                'cachedDate' => OpenMeteo::cachedDate($this->date)?->format('Y-m-d h:i:sa') ?? null,
                'columns' => TemperatureBlanketConfig::get('columns'),
                'design' => TemperatureBlanketConfig::design(),
                'colors' => TemperatureBlanketConfig::colors(),
            ],
            'rows' => [
                'previous' => [
                    'date' => $this->date->clone()->subDays(TemperatureBlanketConfig::get('columns')),
                    'cells' => [
                        'previous' => [
                            'date' => $this->date->clone()->subDays(TemperatureBlanketConfig::get('columns'))->subDay(1),
                            'weather' => $this->weatherData['previous_row']->first() ?? null,
                            'show' => true,
                        ],
                        'current' => [
                            'date' => $this->date->clone()->subDays(TemperatureBlanketConfig::get('columns')),
                            'weather' => $this->weatherData['previous_row']->nth(2, 1)->first() ?? null,
                            'show' => true,
                        ],
                        'next' => [
                            'date' => $this->date->clone()->subDays(TemperatureBlanketConfig::get('columns'))->addDay(1),
                            'weather' => $this->weatherData['previous_row']->last() ?? null,
                            'show' => true,
                        ],
                    ],
                ],
                'current' => [
                    'date' => $this->date,
                    'cells' => [
                        'previous' => [
                            'date' => $this->date->clone()->subDay(1),
                            'weather' => $this->weatherData['current_row']->first() ?? null,
                            'show' => true,
                        ],
                        'current' => [
                            'date' => $this->date,
                            'weather' => $this->weatherData['current_row']->nth(2, 1)->first() ?? null,
                            'show' => true,
                        ],
                        'next' => [
                            'date' => $this->date->clone()->addDay(1),
                            'weather' => $this->weatherData['current_row']->last() ?? null,
                            'show' => is_array($this->weatherData['current_row']->last() ?? null),
                        ],
                    ],
                ],
                'next' => [
                    'date' => $this->date->clone()->addDays(TemperatureBlanketConfig::get('columns')),
                ],
            ],
        ];
    }
}
