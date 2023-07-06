@extends('layouts.admindash')

@section('container')
<section class="container m-auto mt-11">
    
<div class="relative overflow-x-auto rounded-xl">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    School
                </th>
                <th scope="col" class="px-6 py-3">
                    Telp
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $row)
            <tr class="bg-white border-b dark:bg-gray-50 dark:border-gray-700">
                
                    <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $row->name }}
                    </th>
                    <td class="px-6 py-4 text-gray-600 ">
                        {{ $row->id }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $row->school_name }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $row->telp }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        <a href="{{ route('admin.detail', $row->id) }}" class="text-blue-500 underline">detail</a>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
   
</section>
@endsection