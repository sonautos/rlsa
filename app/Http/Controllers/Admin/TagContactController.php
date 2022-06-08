<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTagContactRequest;
use App\Http\Requests\StoreTagContactRequest;
use App\Http\Requests\UpdateTagContactRequest;
use App\Models\TagContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TagContactController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tag_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TagContact::query()->select(sprintf('%s.*', (new TagContact)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tag_contact_show';
                $editGate      = 'tag_contact_edit';
                $deleteGate    = 'tag_contact_delete';
                $crudRoutePart = 'tag-contacts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('tag', function ($row) {
                return $row->tag ? $row->tag : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tagContacts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tag_contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagContacts.create');
    }

    public function store(StoreTagContactRequest $request)
    {
        $tagContact = TagContact::create($request->all());

        return redirect()->route('admin.tag-contacts.index');
    }

    public function edit(TagContact $tagContact)
    {
        abort_if(Gate::denies('tag_contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagContacts.edit', compact('tagContact'));
    }

    public function update(UpdateTagContactRequest $request, TagContact $tagContact)
    {
        $tagContact->update($request->all());

        return redirect()->route('admin.tag-contacts.index');
    }

    public function show(TagContact $tagContact)
    {
        abort_if(Gate::denies('tag_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagContact->load('tagsCompanies', 'tagsIndividuals', 'tagsAddresses');

        return view('admin.tagContacts.show', compact('tagContact'));
    }

    public function destroy(TagContact $tagContact)
    {
        abort_if(Gate::denies('tag_contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagContact->delete();

        return back();
    }

    public function massDestroy(MassDestroyTagContactRequest $request)
    {
        TagContact::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
