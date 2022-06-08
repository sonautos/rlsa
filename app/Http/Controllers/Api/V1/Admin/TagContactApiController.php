<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagContactRequest;
use App\Http\Requests\UpdateTagContactRequest;
use App\Http\Resources\Admin\TagContactResource;
use App\Models\TagContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagContactApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tag_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagContactResource(TagContact::all());
    }

    public function store(StoreTagContactRequest $request)
    {
        $tagContact = TagContact::create($request->all());

        return (new TagContactResource($tagContact))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TagContact $tagContact)
    {
        abort_if(Gate::denies('tag_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagContactResource($tagContact);
    }

    public function update(UpdateTagContactRequest $request, TagContact $tagContact)
    {
        $tagContact->update($request->all());

        return (new TagContactResource($tagContact))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TagContact $tagContact)
    {
        abort_if(Gate::denies('tag_contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagContact->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
