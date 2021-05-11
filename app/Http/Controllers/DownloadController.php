<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        try {
            $download = new Download();
            if ($request['hashtag'] == null) {
                $download->hashtag = '';
            } else {
                $download->hashtag = $request['hashtag'];
            }

            if ($request->parser['ua'] == null) {
                $download->ua = '';
            } else {
                $download->ua = $request->parser['ua'];
            }

            if ($request['session'] == null) {
                $download->ip = '';
            } else {
                $download->ip = base64_decode($request['session']);
            }

            if (!array_key_exists('name', $request->parser['browser']) || $request->parser['browser']['name'] == null) {
                $download->browser_name = '';
            } else {
                $download->browser_name = $request->parser['browser']['name'];
            }

            if (!array_key_exists('version', $request->parser['browser']) || $request->parser['browser']['version'] == null) {
                $download->browser_version = '';
            } else {
                $download->browser_version = $request->parser['browser']['version'];
            }

            if (!array_key_exists('name', $request->parser['engine']) || $request->parser['engine']['name'] == null) {
                $download->engine_name = '';
            } else {
                $download->engine_name = $request->parser['engine']['name'];
            }

            if (!array_key_exists('version', $request->parser['engine']) || $request->parser['engine']['version'] == null) {
                $download->engine_version = '';
            } else {
                $download->engine_version = $request->parser['engine']['version'];
            }

            if (!array_key_exists('name', $request->parser['os']) || $request->parser['os']['name'] == null) {
                $download->os_name = '';
            } else {
                $download->os_name = $request->parser['os']['name'];
            }

            if (!array_key_exists('version', $request->parser['os']) || $request->parser['os']['version'] == null) {
                $download->os_version = '';
            } else {
                $download->os_version = $request->parser['os']['version'];
            }

            if (!array_key_exists('model', $request->parser['device']) || $request->parser['device']['model'] == null) {
                $download->device_model = '';
            } else {
                $download->device_model = $request->parser['device']['model'];
            }

            if (!array_key_exists('type', $request->parser['device']) || $request->parser['device']['type'] == null) {
                $download->device_type = '';
            } else {
                $download->device_type = $request->parser['device']['type'];
            }

            if (!array_key_exists('vendor', $request->parser['device']) || $request->parser['device']['vendor'] == null) {
                $download->device_vendor = '';
            } else {
                $download->device_vendor = $request->parser['device']['vendor'];
            }

            if (!array_key_exists('architecture', $request->parser['cpu']) || $request->parser['cpu']['architecture'] == null) {
                $download->cpu_arch = '';
            } else {
                $download->cpu_arch = $request->parser['cpu']['architecture'];
            }
                        
            $download->save();
            return response()->json('', 200);
        } catch (\Throwable $th) {
            return response()->json('', 200);
        }
    }
}
