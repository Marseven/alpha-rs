<?php

namespace Tests\Feature\Security;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * The doctor / CNAMGS spaces used to link straight to the raw join_piece column
 * value, bypassing authentication for legacy public files. They now go through
 * /files/folders/{folder}/piece, which means the policy must grant read access
 * to the reviewer a case is actually assigned to — and to nobody else.
 */
class MedicalDocumentAccessTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private function folderWithDocument(): \App\Models\Folder
    {
        Storage::fake('local');
        Storage::disk('local')->put('private/folders/doc.pdf', '%PDF-1.4 fake');

        $folder = $this->makeFolder($this->makeUser());
        $folder->join_piece = 'private/folders/doc.pdf';
        $folder->save();

        return $folder;
    }

    public function test_assigned_doctor_can_download_the_folder_document(): void
    {
        $folder = $this->folderWithDocument();
        $doctor = $this->makeDoctor();
        $this->makeCase(['folder_id' => $folder->id, 'doctor_id' => $doctor->id]);

        $this->actingAs($doctor)
            ->get('/files/folders/' . $folder->id . '/piece')
            ->assertOk();
    }

    public function test_assigned_cnamgs_can_download_the_folder_document(): void
    {
        $folder = $this->folderWithDocument();
        $cnamgs = $this->makeCnamgs();
        $this->makeCase(['folder_id' => $folder->id, 'cnamgs_id' => $cnamgs->id]);

        $this->actingAs($cnamgs)
            ->get('/files/folders/' . $folder->id . '/piece')
            ->assertOk();
    }

    public function test_unassigned_doctor_cannot_download_the_folder_document(): void
    {
        $folder = $this->folderWithDocument();
        // A case exists, but it is assigned to a different doctor.
        $this->makeCase(['folder_id' => $folder->id, 'doctor_id' => $this->makeDoctor()->id]);

        $this->actingAs($this->makeDoctor())
            ->get('/files/folders/' . $folder->id . '/piece')
            ->assertForbidden();
    }

    public function test_doctor_without_any_case_on_the_folder_is_refused(): void
    {
        $folder = $this->folderWithDocument();

        $this->actingAs($this->makeDoctor())
            ->get('/files/folders/' . $folder->id . '/piece')
            ->assertForbidden();
    }

    public function test_folder_owner_still_has_access(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('private/folders/doc.pdf', '%PDF-1.4 fake');

        $owner = $this->makeUser();
        $folder = $this->makeFolder($owner);
        $folder->join_piece = 'private/folders/doc.pdf';
        $folder->save();

        $this->actingAs($owner)
            ->get('/files/folders/' . $folder->id . '/piece')
            ->assertOk();
    }

    /** Read access must not leak into write/pay abilities. */
    public function test_assigned_doctor_cannot_pay_the_folder(): void
    {
        $folder = $this->folderWithDocument();
        $doctor = $this->makeDoctor();
        $this->makeCase(['folder_id' => $folder->id, 'doctor_id' => $doctor->id]);

        $this->actingAs($doctor)
            ->post('/folder/pay/' . $folder->id)
            ->assertForbidden();
    }
}
