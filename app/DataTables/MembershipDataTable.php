<?php
/*
 * File name: MembershipDataTable.php
 * Last modified: 2022.03.11 at 00:39:10
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\Membership;
use App\Models\CustomField;
use App\Models\Post;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class MembershipDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('title', function ($membership) {
                return $membership->title;
            })
           ->editColumn('cost', function ($membership) {
                return getPriceColumn($membership, 'cost');
             })
            ->editColumn('value_offered', function ($membership) {
                return getPriceColumn($membership, 'value_offered');
            })
            ->editColumn('discount', function ($membership) {
                return getPriceColumn($membership, 'discount');
            })
            ->editColumn('validity_months', function ($membership) {
                return getColorColumn($membership, 'validity_months');
            })
            ->editColumn('thumbnail', function ($membership) {
                return getColorColumn($membership, 'thumbnail');
            })
            ->editColumn('updated_at', function ($membership) {
                return getDateColumn($membership, 'updated_at');
            })
            ->editColumn('created_at', function ($membership) {
                return getDateColumn($membership, 'created_at');
            }) 
            
          /* ->editColumn('updated_by', function ($membership) {
                return getDateColumn($membership, 'updated_by');
            })
           ->editColumn('created_by', function ($membership) {
                return getDateColumn($membership, 'created_by');
            })
           */
            ->addColumn('action', 'memberships.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'title',
                'title' => trans('lang.membership_title'),

            ],
            [
                'data' => 'cost',
                'title' => trans('lang.membership_cost'),

            ],
            [
                'data' => 'value_offered',
                'title' => trans('lang.membership_value_offered'),

            ],
            [
                'data' => 'discount',
                'title' => trans('lang.membership_discount'),
            ],
            [
                'data' => 'validity_months',
                'title' => trans('lang.membership_validity_months'),
            ],
            [
                'data' => 'order',
                'title' => trans('lang.membership_order'),
            ],
            [
                'data' => 'created_by',
                'title' => trans('lang.membership_created_by'),
                'searchable' => false,
            ],
            [
                'data' => 'updated_by',
                'title' => trans('lang.membership_updated_by'),
                'searchable' => false,
            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.membership_updated_at'),
                'searchable' => false,
            ]
           
          
        ];
    $hasCustomField = in_array(Membership::class, setting('custom_field_models', []));  
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Membership::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.membership_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }   
        return $columns;  
    }

    /**
     * Get query source of dataTable.
     *
     * @param Membership $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Membership $model)
    {
        return $model->newQuery()->select("memberships.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'membershipsdatatable_' . time();
    }
}
