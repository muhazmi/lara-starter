<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Support\Str;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Setting\CompanyUpdateRequest;

class CompanyController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = __('Company Information');
    }

    /**
     * Display the company's company form.
     */
    public function edit()
    {
        $data = [
            'page_title'    => $this->module,
            'company'      => Company::where('id', 1)->first(),
        ];

        return view('backend.setting.company.edit', $data);
    }

    /**
     * Update the company's company information.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company = Company::find(1);
        $data = $request->validated();

        try {
            if ($request->hasFile('logo')) {
                if ($company->logo) {
                    Storage::disk('images')->delete('company/' . $company->logo);
                }

                $logo = $request->file('logo');
                $logoName = Str::slug($request->company_name) . '-logo-' . now()->format('YmdHis') . '.' . $logo->extension();
                Storage::disk('images')->put('company/' . $logoName, file_get_contents($logo));
                $data['logo'] = $logoName;
            }

            if ($request->hasFile('favicon')) {
                if ($company->favicon) {
                    Storage::disk('images')->delete('favicon/' . $company->favicon);
                }

                $favicon = $request->file('favicon');
                $faviconName = 'favicon-' . now()->format('YmdHis') . '.' . $favicon->extension();
                Storage::disk('images')->put('favicon/' . $faviconName, file_get_contents($favicon));
                $data['favicon'] = $faviconName;
            }

            $company->update($data);

            return response()->json(['success' => true, 'message' => __('Data Updated Successfully')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Failed to update data. Please try again.') . ': ' . $e->getMessage()]);
        }
    }
}
