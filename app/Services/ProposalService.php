<?php


namespace App\Services;


use App\Models\Proposal;
use Illuminate\Http\UploadedFile;

class ProposalService
{
    /**
     * @var PdfReader
     */
    private $pdfReader;

    /**
     * ProposalService constructor.
     * @param PdfReader $pdfReader
     */
    public function __construct(PdfReader $pdfReader)
    {
        $this->pdfReader = $pdfReader;
    }

    public function handleProposalFile(UploadedFile $file): ?Proposal
    {
        $hasText = $this->pdfReader
            ->readFile($file->getRealPath())
            ->hasText('Proposal');

        if(!$hasText) {
            return null;
        }

        $path = $file->store('uploads');

        $proposal = Proposal::whereNameAndSize($file->getClientOriginalName(), $file->getSize())->first();
        if(!$proposal) {
            $proposal = new Proposal();
            $proposal->name = $file->getClientOriginalName();
        }
        $proposal->size = $file->getSize();
        $proposal->path = $path;
        $proposal->save();

        return $proposal;
    }
}
