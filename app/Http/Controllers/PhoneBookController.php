<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use Illuminate\Http\Request;
use App\Filters\PhoneBookFilter;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\PhoneBookRequest;

class PhoneBookController extends Controller
{
    /**
     * Get all records with filter or not
     *
     * @param  Request  $request
     * @param  PhoneBookFilter  $filter
     *
     * @return JsonResponse
     */
    public function index(Request $request, PhoneBookFilter $filter): JsonResponse
    {
        $request->validate([
            'id'            => 'int',
            'name'          => 'string',
            'second_name'   => 'string'
        ]);

        return response()->json(PhoneBook::filter($filter)->get(), 200);
    }

    /**
     * Create record
     *
     * @param  PhoneBookRequest  $request
     * @return JsonResponse
     */
    public function store(PhoneBookRequest $request): JsonResponse
    {
        $phone_book = new PhoneBook;
        $phone_book->name = $request->get('name');
        $phone_book->second_name = $request->get('second_name');
        $phone_book->phone_number = $request->get('phone_number');
        $phone_book->country_code = $request->get('country_code');
        $phone_book->timezone_code = $request->get('timezone_code');
        $phone_book->save();
        return response()->json([sprintf('Record with number %d created', $phone_book->id)]);
    }

    /**
     * Update record
     * @param  PhoneBookRequest  $request
     * @param  PhoneBook  $phone_book
     *
     * @return JsonResponse
     */
    public function update(PhoneBookRequest $request, PhoneBook $phone_book): JsonResponse
    {
        $phone_book->update($request->all());
        return response()->json(sprintf('Record with number %d updated', $phone_book->id), 200);
    }
}
