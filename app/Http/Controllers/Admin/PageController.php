<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str; 

class PageController extends Controller
{
    public function index(): Response
    {
        $pages = Page::latest()->paginate(15)->through(fn($p) => [
            'id'         => $p->id,
            'title'      => $p->name,
            'slug'       => $p->slug,
            'updated_at' => $p->updated_at->format('M j, Y'),
        ]);

        return Inertia::render('admin/pages/index', ['pages' => $pages]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/pages/create');
    }

    public function store(StorePageRequest $request): RedirectResponse
    {
        Page::create($request->validated());

        return redirect()
            ->route('pages.index')
            ->with('success', 'Page created.');
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('admin/pages/edit', [
            'page' => [
                'id' => $page->id,
                'title' => $page->name,        
                'slug' => $page->slug,
                'description' => $page->description, 
            ]
        ]);
        
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $page->update($request->validated());

        return redirect()
            ->route('pages.index')
            ->with('success', 'Page updated.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()
            ->route('pages.index')
            ->with('success', 'Page deleted.');
    }
}