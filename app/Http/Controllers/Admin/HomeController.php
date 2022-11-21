<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Latest User Sessions (Unique) - Last 7 Days',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\UserSession',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'fields'                => [
                'session'      => '',
                'service_code' => '',
                'msisdn'       => '',
            ],
            'translation_key' => 'userSession',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'           => 'Latest User Session Queries - Last 7 Days',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Session',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-8',
            'entries_number'        => '5',
            'fields'                => [
                'session'      => '',
                'service_code' => '',
                'msisdn'       => '',
                'ussd_string'  => '',
                'title'        => '',
                'menu'         => '',
                'selection'    => '',
                'session_date' => '',
            ],
            'translation_key' => 'session',
        ];

        $settings2['data'] = [];
        if (class_exists($settings2['model'])) {
            $settings2['data'] = $settings2['model']::latest()
                ->take($settings2['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings2)) {
            $settings2['fields'] = [];
        }

        $settings3 = [
            'chart_title'        => 'Unique User Sessions - Last 7 Days',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\UserSession',
            'group_by_field'     => 'service_code',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'translation_key'    => 'userSession',
        ];

        $chart3 = new LaravelChart($settings3);

        $settings4 = [
            'chart_title'        => 'User Session Queries - Last 7 Days',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Session',
            'group_by_field'     => 'service_code',
            'aggregate_function' => 'count',
            'filter_field'       => 'session_date',
            'filter_days'        => '7',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'translation_key'    => 'session',
        ];

        $chart4 = new LaravelChart($settings4);

        // $settings5 = [
        //     'chart_title'        => 'Payments - Last 7 Days',
        //     'chart_type'         => 'bar',
        //     'report_type'        => 'group_by_string',
        //     'model'              => 'App\Payment',
        //     'group_by_field'     => 'ussd_code',
        //     'aggregate_function' => 'count',
        //     'filter_field'       => 'created_at',
        //     'filter_days'        => '7',
        //     'column_class'       => 'col-md-5',
        //     'entries_number'     => '5',
        //     'translation_key'    => 'payment',
        // ];

        // $chart5 = new LaravelChart($settings5);

        // $settings6 = [
        //     'chart_title'           => 'Latest Payments - Last 7 Days',
        //     'chart_type'            => 'latest_entries',
        //     'report_type'           => 'group_by_date',
        //     'model'                 => 'App\Payment',
        //     'group_by_field'        => 'created_at',
        //     'group_by_period'       => 'day',
        //     'aggregate_function'    => 'count',
        //     'filter_field'          => 'created_at',
        //     'filter_days'           => '7',
        //     'group_by_field_format' => 'Y-m-d H:i:s',
        //     'column_class'          => 'col-md-7',
        //     'entries_number'        => '5',
        //     'fields'                => [
        //         'msisdn'    => '',
        //         'account'   => '',
        //         'amount'    => '',
        //         'reference' => '',
        //         'origin'    => '',
        //         'mode'      => '',
        //         'session'   => '',
        //         'ussd_code' => '',
        //     ],
        //     'translation_key' => 'payment',
        // ];

        // $settings6['data'] = [];
        // if (class_exists($settings6['model'])) {
        //     $settings6['data'] = $settings6['model']::latest()
        //         ->take($settings6['entries_number'])
        //         ->get();
        // }

        // if (!array_key_exists('fields', $settings6)) {
        //     $settings6['fields'] = [];
        // }

        return view('home', compact('chart3', 'chart4', /**'chart5', */ 'settings1', 'settings2'/**, 'settings6' */));
    }
}
