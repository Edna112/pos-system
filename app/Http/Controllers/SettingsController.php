<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function edit()
    {
        // You can add more keys as needed
        $settings = [
            'site_name' => Settings::getValue('site_name'),
            'site_email' => Settings::getValue('site_email'),
            'site_logo' => Settings::getValue('site_logo'),
            'contact_phone' => Settings::getValue('contact_phone'),
            'contact_address' => Settings::getValue('contact_address'),
        ];
        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:255',
        ]);

        Settings::setValue('site_name', $data['site_name']);
        Settings::setValue('site_email', $data['site_email']);
        Settings::setValue('contact_phone', $data['contact_phone'] ?? '');
        Settings::setValue('contact_address', $data['contact_address'] ?? '');

        if ($request->hasFile('site_logo')) {
            $logo = $request->file('site_logo')->store('settings', 'public');
            Settings::setValue('site_logo', $logo);
        }

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully!');
    }
} 