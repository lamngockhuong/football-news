<?php

namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', Category::class);
        // q: query parameter
        $keyword = $request->q;

        if (isset($keyword)) {
            $categories = $this->categoryRepository->search($keyword, config('repository.pagination.limit'));
            $categories->appends($request->only('q'));
        } else {
            $categories = $this->categoryRepository->categories(config('repository.pagination.limit'));
        }

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('access', Category::class);
        try {
            $this->categoryRepository->create($request->all());

            $message = trans('admin.category.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('admin.category.index.add.message.add_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return back()->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('access', Category::class);
        try {
            $category = $this->categoryRepository->find($id); // throw RepositoryException when can not found
            $categories = $this->categoryRepository->categories(config('repository.pagination.limit'), [['id', 'desc']]);

            return view('admin.category.index', compact('category', 'categories'));
        } catch (RepositoryException $e) {
            $message = trans('admin.category.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->with('notification', $notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->authorize('access', Category::class);
        try {
            $category = $this->categoryRepository->find($id); // throw RepositoryException when can not found
            $this->categoryRepository->update($request->all(), $category);
            $message = trans('admin.category.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('categories.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            $message = trans('admin.category.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('access', Category::class);
        try {
            $this->categoryRepository->find($id); // throw RepositoryException when can not found
            $this->categoryRepository->delete($id);

            $message = trans('admin.category.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.category.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.category.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('categories.edit', ['id' => $id]))) {
            return redirect()->route('categories.index')->with('notification', $notification);
        }

        return back()->with('notification', $notification);
    }
}
