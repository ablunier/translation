<?php
namespace Anavel\Translation\Http\Controllers;

use Anavel\Foundation\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index()
    {
        $files = config('anavel-translation.files');

        if (empty($files)) {
            throw new \Exception("No files configured.");
        }

        if (! is_array($files)) {
            throw new \Exception('Files should be an array');
        }

        $files = array_change_key_case($files, CASE_LOWER);
        if (! array_key_exists('user', $files) && ! array_key_exists('vendor', $files)) {
            throw new \Exception('"user" or "vendor" files should be set');
        }

        if (array_key_exists('user', $files)) {
            return new RedirectResponse(route('anavel-translation.file.edit', $files['user'][0]));
        } else {
            $key = key($files['vendor']);
            return new RedirectResponse(route('anavel-translation.file.edit', [$key, $files['vendor'][$key]]));
        }
    }
}
