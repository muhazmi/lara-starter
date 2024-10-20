<?php

namespace App\Http\Controllers\Admin\Other;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class LogController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = ('Log');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Activity::with('causer')->latest();

            // Terapkan filter berdasarkan event jika ada
            if ($request->has('event') && !empty($request->event)) {
                $query->where('event', $request->event);
            }

            // Terapkan filter berdasarkan log_name jika ada
            if ($request->has('log_name') && !empty($request->log_name)) {
                $query->where('log_name', $request->log_name);
            }

            // Terapkan filter berdasarkan initiator (causer_name) jika ada
            if ($request->has('initiator') && !empty($request->initiator)) {
                $query->whereHas('causer', function ($q) use ($request) {
                    $q->where('name', $request->initiator);
                });
            }

            $data = $query->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('record_id', function ($row) {
                    return $row->properties->get('attributes')['id'] ?? $row->properties->get('old')['id'] ?? '-';
                })
                ->addColumn('event', function ($row) {
                    if ($row->event == 'created') {
                        return '<span class="btn btn-primary">' . ucwords($row->event) . '</span>';
                    } elseif ($row->event == 'updated') {
                        return '<span class="btn btn-warning">' . ucwords($row->event) . '</span>';
                    } elseif ($row->event == 'deleted') {
                        return '<span class="btn btn-danger">' . ucwords($row->event) . '</span>';
                    } else {
                        return '<span class="btn btn-secondary">' . ucwords($row->event) . '</span>';
                    }
                })
                ->addColumn('log_name', function ($row) {
                    return ucwords($row->log_name);
                })
                ->addColumn('causer_name', function ($row) {
                    return $row->causer ? ucwords($row->causer->name) : 'System';
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm');
                })
                ->addColumn('changes', function ($row) {
                    $changes = '';
                    $excludedAttributes = ['created_at', 'created_by', 'updated_at', 'updated_by'];

                    // Kondisi untuk event created
                    if ($row->event === 'created' && $row->properties->has('attributes')) {
                        $changes .= '<strong>New Data:</strong><br>';
                        foreach ($row->properties['attributes'] as $key => $value) {
                            if (!in_array($key, $excludedAttributes)) {
                                $changes .= "$key: $value<br>";
                            }
                        }
                    }

                    // Kondisi untuk event deleted
                    elseif ($row->event === 'deleted' && $row->properties->has('old')) {
                        $changes .= '<strong>Deleted Data:</strong><br>';
                        foreach ($row->properties['old'] as $key => $value) {
                            if (!in_array($key, $excludedAttributes)) {
                                $changes .= "$key: $value<br>";
                            }
                        }
                    }

                    // Kondisi untuk event updated
                    elseif ($row->event === 'updated' && $row->properties->has('old') && $row->properties->has('attributes')) {
                        $changes .= '<strong>Before:</strong><br>';
                        foreach ($row->properties['old'] as $key => $value) {
                            if (!in_array($key, $excludedAttributes)) {
                                $changes .= "$key: $value<br>";
                            }
                        }

                        $changes .= '<strong>After:</strong><br>';
                        foreach ($row->properties['attributes'] as $key => $value) {
                            if (!in_array($key, $excludedAttributes)) {
                                $indicator = $value !== ($row->properties['old'][$key] ?? null) ? 'style="color:red;"' : '';
                                $changes .= "<span $indicator>$key: $value</span><br>";
                            }
                        }
                    }

                    return $changes;
                })
                ->rawColumns(['event', 'changes'])
                ->make(true);
        }

        $data = [
            'page_title' => $this->module,
        ];

        return view('backend.other.log.index', $data);
    }
}
