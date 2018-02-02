<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Exception\RepositoryException;
use App\Http\Requests\CountryRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CountryRepositoryInterface;

class CountryController extends Controller
{
    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {
        // q: query parameter
        $keyword = $request->q;

        if (isset($keyword)) {
            $countries = $this->countryRepository->search($keyword, config('repository.pagination.limit'));
            $countries->appends($request->only('q'));
        } else {
            $countries = $this->countryRepository->countries(config('repository.pagination.limit'), [['id', 'desc']]);
        }

        return view('admin.country.index', compact('countries'));
    }

    public function store(CountryRequest $request)
    {
        try {
            $inputs = $request->only('name');
            $this->countryRepository->create($inputs);

            $message = trans('admin.country.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('admin.country.index.add.message.add_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id)
    {
        try {
            $country = $this->countryRepository->find($id); // throw RepositoryException when can not found
            $countries = $this->countryRepository->countries(config('repository.pagination.limit'), [['id', 'desc']]);

            return view('admin.country.index', compact('country', 'countries'));
        } catch (RepositoryException $e) {
            $message = trans('admin.country.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    public function update(CountryRequest $request, $id)
    {
        try {
            $country = $this->countryRepository->find($id); // throw RepositoryException when can not found
            $inputs = $request->only('name');
            $this->countryRepository->update($inputs, $country);
            $message = trans('admin.country.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('countries.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            $message = trans('admin.country.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    public function destroy($id)
    {
        try {
            $this->countryRepository->find($id); // throw RepositoryException when can not found
            $this->countryRepository->delete($id);

            $message = trans('admin.country.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.country.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.country.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('countries.edit', ['id' => $id]))) {
            return redirect()->route('countries.index')->with('notification', $notification);
        }

        return redirect()->back()->with('notification', $notification);
    }
}
