<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdfUploadRequest;
use App\Models\Proposal;
use App\Services\PdfReader;
use App\Services\ProposalService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    public function form()
    {
        return view('upload');
    }

    public function handleFormSubmit(PdfUploadRequest $request, ProposalService $proposalService)
    {
        /** @var UploadedFile $file */
        $file = $request->validated()['file'];

        $proposalService->handleProposalFile($file);

        return response('ok');
    }
}
