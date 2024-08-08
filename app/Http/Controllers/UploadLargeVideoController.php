<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadLargeVideoController extends Controller
{
    public function __invoke(Request $request)
    {
        $reciver = new FileReceiver($request->file, $request, ResumableJSUploadHandler::class);

        $save = $reciver->receive();

        if ($save->isFinished()) {
            $file = $save->getFile();

            $orginalName = $file->getClientOriginalName();

            $file->move(storage_path('app/chunks'), $orginalName);
        }
        $handler = $save->handler();

        return response()->json(['progress' => $handler->getPercentageDone()]);
    }
}
